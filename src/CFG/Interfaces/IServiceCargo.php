<?php

namespace CFG\Interfaces;

interface IServiceCargo
{
    public function list();

    public function save();

    public function update();

    public function delete(int $idcargo);
}