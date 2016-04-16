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

    public function all($columns = array('*'))
    {

    }
    
    public function create(array $data)
    {

    }

    public function update(array $data, $id)
    {

    }

    public function delete($id)
    {

    }

    public function find($id, $columns = array('*'))
    {

    }
    
    public function findBy($field, $value, $columns = array('*'))
    {

    }

    public function model()
    {
    	return Category::class;
    }
    
}
