<?php

use App\Http\Controllers\PortfolioController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/' , [PortfolioController::class , 'getPortfolio']);
Route::post('/contact', [PortfolioController::class, 'storeMessage'])->name('contact.send');

Route::get('/bypass-login', function () {
    $user = User::where('email', 'eng.mona20sa@gmail.com')->first();
    
    if ($user) {
        // محاولة الدخول عبر web أولاً
        Auth::guard('web')->login($user);
        
        // إذا فشلت، نحاول عبر admin (إن وجد)
        if (!Auth::check()) {
            Auth::guard('admin')->login($user);
        }
        
        return redirect('/admin');
    }
    return "المستخدم غير موجود";
});