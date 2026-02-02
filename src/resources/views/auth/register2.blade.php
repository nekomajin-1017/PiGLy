@extends('auth.authapp')

@section('css')
<link rel="stylesheet" href="{{asset('css/register2.css')}}">
@endsection

@section('contents')
  <div class="auth-bg">
    <div class="auth-card">
      <h1 class="auth-logo">PiGLy</h1>
      <h2 class="auth-title">新規会員登録</h2>
      <p class="auth-step">STEP2 体重データの入力</p>
      <form class="auth-form" action="/register/step2" method="post" novalidate>
        @csrf
        <label class="auth-label">現在の体重</label>
        <div class="auth-unit">
          <input class="auth-input" type="text" inputmode="decimal" name="weight" placeholder="現在の体重を入力">
          <span class="auth-unit-text">kg</span>
        </div>
        <x-form-error field="weight" />

        <label class="auth-label">目標の体重</label>
        <div class="auth-unit">
          <input class="auth-input" type="text" inputmode="decimal" name="target_weight" placeholder="目標の体重を入力">
          <span class="auth-unit-text">kg</span>
        </div>
        <x-form-error field="target_weight" />

        <button class="auth-btn" type="submit">アカウント作成</button>
      </form>
    </div>
  </div>
@endsection
