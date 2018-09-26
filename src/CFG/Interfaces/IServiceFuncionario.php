<?php

namespace CFG\Interfaces;

interface IServiceFuncionario
{
    public function list();

    public function save();

    public function update();

    public function delete(int $id);
}