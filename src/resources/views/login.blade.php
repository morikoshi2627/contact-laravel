<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      FashionablyLate
    </div>
    <div class="form__button">
    <a class="form__button-submit" href="{{ route('register') }}">register</a>
    <!-- <button class="form__button-submit" type="submit">register</button> -->
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2 class="contact-form__title">Login</h2>
      </div>
      <form class="form" action="/login" method="post">
         @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input class="field-2" type="email" name="email" placeholder="例:test@example.com" />
            </div>
            @error('email')
               <div class="form__error">
               {{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">パスワード</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input class="field-2" type="password" name="password" placeholder="例:coachtech1106" />
            </div>
            @error('password')
               <div class="form__error">
               {{ $message }}</div>
            @enderror
            <div class="form__button-login">
              <button class="form__button-login-submit" type="submit">ログイン</button>
          </div>
        </div>
      </form>
  </main>