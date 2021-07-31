
@extends('layouts.app')
@section('logo')
  <img class="logo-icon" src="/image/logo.png">
@endsection
@section('title')
<a class="text-white page-title" href="#">コラム一覧</a>
@endsection
@section('content')
<div class="form-container">
  <painter-column-list></painter-column-list>
</div>
@endsection