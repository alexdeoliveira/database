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

    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->find($id);
        return $model->delete();
    }

    public function find($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }
}