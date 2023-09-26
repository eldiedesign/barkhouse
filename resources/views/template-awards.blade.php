{{--
  Template Name: Certificates & Awards
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
    @include('partials.awards')
  @endwhile
@endsection
