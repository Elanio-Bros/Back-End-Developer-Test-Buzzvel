<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday_Plans extends Model
{
    use HasFactory;

    protected $table = 'holiday_plans';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'update_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'date',
        'participants', 'date',
    ];

    /**
     * The attributes that are guard mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [
        'id', 'created_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'date' => 'date',
    ];
}
