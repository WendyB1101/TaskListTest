<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status'];

    public const STATUSES = [
        'new'         => 'Новая',
        'in_progress' => 'В работе',
        'done'        => 'Выполнена',
    ];
}
