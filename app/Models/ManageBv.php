<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageBv extends Model
{
    protected $table = 'manage_bvs';
    protected $primaryKey = 'id';
    protected $fillable = ['slider_image','mines_video','during_video','gallery_video'];
}
