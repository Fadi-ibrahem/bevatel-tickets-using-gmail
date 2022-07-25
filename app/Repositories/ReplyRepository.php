<?php

namespace App\Repositories;

use App\Interfaces\ReplyRepositoryInterface;
use App\Models\Reply;

class ReplyRepository implements ReplyRepositoryInterface
{
    public function index()
    {
        return Reply::all()->sortDesc();
    }

    public function store(array $data)
    {
        Reply::create($data);
    }

    public function update(Reply $reply, array $data)
    {
        $reply->update($data);
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();
    }
}
