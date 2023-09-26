

@extends('layouts.app')

@section('content')
@if (!have_posts())
<div class="container error-wrap">
  
  <p>{{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}</p>
  <form role="search" method="get" class="inline-search" action="/">
    <label>
      <span class="screen-reader-text">Search for:</span>
      <input type="search" class="search-field" placeholder="Search …" value="" name="s">
    </label>
    <input type="submit" class="search-submit" value="Search">
  </form>
</div>
@endif
@endsection