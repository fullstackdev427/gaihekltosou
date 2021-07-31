
@extends('layouts.app')
@section('logo')
  <img class="logo-icon" src="/image/logo.png">
@endsection
@section('title')
<a class="text-white page-title" href="#">施工事例一覧</a>
@endsection
@section('content')
<div class="form-container user-favorite-list">
  <construction-case-list></construction-case-list>
</div>
@endsection