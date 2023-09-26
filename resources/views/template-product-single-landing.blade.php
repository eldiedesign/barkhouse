{{--
  Template Name: Product Single Landing Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="editor-content">
      <div class="container">
        <?php the_post(); ?>

        @include('partials.content-single-product-landing')
        
      </div>
    </section>

  @endwhile
@endsection
