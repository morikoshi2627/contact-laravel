<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
// 登録後リダイレクト先指定
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Actions\Fortify\CustomRegisterResponse;
//ログイン後のリダイレクト先指定
use Laravel\Fortify\Contracts\LoginResponse;
// 
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RegisterResponse::class, CustomRegisterResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::registerView(function () {
            return view('/register'); // 登録画面のBladeを指定
        });

        
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);


  

        //ログイン後リダイレクト先指定 

        app()->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {
                 public function toResponse($request)
                 {
                    return redirect('/admin');
                 }
            };
        });

         Fortify::loginView(function () {
            return view('login');
         });               

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

     // Fortifyの登録後リダイレクト先を変更のため
    //  Fortifyのレスポンスカスタマイズをsingletonで上書き
        app()->singleton(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
            \App\Actions\Fortify\CustomRegisterResponse::class
        );


        Route::post('/login', function (LoginRequest $request) {
            return app(AuthenticatedSessionController::class)->store($request);
        })->middleware(['web']);

    }


}
