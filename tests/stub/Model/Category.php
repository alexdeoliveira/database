<?php

namespace TrezeVel\TrezeDatabase\Models;

use Illuminate\Database\Eloquent\Model;


/**
* Model de categorias
*/
class Category extends Model
{


    protected $table = 'trezevel_categories';

    protected $fillable = [
        'name',
        'description'
    ];
    
}
