{{--
  Template Name: Media Coverage
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.media-coverage')
  @endwhile
@endsection