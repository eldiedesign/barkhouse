{{--
  Template Name: Media Coverage Landing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.media-coverage-landing')
  @endwhile
@endsection