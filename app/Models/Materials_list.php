<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials_list extends Model
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
        'name',
        'article_code',
        'description',
        'category'
    ];
}
