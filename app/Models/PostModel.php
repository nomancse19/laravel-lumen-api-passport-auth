<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{

    use HasFactory;
    protected $primaryKey ="post_data_id";
    protected $table ='post_data';
    protected $fillable = [
        'post_title', 'post_body',
    ];
}