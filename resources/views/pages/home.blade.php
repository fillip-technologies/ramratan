@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
    <x-home.gold-rate-bar />
    <x-home.slider />
    <x-products.top-product :topproduct="$top_product"/>
     <x-home.banner-carousel/>
     <x-products.new-arrival :arrivalproduct="$new_arrival"/>
    <x-home.banner />
    <x-home.vertical-carousel />
    <x-products.featured :products="$products"/>
    {{-- <x-home.customization /> --}}
    <x-home.testimonials />
    <x-home.gallery />
    <x-home.faq />

@endsection


