<?php

use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Front\TicketController;
use \App\Http\Controllers\Front\ReplyController;
use \Illuminate\Support\Facades\Session;

// Make the root route redirect to the tickets index
Route::get('/', function () {
    return redirect()->route('tickets.index');
});

// Tickets Route Resource
Route::resource('/tickets', TicketController::class);

// Replies Route Resource
Route::resource('/replies', ReplyController::class);

// A specific Ticket Replies Route
Route::get('/ticket/{ticket}/replies', [TicketController::class, 'replies'])->name('ticket.replies');

// Google Authentication Routes
Route::get('/generate-token', [OAuthController::class, 'generateTokenPreURL'])->name('token.generate');
Route::get('/get-token', [OAuthController::class, 'retrieveToken'])->name('token.retrieve');

