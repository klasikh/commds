<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mat_transfert extends Model
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
        'id',
        'delivery_number',
        'creation_date',
        'sens',
        'leaving_mag',
        'benef_mag',
        'destination',
        'other_refs',
        'asker_sign',
        'rA_sign',
        'mag_chief',
        'mag_sign',
        'taker_sign',
        'user_sender_id',
        'user_receiver_id',
    ];

}
