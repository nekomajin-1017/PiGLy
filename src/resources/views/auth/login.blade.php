@extends('auth.authapp')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('contents')
  <div class="auth-bg">
    <div class="auth-card">
      <h1 class="auth-logo">PiGLy</h1>
      <h2 class="auth-title">ログイン</h2>
      <form class="auth-form" action="/login" method="post" novalidate>
        @csrf
        <label class="auth-label">メールアドレス</label>
        <input class="auth-input" type="email" name="email" placeholder="メールアドレスを入力" required>
        <x-form-error field="email" />

        <label class="auth-label">パスワード</label>
        <input class="auth-input" type="password" name="password" placeholder="パスワードを入力" required>
        <x-form-error field="password" />

        <button class="auth-btn" type="submit">ログイン</button>
      </form>
      <a class="auth-link" href="/register">アカウント作成はこちら</a>
    </div>
  </div>
@endsection
