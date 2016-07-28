<?php

namespace TrezeVel\TrezeDatabase\Repository;

use TrezeVel\TrezeDatabase\AbstractRepository;
use TrezeVel\TrezeDatabase\Models\Category;


/**
* Model de categorias
*/
class CategoryRepository extends AbstractRepository
{


    protected $table = 'trezevel_categories';

    protected $fillable = [
        'name',
        'description'
    ];

    public function model()
    {
    	return Category::class;
    }
    
}
