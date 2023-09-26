{{--
  Template Name: Product Gallery Landing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    
    @include('partials.product-galleries-landing')
  @endwhile
@endsection
