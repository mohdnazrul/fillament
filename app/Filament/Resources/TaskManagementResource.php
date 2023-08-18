<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskManagementResource\Pages;
use App\Models\Task;
use App\Models\TaskManagement;
use App\Models\User;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;


class TaskManagementResource extends Resource
{
    protected static ?string $model = TaskManagement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('task_name')->maxLength(255)->required(),
                Textarea::make('description')->columnSpanFull()->required(),
                Section::make('Task Assign Settings')
                    ->description('Settings for status and assign to task.')
                    ->schema([
                        Select::make('status_id')->label('Status')
                            ->options([
                                '1' => 'To Do',
                                '2' => 'In Progress',
                                '3' => 'Done',
                            ])
                            ->required(),
                        Select::make('user_id')
                            ->label('Assign to')
                            ->required()
                            ->options(function () {
                                $list = [];
                                foreach (User::all() as $user) {
                                    $list[$user->id] = $user->name;
                                }
                                return $list;
                            })

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('task_name')
                    ->size(TextColumn\TextColumnSize::Medium)
                    ->weight(FontWeight::Bold)
                    
                    ->description(fn (TaskManagement $record): string => htmlspecialchars_decode($record->description, HTML_ENTITIES))
                    ->html()
                    ->wrap(),
                TextColumn::make('name')->getStateUsing(function (Model $record) {
                    return $record->getUserName()->first()?->name;
                }),
                TextColumn::make('status')
                    ->getStateUsing(function (Model $record) {
                        return $record->getStatusName()->first()?->name;
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'To Do' => 'gray',
                        'In Progress' => 'warning',
                        'Done' => 'success',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])->striped();;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskManagement::route('/'),
            'create' => Pages\CreateTaskManagement::route('/create'),
            'edit' => Pages\EditTaskManagement::route('/{record}/edit'),
        ];
    }
}
