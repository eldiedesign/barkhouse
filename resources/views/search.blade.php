@extends('layouts.app')

@section('content')

  @if (!have_posts())
    <div class="container no-search-results">
      <div class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      <form role="search" method="get" class="inline-search" action="/">
        <label>
          <span class="screen-reader-text">Search for:</span>
          <input type="search" class="search-field" placeholder="Search …" value="" name="s">
        </label>
        <input type="submit" class="search-submit" value="Search">
      </form>
    </div>
  @endif

  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-search')
  @endwhile
  <div class="container posts-navigation-wrap">
    {!! get_the_posts_navigation() !!}
  </div>
@endsection
