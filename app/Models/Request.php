<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
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
        'request_type_id',
        'title',
        'reference',
        'description',
        'request_number',
        'request_category_id',
        'asked_works',
        'trans_mention_id',
        'estimated_amount',
        'command_number',
        'user_id',
        'user_service_id',
        'sent_or',
        'sent_at',
        'on_treat',
        'deliv_or',
        'token',
        'sH_approval',
        'sH_approvalDate',
        'sH_id',
        'rA_approvalDate',
        'rA_approval',
        'rA_id',
        'dPal_approvalDate',
        'dPal_approval',
        'dPal_director_id',
        'cDL_approval',
        'cDL_approvalDate',
        'cDL_id',
        'wh_chief_approval',
        'wh_chief_id',
        'ch_chief_sign',
        'cm_id',
        'cm_sent',
        'taker_sign',
        'prmp_approval',
        'chief_sign',
        'department_sign',
        'status',
        'pw_date',
        'final_process_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,)->withDefault();
    }

    public function trans_mention()
    {
        return $this->hasMany(Trans_Mention::class);
    }
}

