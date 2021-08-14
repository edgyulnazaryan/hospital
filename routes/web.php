<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocEvent;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\WorkController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');




Route::get('/work/{id}', [WorkController::class, 'index'])->name('work');
Route::post('/work/create', [WorkController::class, 'create'])->name('work.create');


Route::get('/doctor', [DoctorController::class, 'index'])->name('doctors');
Route::get('/doctor/create', [DoctorController::class, 'create'])->name('add_doctors');
Route::post('/doctor/create', [DoctorController::class, 'store'])->name('add_doctors_form');

Route::get('/doctor/{id}', [DoctorController::class, 'ajax'])->name('info');
Route::get('/doctor/{id}/info', [DoctorController::class, 'info'])->name('ajax');
Route::post('/doctor/{id}/action', [DoctorController::class, 'action'])->name('action');



Route::get('/', [DoctorController::class, 'info_full'])->name('info_full');


Route::get('/doctor/search', [DoctorController::class, 'search'])->name('search');
Route::post('/doctor/search', [DoctorController::class, 'title'])->name('title');


Route::get('/doctor/{id}/show_graph', [DoctorController::class, 'show_graph'])->name('show_graph');
Route::get('/doctor/{id}/search_graph', [DoctorController::class, 'search_graph'])->name('search_graph');
Route::post('/doctor/graph-register', [DoctorController::class, 'graph_register'])->name('graph_register');
Route::get('/doctor/book/{id}', [DoctorController::class, 'book'])->name('book');

Route::get('/patient', [PatientController::class, 'index'])->name('patient');
Route::get('/patient/show/{id}', [PatientController::class, 'show'])->name('patient_show');
Route::get('/patient/create', [PatientController::class, 'create'])->name('add_patient');
Route::post('/patient/create', [PatientController::class, 'store'])->name('add_patient_form');

Route::get('/visit/create/{id}', [VisitController::class, 'create'])->name('create_visit');
Route::post('/visit/create', [VisitController::class, 'store'])->name('create_visit_form');
