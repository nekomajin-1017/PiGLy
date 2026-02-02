@extends('auth.authapp')

@section('css')
<link rel="stylesheet" href="{{asset('css/register1.css')}}">
@endsection

@section('contents')
  <div class="auth-bg">
    <div class="auth-card">
      <h1 class="auth-logo">PiGLy</h1>
      <h2 class="auth-title">新規会員登録</h2>
      <form class="auth-form" action="/register/step1" method="post" novalidate>
        @csrf
        <label class="auth-label">お名前</label>
        <input class="auth-input" type="text" name="name" placeholder="名前を入力">
        <x-form-error field="name" />

        <label class="auth-label">メールアドレス</label>
        <input class="auth-input" type="email" name="email" placeholder="メールアドレスを入力">
        <x-form-error field="email" />

        <label class="auth-label">パスワード</label>
        <input class="auth-input" type="password" name="password" placeholder="パスワードを入力">
        <x-form-error field="password" />

        <button class="auth-btn" type="submit">登録</button>
      </form>
      <a class="auth-link" href="/login">ログインはこちら</a>
    </div>
  </div>
@endsection
