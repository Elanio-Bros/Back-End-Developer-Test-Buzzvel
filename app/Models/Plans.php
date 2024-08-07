<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Plans extends Model
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
        'participants', 'date', 'location',
        'update_at', 'created_at',
        // hidden
        'user_id',
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
        'participants' => 'json'
    ];

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->toDateString(),
            set: fn (string $value) => Carbon::parse($value)->toDateString(),
        );
    }
}
