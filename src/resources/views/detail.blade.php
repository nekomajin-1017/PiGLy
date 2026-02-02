@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{asset('css/setting.css')}}">
@endsection

@section('contents')
  <div class="setting-page setting-page-modal">
    <div class="setting-card setting-card-wide">
      <h2 class="setting-title">Weight Log</h2>
      <form id="detail-update-form" class="setting-form" action="/weight_logs/{{$record->id}}/update" method="post" novalidate>
        @csrf
        @method('PATCH')
        <x-form-row label="日付" field="date">
          <input class="form-input" id="date" type="date" name="date" value="{{old('date', $record->date ? $record->date->format('Y-m-d') : '')}}">
        </x-form-row>
        <x-form-row label="体重" field="weight">
          <div class="input-unit">
            <input class="form-input" id="weight" type="number" inputmode="decimal" step="0.1" name="weight" value="{{old('weight', $record->weight)}}">
            <span class="unit-text">kg</span>
          </div>
        </x-form-row>
        <x-form-row label="摂取カロリー" field="calories">
          <div class="input-unit">
            <input class="form-input" id="calories" type="number" inputmode="numeric" step="1" min="0" name="calories" value="{{old('calories', $record->calories)}}">
            <span class="unit-text">cal</span>
          </div>
        </x-form-row>
        <x-form-row label="運動時間" field="exercise_time">
          <input class="form-input" id="exercise_time" type="time" name="exercise_time" value="{{old('exercise_time', $record->exercise_time ? $record->exercise_time->format('H:i') : '')}}">
        </x-form-row>
        <x-form-row label="運動内容" field="exercise_content">
          <textarea class="form-textarea" id="exercise_content" name="exercise_content" placeholder="運動内容を追加">{{old('exercise_content', $record->exercise_content)}}</textarea>
        </x-form-row>
      </form>
      <div class="form-actions form-actions-wide">
        <a class="btn btn-ghost" href="/weight_logs">戻る</a>
        <button class="btn btn-primary" type="submit" form="detail-update-form">更新</button>
        <form class="inline-form" action="/weight_logs/{{$record->id}}/delete" method="post">
          @csrf
          @method('DELETE')
          <button class="btn btn-icon" type="submit" aria-label="削除">🗑</button>
        </form>
      </div>
    </div>
  </div>
@endsection
