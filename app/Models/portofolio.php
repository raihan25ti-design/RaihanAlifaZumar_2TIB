<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $table = 'portofolio';
    protected $primaryKey = 'portofolio_id';
    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
    ];
}