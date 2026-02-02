@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

@section('contents')
  <div class="page">
    <section class="summary-card">
      <dl class="summary">
        <div class="summary-item">
          <dt class="summary-label">目標体重</dt>
          <dd class="summary-value">{{$records->target_weight}}<span class="unit-kg">kg</span></dd>
        </div>
        <div class="summary-item">
          <dt class="summary-label">目標まで</dt>
          <dd class="summary-value">{{$records->target_diff}}<span class="unit-kg">kg</span></dd>
        </div>
        <div class="summary-item">
          <dt class="summary-label">最新体重</dt>
          <dd class="summary-value">{{$records->latest_weight}}<span class="unit-kg">kg</span></dd>
        </div>
      </dl>
    </section>

    <section class="card">
      <div class="toolbar">
        <form class="search-form" action="/weight_logs/search" method="get">
          <input class="input-date" type="date" name="from" value="{{ old('from', request('from')) }}">
          <span class="range-sep">〜</span>
          <input class="input-date" type="date" name="to" value="{{ old('to', request('to')) }}">
          <button class="btn btn-search" type="submit">検索</button>
        </form>
        <label class="btn btn-primary" for="modal-toggle">データ追加</label>
      </div>

      <div class="table-wrap">
        <table class="record-table">
          <thead>
            <tr class="record-table-row record-table-row-head">
              <th class="record-table-head">日付</th>
              <th class="record-table-head">体重</th>
              <th class="record-table-head">食事摂取カロリー</th>
              <th class="record-table-head">運動時間</th>
              <th class="record-table-head"></th>
            </tr>
          </thead>
          <tbody>
            @forelse($records as $record)
              <tr class="record-table-row">
                <td class="record-table-cell">
                  {{$record->date ? $record->date->format('Y/m/d') : ''}}
                </td>
                <td class="record-table-cell">{{$record->weight}}<span class="unit-kg">kg</span></td>
                <td class="record-table-cell">{{$record->calories}}<span class="unit-cal">cal</span></td>
                <td class="record-table-cell">
                  {{$record->exercise_time ? $record->exercise_time->format('H:i') : ''}}
                </td>
                <td class="record-table-cell cell-edit">
                  <a class="edit-btn" href="/weight_logs/{{$record->id}}" aria-label="編集">✎</a>
                </td>
              </tr>
            @empty
              <tr class="record-table-row">
                <td class="record-table-cell empty" colspan="5">データがありません</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if ($records->lastPage() > 1)
        <div class="pagination">
          <a class="pagination-item {{ $records->onFirstPage() ? 'is-disabled' : '' }}" href="{{ $records->previousPageUrl() ?? '#' }}">&lt;</a>
          @for ($i = 1; $i <= $records->lastPage(); $i++)
            <a class="pagination-item {{ $records->currentPage() === $i ? 'is-active' : '' }}" href="{{ $records->url($i) }}">{{ $i }}</a>
          @endfor
          <a class="pagination-item {{ $records->hasMorePages() ? '' : 'is-disabled' }}" href="{{ $records->nextPageUrl() ?? '#' }}">&gt;</a>
        </div>
      @endif
    </section>
  </div>

  <input id="modal-toggle" class="modal-toggle" type="checkbox" {{ $errors->any() ? 'checked' : '' }}>
  <div class="modal">
    <label class="modal-backdrop" for="modal-toggle"></label>
    <div class="modal-content">
      <h2 class="modal-title">Weight Logを追加</h2>
      <form class="modal-form" action="/weight_logs/create" method="post" novalidate>
        @csrf
        <x-form-row label="日付" field="date" required>
          <input class="form-input" id="date" type="date" name="date" value="{{old('date')}}">
        </x-form-row>
        <x-form-row label="体重" field="weight" required>
          <div class="input-unit">
            <input class="form-input" id="weight" type="number" inputmode="decimal" step="0.1" name="weight" value="{{old('weight')}}">
            <span class="unit-text">kg</span>
          </div>
        </x-form-row>
        <x-form-row label="摂取カロリー" field="calories" required>
          <div class="input-unit">
            <input class="form-input" id="calories" type="number" inputmode="numeric" step="1" min="0" name="calories" value="{{old('calories')}}">
            <span class="unit-text">cal</span>
          </div>
        </x-form-row>
        <x-form-row label="運動時間" field="exercise_time" required>
          <input class="form-input" id="exercise_time" type="time" name="exercise_time" value="{{old('exercise_time')}}">
        </x-form-row>
        <x-form-row label="運動内容" field="exercise_content">
          <textarea class="form-textarea" id="exercise_content" name="exercise_content">{{old('exercise_content')}}</textarea>
        </x-form-row>
        <div class="modal-actions">
          <label class="btn btn-ghost" for="modal-toggle">戻る</label>
          <button class="btn btn-primary" type="submit">登録</button>
        </div>
      </form>
    </div>
  </div>
@endsection
