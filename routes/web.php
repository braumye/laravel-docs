<?php

use Braumye\LaravelDocs\Http\Controllers\DocsController;
use Illuminate\Support\Facades\Route;

Route::get('docs/{page?}', [DocsController::class, 'show'])->name('docs.show');
