<?php

namespace App\Repositories;

use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;


class TodoRepository implements TodoRepositoryInterface
{
    protected $model;

    public function __construct(Todo $todo)
    {
        $this->model = $todo;
    }

    public function all()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $todo = $this->find($id);
        $todo->update($data);
        return $todo;
    }

    public function delete($id)
    {
        $todo = $this->find($id);
        $todo->delete();
    }
}
