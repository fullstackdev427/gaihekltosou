@extends('layouts.app')
@section('content')
@section('title','会社プロフィール')

<div class="d-flex justify-content-center">
  <div class="row content-container">
    <div class="col" style="background-color: red; text-align: center; color: white;">
      プレビュー
    </div>
  </div>
</div>

<div class="container-fluid d-flex justify-content-center">
  <div class="row content-container">
    <div class="col">
      <painter-preview :painter_id="{{ $painter->id }}"></painter-preview>
    </div>
  </div>
</div>

@endsection