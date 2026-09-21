<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::post('/', [App\Http\Controllers\HomeController::class, 'store'])->name('index.store');

Auth::routes();

Route::prefix('v1')->middleware('auth')->group(function () {
    Route::get('', [App\Http\Controllers\V1\IndexController::class, 'index'])->name('v1');

    Route::prefix('antrian')->middleware('auth')->group(function () {
        Route::get('', [App\Http\Controllers\V1\AntrianController::class, 'index'])->name('v1.antrian');
        Route::post('', [App\Http\Controllers\V1\AntrianController::class, 'lanjut'])->name('v1.antrian.next');
    });

    Route::prefix('loket')->middleware('auth')->group(function () {
        Route::get('', [App\Http\Controllers\V1\LoketController::class, 'index'])->name('v1.loket');
        Route::post('', [App\Http\Controllers\V1\LoketController::class, 'store'])->name('v1.loket.store');
        Route::patch('', [App\Http\Controllers\V1\LoketController::class, 'update'])->name('v1.loket.update');
        Route::delete('', [App\Http\Controllers\V1\LoketController::class, 'destroy'])->name('v1.loket.destroy');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// مسار شاشة الكيوسك المحدث لجلب جميع الأقسام وحساب أعداد الانتظار
Route::get('/kiosk', function () {
    $lokets = \App\Models\Loket::all();
    return view('kiosk', compact('lokets'));
})->name('kiosk');

Route::get('/kiosk/ticket/{id}', function ($id) {
    $loket = \App\Models\Loket::findOrFail($id);
    
    // حساب التذاكر
    $today = \Carbon\Carbon::today();
    $dbCount = \App\Models\Antrian::where('loket_id', $id)
        ->whereDate('created_at', $today)
        ->count();

    $next = $dbCount + 1;
    $str_length = 3;
    $str = substr("0000{$next}", -$str_length);
    $nomor = $loket->kode . $str;

    // حفظ التذكرة في النظام
    \App\Models\Antrian::create([
        'loket_id' => $loket->id,
        'nomor' => $nomor,
        'status' => 'waiting'
    ]);

    // عدد المراجعين في قائمة الانتظار لهذا القسم حالياً
    $waitingCount = \App\Models\Antrian::where('loket_id', $id)
        ->whereDate('created_at', $today)
        ->where('status', 'waiting')
        ->count();

    return response()->json([
        'nomor' => $nomor,
        'loket' => $loket->tujuan,
        'waiting' => $waitingCount,
        'time' => date('Y-m-d h:i A')
    ]);
});
