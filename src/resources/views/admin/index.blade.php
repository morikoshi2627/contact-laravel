<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.index.css') }}" />
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


  <form method="GET" action="{{ route('admin.index') }}" class="form__search">
    <!--  名前・アドレス  -->
    <div class="search">  
          <input class="form__name" type="text" name="name" id="name"  placeholder="名前やメールアドレスを入力してください" value="{{ request('name') }}">
      </div>

    <!--  性別  -->
      <div class="search">
          <select class="form__gender" name="gender" id="gender">
              <option value="">性別</option>
              <option value="全て" {{ request('gender') == '全て' ? 'selected' : '' }}>全て</option>
              <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
              <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
              <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
          </select>
      </div>

 <!-- お問い合わせの種類  -->
      <div class="search">
          <select class="form__category" name="category" id="category">
              <option value="">お問い合わせの種類</option>
              @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
              @endforeach
          </select>
      </div>

    <!-- 日付（from/to）  -->
      <div class="search">
          <input class="form_date-text" type="date" name="from_date" id="from_date" value="{{ request('from_date') }}">
      </div>

    <!--  検索・リセット  -->
      <div class="search button-group">
          <button class="search__button-submit" type="submit">検索</button>
          <a class="reset__button" href="{{ route('admin.index') }}">リセット</a>
      </div>
  </form>
      <!-- エクスポートボタン -->
      <div class="action-row">
          <form method="GET" action="{{ route('admin.export') }}">
            <!-- 検索条件を保持したまま送信 -->
            <input type="hidden" name="name" value="{{ request('name') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category" value="{{ request('category') }}">
            <input type="hidden" name="from_date" value="{{ request('from_date') }}">
            <button type="submit" class="export__button">エクスポート</button>
          </form>

          <!-- ページネーション -->
          <div class="pagination">
          {{ $contacts->links('pagination::bootstrap-4') }}
          </div>
      </div>
          @if($contacts->count() > 0)
      <table class="contact-table">
        <thead class="contact-table__title">
          <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th>詳細</th>
          </tr>
        </thead>
        <tbody class="contact-table__categories">
          @foreach($contacts as $contact)
          <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>
            @if ($contact->gender == 1)
            男性
            @elseif ($contact->gender == 2)
            女性
            @else
            その他
            @endif
          </td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content ?? '-' }}</td>
            <td><a href="{{ route('admin.index', array_merge(request()->all(), ['detail_id' => $contact->id])) }}" class="button__detail">詳細</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
      <!-- </form> -->
  </main>

   <!-- モーダル本体 -->
   @if($selectedContact)
    <div class="modal-overlay">
      <div class="modal-content">
        <button class="modal-close" onclick="location.href='{{ route('admin.index', request()->except('detail_id')) }}'">×</button>
        <p>お名前: {{ $selectedContact->last_name }} {{ $selectedContact->first_name }}</p>
        <p>性別: {{ $selectedContact->gender == 1 ? '男性' : ($selectedContact->gender == 2 ? '女性' : 'その他') }}</p>
        <p>メール: {{ $selectedContact->email }}</p>
        <p>電話番号: {{ $selectedContact->tel }}</p>
        <p>住所: {{ $selectedContact->address }}</p>
        <p>建物名: {{ $selectedContact->building }}</p>
        <p>お問い合わせの種類: {{ $selectedContact->category->content ?? '-' }}</p>
        <p>お問い合わせ内容: {{ $selectedContact->detail }}</p>
        <form method="POST" action="{{ route('admin.delete', $selectedContact->id) }}">
          @csrf
        @method('DELETE')
        <button class="delate-button_detail" type="submit">削除</button>
    </form>
  </div>
</div>
@endif

 </body>
</html>