<?php

use App\Http\Controllers\BlockUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TaskController;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

Route::middleware('auth', 'verified', 'active')->group(function () {

    Route::get('/', function () {
        return view('page');
    })->name('page');

    Route::get('/project', function () {
        return view('pages.table-livewire.project');
    })->name('project');

    Route::get('/show-project', function () {
        return view('pages.table-livewire.system');
    })->name('show-project');

    Route::get('/show-user/{id}', function () {
        return view('pages.user.show');
    })->name('show-user');

    Route::get('/view-all', function () {
        return view('pages.notification');
    })->name('view-all');

    Route::prefix('/task')->name('task.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/create', [TaskController::class, 'store'])->name('store');
        Route::get('/show/{id}', [TaskController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [TaskController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [TaskController::class, 'delete'])->name('delete');
        Route::get('/checklist/{id}', [TaskController::class, 'createChecklist'])->name('checklist');
        Route::post('/checklist/{id}', [TaskController::class, 'storeChecklist'])->name('update-checklist');
    });


    Route::get('download/{filename}', function ($filename) {
        $pathToFile = storage_path('app/' . $filename);
        if (file_exists($pathToFile)) {
            return response()->download($pathToFile, $filename);
        }
        abort(404);
    })->name('file.download');
});
