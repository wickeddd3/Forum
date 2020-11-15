<?php

namespace App\Repositories;

interface ProfileRepositoryInterface
{
    public function authUser();

    public function profile(string $username);

    public function update(object $request);
}
