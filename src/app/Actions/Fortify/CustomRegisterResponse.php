<?php


namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Http\Request;

class CustomRegisterResponse implements RegisterResponse
{
    public function toResponse($request)
    {
        // 登録後に遷移したいURLをここで指定
        return redirect('/contact');  //contact にリダイレクト
    }
}