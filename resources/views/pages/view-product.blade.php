@extends('layouts.app')

@section('title', 'View Product')

@section('content')
    <x-products.view-product :allproducts="$productsall"  />
@endsection
