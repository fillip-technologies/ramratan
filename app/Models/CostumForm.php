<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostumForm extends Model
{
    protected $table = 'costum_forms';
    protected $id  ='id';
    protected $fillable = ['name','contact','images','description','material'];
}
