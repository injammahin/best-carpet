@extends('layouts.admin')

@section('title', 'Edit Product | Mega Carpets Admin')
@section('page_title', 'Edit Product')

@section('content')

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.products.partials.form')
    </form>

@endsection