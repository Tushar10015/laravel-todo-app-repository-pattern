<?php

namespace App\Services;

use App\Interfaces\TodoRepositoryInterface;

class TodoService
{
    protected $repository;

    public function __construct(TodoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTodos()
    {
        return $this->repository->all();
    }

    public function createTodo(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateTodo($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteTodo($id)
    {
        $this->repository->delete($id);
    }
    public function getTodoById($id)
    {
        return $this->repository->find($id);
    }
}
