@extends('layouts.app')

@section('content')
  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
  @endif
  <?php if(is_category()) {
    $qo = get_queried_object();
    echo "<h1 class='entry-title'>Category: {$qo->cat_name}</h1>";
  } ?>
  <section class="blog-grid">
    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-'.get_post_type())
    @endwhile
  </section>
  @include('partials.posts-navigation')
@endsection