<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'subject',
        'content',
    ];

    // Get the replies for the ticket
    public function replies()
    {
        return $this->hasMany(Reply::class, 'ticket_id', 'id');
    }
}
