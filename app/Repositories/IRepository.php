<?php


namespace App\Repositories;


interface IRepository
{
    public function all();
    public function get($id);
    public function store($data);
    public function delete($id);
    public function update($id, $data);
}
