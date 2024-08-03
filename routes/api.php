<?php

use App\Http\Controllers\Api\employeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\studentController;
use App\Http\Controllers\api\teachersController;

//Para la tabla estudiantes
Route::get('/students', [studentController::class, 'index']); //OBTENER UNA LISTA DE ESTUDIANTES
Route::get('/students/{id}', [studentController::class, 'show']); //OBTENER UN ESTUDIANTE
Route::post('/students', [studentController::class, 'store' ]); //para crear un estudiante
Route::put('/students/{id}', [studentController::class, 'update']); //el metodo put permite actualizar todo un objeto
Route::patch('/students/{id}', [studentController::class, 'updatePartial']); //para actualizar un dato especifico
Route::delete('/students/{id}', [studentController::class, 'destroy']); //para eliminar un estudiante

//Para la tabla estudiantes
Route::get('/teachers', [teachersController::class, 'index']); //Otener lista de profesores,                              consultar
Route::get('/teachers/{id}', [teachersController::class, 'show']); //obtener lista de un profesor ,                       buscar
Route::post('/teachers', [teachersController::class, 'store' ]); //para crear un teacher,                                 registrar
Route::put('/teachers/{id}', [teachersController::class, 'update']); //el metodo put permite actualizar todo un objeto, actualizar
//Route::patch('/teachers/{id}', [teachersController::class, 'updatePartial']); //para actualizar un dato especifico,     actualizar
Route::delete('/teachers/{id}', [teachersController::class, 'destroy']); //para eliminar un estudiante,                 eliminar


//Para la tabla Employee
Route::get('/employee', [employeeController::class, 'index']); //Otener lista de profesores,                              consultar
Route::get('/employee/{id}', [employeeController::class, 'show']); //obtener lista de un profesor ,                       buscar
Route::post('/employee', [employeeController::class, 'store' ]); //para crear un teacher,                                 registrar
Route::put('/employee/{id}', [employeeController::class, 'update']); //el metodo put permite actualizar todo un objeto, actualizar
//Route::patch('/teachers/{id}', [teachersController::class, 'updatePartial']); //para actualizar un dato especifico,     actualizar
Route::delete('/employee/{id}', [employeeController::class, 'destroy']); //para eliminar un estudiante,                 eliminar
