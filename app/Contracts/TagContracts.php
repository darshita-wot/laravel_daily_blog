<?php

namespace App\Contracts;

interface TagContracts{

    public function tagList();

    public function store();
    public function edit(string $id);

    public function update(string $id);

    public function destroy(string $id);
}