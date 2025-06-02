<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
        'name1' => ['required'],
        'name2' => ['required' ],
        'gender' => ['required'],
        'email' => ['required', 'email'],

        'tel1' => ['required', 'numeric', 'digits_between:1,5'],
        'tel2' => ['required', 'numeric', 'digits_between:1,5'],
        'tel3' => ['required', 'numeric', 'digits_between:1,5'],
        'address' => ['required' ],
        'category_id' => ['required'],
        'content' => ['required', 'string', 'max:120'],

        ];

    }

    public function messages()
    {
          return [
              'name1.required' => '姓を入力してください',
              
              'name2.required' => '名を入力してください',
              'gender.required' => '性別を選択してください',
              'email.required' => 'メールアドレスを入力してください',
              'email.email' => '有効なメールアドレス形式を入力してください',
              'tel1.required' => '電話番号を入力してください',
              'tel1.numeric' => '電話番号を数値で入力してください',
              'tel1.digits_between' => '電話番号は5桁までの数字で入力してください',
              'tel2.required' => '電話番号を入力してください',
              'tel2.numeric' => '電話番号を数値で入力してください',
              'tel2.digits_between' => '電話番号は5桁までの数字で入力してください',              
              'tel3.required' => '電話番号を入力してください',
              'tel3.numeric' => '電話番号を数値で入力してください',
              'tel3.digits_between' => '電話番号は5桁までの数字で入力してください',
             'address.required' => '住所を入力してください',
             'category_id.required' => 'お問い合わせの種類を選択してください',
             'content.required' => 'お問い合わせ内容を入力してください',
             'content.' => 'お問い合わせ内容を入力してください',

      ];
      }
}
