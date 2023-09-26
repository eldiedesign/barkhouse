{{--
  Template Name: Catalog
--}}

@extends('layouts.app')

@section('content')
  <?php $productCat = get_field('product_category');
  //$productCat = get_term($productCatId)->name;
  if($productCat == 'panels') { ?>
    @include('partials.catalog-panels')
  <?php } else { ?>
    @include('partials.catalog-slabs')
  <?php } ?>
@endsection