<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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

// =========================================================================
// مسارات شاشة الخدمة الذاتية (Kiosk) وإصدار التذاكر المحدثة
// =========================================================================
Route::get('/kiosk', function () {
    $lokets = \App\Models\Loket::all();
    return view('kiosk', compact('lokets'));
})->name('kiosk');

Route::get('/kiosk/ticket/{id}', function ($id) {
    try {
        $loket = \App\Models\Loket::findOrFail($id);
        $today = \Carbon\Carbon::today();

        // عداد التذاكر الصادرة لليوم الحالي
        $issuedKey = 'kiosk_issued_' . $id . '_' . date('Y-m-d');

        // جلب عدد العمليات المسجلة في قاعدة البيانات للشباك اليوم
        $dbCount = \App\Models\Antrian::where('loket_id', $id)
            ->whereDate('created_at', $today)
            ->count();

        $currentIssued = cache()->get($issuedKey, $dbCount);
        $next = max($currentIssued, $dbCount) + 1;
        cache()->put($issuedKey, $next, now()->endOfDay());

        $str = sprintf('%03d', $next);
        $prefix = (mb_strlen($loket->kode) > 4) ? mb_substr($loket->kode, 0, 1) : $loket->kode;
        $nomor = $prefix . $str;

        // حساب عدد المراجعين في قائمة الانتظار (إجمالي المسحوب - ما تم استدعاؤه)
        $waitingCount = max(0, $next - $dbCount - 1);

        return response()->json([
            'nomor' => $nomor,
            'loket' => $loket->tujuan,
            'waiting' => $waitingCount,
            'time' => now()->format('Y-m-d h:i A')
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage()
        ], 500);
    }
});
