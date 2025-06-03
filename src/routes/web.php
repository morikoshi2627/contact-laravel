<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth'])->group(function () {
  Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
// エクスポート
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

Route::get('/login', function () {
  return view('login');
})->name('login');

Route::post('/logout', function (Request $request) {
  Auth::logout();

  $request->session()->invalidate();
  $request->session()->regenerateToken();

  return redirect('/login'); // ログイン画面にリダイレクト
})->name('logout');
// モーダルウィンドウ削除処理用ルート
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');