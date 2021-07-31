@extends('layouts.app')
@section('title', '新規登録')
@section('content')
<div class="row">
  <div class="col d-flex justify-content-center">
    <h2>新規会員登録</h2>
  </div>
</div>

<div class="container-fluid d-flex justify-content-center">
  <div class="row form-container">
    <div class="col" style="text-align: center;">
      <h4>登録が完了しました。</h4>
      <a href="{{ route('user.login') }}" class="btn btn-primary btn-md btn-block mt-5" role="button" aria-disabled="true">ログイン画面へ</a>
    </div>
  </div>
</div>

@endsection