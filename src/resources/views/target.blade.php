@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{asset('css/setting.css')}}">
@endsection

@section('contents')
  <div class="setting-page setting-page-modal">
    <div class="setting-card">
      <h2 class="setting-title">目標体重設定</h2>
      <form class="setting-form" action="/wight_logs/goal_setting" method="post" novalidate>
        @csrf
        <div class="form-row">
          <div class="input-unit">
            <input class="form-input" type="text" inputmode="decimal" name="target_weight" value="{{old('target_weight', $targetWeight ?? '')}}">
            <span class="unit-text">kg</span>
          </div>
          <x-form-error field="target_weight" />
        </div>
        <div class="form-actions">
          <a class="btn btn-ghost" href="/weight_logs">戻る</a>
          <button class="btn btn-primary" type="submit">更新</button>
        </div>
      </form>
    </div>
  </div>
@endsection
