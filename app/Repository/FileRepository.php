<?php

namespace App\Repository;


use App\Models\File;

class FileRepository
{

    public function __construct(protected File $model)
    {
    }


    public function getAll()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function delete(int $id)
    {
        $this->model->findOrFail($id)->delete();
    }


}
