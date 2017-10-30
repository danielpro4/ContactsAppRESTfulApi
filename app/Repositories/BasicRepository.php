<?php

namespace Contacts\Repositories;

use Contacts\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class BasicRepository implements RepositoryInterface {

    /**
     * @var App
     */
    private $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * BasicRepository constructor.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;

        $this->makeModel();
    }

    /**
     * Especifica o Model que será utilizado.
     *
     * @return mixed
     */
    abstract public function model();

    /**
     * Instancia o model.
     *
     * @throws Exception - Retorna um errro caso o model não seja uma instância de Illuminate\\Database\\Eloquent\\Model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Busca todos e filtra somente as columnas que forem passadas.
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * Busca los objetos páginados de acuerdo com o parámetros.
     *
     * @param int   $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Guarda un objeto no vacío.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Actualiza un objeto no vacío.
     *
     * @param array  $data
     * @param        $id
     * @param string $attribute
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id') {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * Elimina un objeto do vacío.
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Filtra los objetos por id y por columnas.
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Busca por um atributo siendo igual a um valor e por columnas.
     *
     * @param       $attribute
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * Search records for string query specified
     * @param string $query
     * @return mixed
     */
    public function search($query)
    {
        return $this->model->search($query)->get();
    }
}