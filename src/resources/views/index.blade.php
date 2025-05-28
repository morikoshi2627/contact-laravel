@extends('layouts.app')

@section('css')
<!-- <!DOCTYPE html> 
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />  -->
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  @endsection

  @section('content')
<!-- </head>

<body>
  <header class="header">
    <div class="header__inner">
      FashionablyLate
    </div>
  </header>

  <main> -->
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>
      <form class="form" action="/confirm" method="post">
         @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input class="field" type="text" name="name1" placeholder="例:山田" value="{{ old('name1') }}" />
              <input class="field" type="text" name="name2" placeholder="例:太郎" value="{{ old('name2') }}" />
              </div>
            <div class="form__error">
              @error('name')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
          <div class="form__group">
            <div class="form__group-title">
              <span class="form__label--item">性別</span>
              <span class="form__label--required">※</span>
        </div>
          <div class="form__group-content">
            <div class="form__input--text">
            <label class="custom-radio">
              <input class="field" type="radio" name="gender" value="male" {{ old('gender', 'male') == 'male' ? 'checked' : '' }}>
              <span class="radio-mark"></span>男性
            </label>
            <label class="custom-radio">
              <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
              <span class="radio-mark"></span>女性
            </label>
            <label class="custom-radio">
              <input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
              <span class="radio-mark"></span>その他
            </label>
            </div>
            <div class="form__error">
            @error('gender')
            {{ $message }}
            @enderror
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input class="field-2" type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
            </div>
            <div class="form__error">
            @error('email')
            {{ $message }}
            @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input class="field" type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}" /> -
              <input class="field" type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}" /> -
              <input class="field" type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
            </div>
            <div class="form__error">
            @error('tel1')
            {{ $message }}
            @enderror
            @error('tel2')
            {{ $message }}
            @enderror
            @error('tel3')
            {{ $message }}
            @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input class="field-2" type="text" name="address" placeholder="例:東京都渋谷区千駄ケ谷1-2-3" value="{{ old('address') }}" />
            </div>
            <div class="form__error">
            @error('address')
            {{ $message }}
            @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">建物名</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input class="field-2" type="text" name="building" placeholder="例:千駄ケ谷マンション101" value="{{ old('building') }}" />
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <select class="field" name="contact">
                <!-- oldキーで値を保持 -->
                <option value="" disabled {{ old('contact') == '' ? 'selected' : '' }}>選択してください</option>
              <option value="1.商品のお届けについて" {{ old('contact') == '1.商品のお届けについて' ? 'selected' : '' }}>1.商品のお届けについて</option>
              <option value="2.商品の交換について" {{ old('contact') == '2.商品の交換について' ? 'selected' : '' }}>2.商品の交換について</option>
              <option value="3.商品トラブル" {{ old('contact') == '3.商品トラブル' ? 'selected' : '' }}>3.商品トラブル</option>
              <option value="4.ショップへのお問い合わせ" {{ old('contact') == '4.ショップへのお問い合わせ' ? 'selected' : '' }}>4.ショップへのお問い合わせ</option>
              <option value="5.その他" {{ old('contact') == '5.その他' ? 'selected' : '' }}>5.その他</option>
              </select>
            </div>
            <div class="form__error">
            @error('contact')
            {{ $message }}
            @enderror
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea class="field-3" name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
            </div>
            <div class="form__error">
            @error('content')
            {{ $message }}
            @enderror
            </div>
          </div>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">確認画面</button>
        </div>
      </form>
    </div>
    @endsection
  <!-- </main> -->
<!-- </body> -->