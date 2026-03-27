<?php
use Src\Route;

Route::add(['GET', 'POST'], '/signup', [Controller\SiteController::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\SiteController::class, 'login']);
Route::add('GET', '/logout', [Controller\SiteController::class, 'logout']);

Route::add('GET', '/', [Controller\SiteController::class, 'index'])->middleware('auth');

Route::add('GET', '/employees', [Controller\EmployeeController::class, 'index'])->middleware('auth', 'role:hr');
Route::add('GET', '/employees/create', [Controller\EmployeeController::class, 'create'])->middleware('auth', 'role:hr');
Route::add(['POST'], '/employees/store', [Controller\EmployeeController::class, 'store'])->middleware('auth', 'role:hr');
Route::add(['GET', 'POST'], '/employees/edit', [Controller\EmployeeController::class, 'edit'])->middleware('auth', 'role:hr');
Route::add(['POST'], '/employees/update', [Controller\EmployeeController::class, 'update'])->middleware('auth', 'role:hr');
Route::add(['POST'], '/employees/destroy', [Controller\EmployeeController::class, 'destroy'])->middleware('auth', 'role:hr');
Route::add('GET', '/employees/average', [Controller\EmployeeController::class, 'averageAge'])->middleware('auth', 'role:hr');

Route::add('GET', '/departments', [Controller\DepartmentController::class, 'index'])->middleware('auth', 'role:admin');
Route::add('GET', '/departments/create', [Controller\DepartmentController::class, 'create'])->middleware('auth', 'role:admin');
Route::add(['POST'], '/departments/store', [Controller\DepartmentController::class, 'store'])->middleware('auth', 'role:admin');
Route::add(['POST'], '/departments/destroy', [Controller\DepartmentController::class, 'destroy'])->middleware('auth', 'role:admin');

Route::add('GET', '/users', [Controller\UserController::class, 'index'])->middleware('auth', 'role:admin');
Route::add('GET', '/users/create', [Controller\UserController::class, 'create'])->middleware('auth', 'role:admin');
Route::add(['POST'], '/users/store', [Controller\UserController::class, 'store'])->middleware('auth', 'role:admin');
Route::add(['POST'], '/users/destroy', [Controller\UserController::class, 'destroy'])->middleware('auth', 'role:admin');