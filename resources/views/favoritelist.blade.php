@extends('layouts.app')
@section('logo')
  <img class="logo-icon" src="/image/logo.png">
@endsection
@section('title')
  <h2 class="text-white" style="font-size:23px; font-weight:700; margin-bottom:0">お気に入り一覧</h2>
@endsection
@section('content')
<div class="form-container user-favorite-list">
  <user-favorite-list></user-favorite-list>
</div>
@endsection