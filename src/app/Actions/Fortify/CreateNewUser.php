<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                Rule::unique(User::class),
            ],

            // 'password' => $this->passwordRules(),
            // ],
            // 自分でルールを書く（パスワードを確認入力なしで通す
            'password' => ['required', 'string', 'min:8'], // ここで 'confirmed' を削除
        ],

        // バリデーションのメッセージ
        [
            'name.required' => 'お名前を入力して下さい',
            'email.required' => 'メールアドレスを入力して下さい',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力して下さい',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
