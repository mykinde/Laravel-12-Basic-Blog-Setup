<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::middleware('auth:sanctum')->post('/posts/{post}/comments', [CommentController::class, 'ajaxStore']);

