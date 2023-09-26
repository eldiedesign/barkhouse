@extends('layouts.app-home')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.home-banner')
    @include('partials.home-products')
    @include('partials.home-recognition')
    @include('partials.home-media')
    @include('partials.home-accordion')
    @include('partials.home-logos')
    @include('partials.home-production')
  @endwhile
@endsection