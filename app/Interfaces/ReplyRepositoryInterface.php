<?php

namespace App\Interfaces;

use App\Models\Reply;

interface ReplyRepositoryInterface
{
    public function index();

    public function store(Array $data);

    public function update(Reply $reply, Array $data);

    public function destroy(Reply $reply);
}
