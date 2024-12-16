<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExternalTrainingController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VolunteerController;
use App\Models\ExternalTraining;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['isVolunteer'])->group(function () {
    Route::group(['prefix' => 'volunteer'], function () {
        Route::get('dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');
        Route::get('create_profile', [VolunteerController::class, 'create_profile'])->name('volunteer.create_profile');
        Route::post('create_profile', [VolunteerController::class, 'store_profile'])->name('volunteer.store_profile');
        Route::post('external_training_store', [ExternalTrainingController::class, 'external_training_store'])->name('volunteer.external_training.store');
        
    });



    Route::middleware(['isAdmin'])->group(function(){
        Route::group(['prefix' => 'admin'], function () {
            Route::get('dashboard', [VolunteerController::class, 'central_dashboard'])->name('dashboard');
            Route::get('profile', [VolunteerController::class, 'dashboard'])->name('admin.dashboard');
            Route::get('system/units', [UnitController::class, 'index'])->name('units');
            Route::get('system/units/new', [UnitController::class, 'unit_create'])->name('unit_create');
            Route::post('system/units/new', [UnitController::class, 'unit_store'])->name('unit_store');
            Route::get('event/trainings', [TrainingController::class, 'index'])->name('training_events');
            Route::get('event/trainings/new', [TrainingController::class, 'training_event_create'])->name('training_event_create');
            Route::post('event/trainings/new', [TrainingController::class, 'training_event_store'])->name('training_event_store');
            Route::get('event/trainings/{id}', [TrainingController::class, 'training_event_show'])->name('training_event_show');
            Route::get('event/trainings/{id}/edit', [TrainingController::class, 'training_event_edit'])->name('training_event_edit');
            Route::post('event/trainings/{id}/edit', [TrainingController::class, 'training_event_update'])->name('training_event_update');
            Route::post('event/trainings/search', [TrainingController::class, 'training_event_search'])->name('training_event_search');
            Route::get('user/trainers', [TrainerController::class, 'index'])->name('trainer.index');
            Route::get('user/trainers/new', [TrainerController::class, 'trainer_create'])->name('trainer.create');
            Route::post('user/trainers/new', [TrainerController::class, 'trainer_store'])->name('trainer.store');
            Route::get('user/trainers/{id}', [TrainerController::class, 'trainer_show'])->name('trainer.show');
            Route::get('volunteer/volunteers/{id}', [VolunteerController::class, 'show'])->name('volunteer.show');
    
    
    
            Route::get('volunteer/volunteers', [VolunteerController::class, 'index'])->name('volunteer.index');
            Route::get('volunteer/volunteers/leaderboard/{id}', [VolunteerController::class, 'show_performance'])->name('volunteer.show_performance');
           
    
    
            Route::post('internal_training_store', [VolunteerController::class, 'internal_training_store'])->name('volunteer.interternal_training.store');
            Route::get('approve_volunteer/{id}', [VolunteerController::class, 'approve_volunteer'])->name('volunteer.approve_volunteer');
        });

    });
});



Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'auth_login'])->name('auth_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register_admin');
Route::post('register', [AuthController::class, 'auth_register'])->name('auth_register');
Route::get('volunteer/volunteers/public/{id}', [VolunteerController::class, 'show_public'])->name('volunteer.show_public');
Route::post('internal_training_store', [VolunteerController::class, 'internal_training_store'])->name('volunteer.interternal_training.store');