<?php

namespace TrezeVel\TrezeDatabase;

use TrezeVel\TrezeDatabase\Contracts\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model ;

    public abstract function model();

    public function makeModel()
    {
        $class = $this->model();
        $this->model = new $class;

        return $this->model;
    }
}