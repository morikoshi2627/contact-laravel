@extends('layouts.app')
@section('css')

<!-- <!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" /> -->
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<!-- </head> 

<body>
<header class="header">
    <div class="header__inner">
      FashionablyLate
    </div>
  </header>

  <main>-->
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Confirm</h2>
      </div>
      <form class="form" action="{{ route('contact.store') }}" method="post">
      @csrf

      {{-- Hidden inputs --}}
      <input type="hidden" name="name1" value="{{ $contact['name1'] }}">
      <input type="hidden" name="name2" value="{{ $contact['name2'] }}">
      <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
      <input type="hidden" name="email" value="{{ $contact['email'] }}">
      <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
      <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
      <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
      <input type="hidden" name="address" value="{{ $contact['address'] }}">
      <input type="hidden" name="building" value="{{ $contact['building'] }}">
      <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
      <input type="hidden" name="content" value="{{ $contact['content'] }}">


         <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                
              {{-- 表示用 --}}
              <input class="confirm-table__text2" type="text" value="{{ $contact['name1'] . ' ' . $contact['name2'] }}" readonly />
              <!-- <input class="confirm-table__text2" type="text" name="name1" value="{{ $contact['name1'] . ' ' . $contact['name2'] }}" readonly /> -->
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
              <td class="confirm-table__text">
              {{ $contact['gender'] === 'male' ? '男性' : ($contact['gender'] === 'female' ? '女性' : 'その他') }}
              <input class="confirm-table__text2" type="hidden" name="gender" value="{{ $contact['gender'] }}">
              </td>
              </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
              <input class="confirm-table__text2" type="email" name="email" value="{{ $contact['email'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header"></th>
              <td class="confirm-table__text">
              <input class="confirm-table__text2" type="tel" name="tel" value="{{ $contact['tel1'].$contact['tel2'].$contact['tel3'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header"></th>
              <td class="confirm-table__text">
              <input class="confirm-table__text2" type="text" name="address" value="{{ $contact['address'] }}" readonly /> 
              </td>
            </tr>
              <tr class="confirm-table__row">
              <th class="confirm-table__header"></th>
              <td class="confirm-table__text">
              <input class="confirm-table__text2" type="text" name="building" value="{{ $contact['building'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header"></th>
              <td class="confirm-table__text">
              {{ $contact['contact'] }}
              <input class="confirm-table__text2" type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly /> 
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header"></th>
              <td class="confirm-table__text">
              <input class="confirm-table__text2" type="text" name="content"" value="{{ $contact['content'] }}" readonly /> 
              </td>
            </tr>
          </table>
        </div>
        <div class="form__button">
        <button class="form__button-submit" type="submit" name="action" value="submit">送信</button>
          <button class="form__button-submit-fixes" type="submit" name="action" value="fix">修正</button>
        </div>
      </form>
    </div>
    @endsection
   <!-- </main> -->
<!-- </body> -->

<!-- </html> -->

