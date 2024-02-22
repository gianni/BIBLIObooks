<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find(int $id);

    public function delete(int $id);

    public function update(int $id, array $data);

}