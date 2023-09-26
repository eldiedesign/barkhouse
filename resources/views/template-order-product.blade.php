{{--
  Template Name: Order Product
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
<input type="hidden" id="pageslug" value="<?= $post->post_name ?>"/>