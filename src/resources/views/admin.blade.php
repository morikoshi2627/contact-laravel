<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

 <body>
   <header class="header">
     <div class="header__inner">
       FashionablyLate
     </div>
     <div class="form__button">
     <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="form__button-submit">logout</button>
    </form>
     </div>
   </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2 class="contact-form__title">Admin</h2>
      </div>
  </main>
 </body>
</html>