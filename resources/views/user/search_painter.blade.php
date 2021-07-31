@extends('layouts.app')

@section('logo')
  <a href="{{route('user.search_detail')}}" class="btn-bulk-quotation" role="button" aria-disabled="true">絞込み検索</a>
@endsection

@section('title')
  {{-- <painter-search-bar></painter-search-bar> --}}
@endsection

@section('logout')
<a href="/api/estimate" class="btn-bulk-quotation" role="button" aria-disabled="true">一括見積</a>
@endsection

@section('content')
<div class="form-container"  style="margin: auto !important;">
  <user-painter-list></user-painter-list>
</div>
@endsection
