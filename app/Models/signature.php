<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class signature extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:d M Y'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sign',
        'request_id',
        'asker_sign',
        'sH_sign',
        'rA_sign',
        'dPal_sign',
        'cDL_sign',
        'wH_sign',
        'cm_sign',
        'taker_sign',
        'prmp_sign',
    ];
}
