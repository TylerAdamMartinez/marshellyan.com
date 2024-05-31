<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Facade\Route;
use App\Controller\HttpController;

Route::get('/', [HttpController::class, 'index']);
Route::get('/about', [HttpController::class, 'about']);

Route::launch();
