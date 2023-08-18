<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'task_managements';

    protected $fillable = [
        'task_name',
        'description',
        'status_id',
        'user_id',
    ];

    protected function handleRecordCreation(array $data): Model
    {
        return static::getModel()::create($data);
    }

    public function getStatusName():BelongsTo{
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function getUserName():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

}