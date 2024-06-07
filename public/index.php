<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Facade\Route;
use App\Controller\HttpController;

Route::get('/', [HttpController::class, 'index']);
Route::get('/about', [HttpController::class, 'about']);

Route::group('/api', function () {
  Route::get('/User', function () {
    $array = ["username" => "fonzie", "password" => "penis1234"];
    echo json_encode($array);
  });
  Route::get('/User/{userId}', function ($userId) {
    $array = ["username" => "fonzie", "password" => "penis1234", "user_id" => $userId];
    echo json_encode($array);
  });
});

Route::launch();
