@extends('layouts.admin')

@section('title', 'Add Product | Mega Carpets Admin')
@section('page_title', 'Add Product')

@section('content')

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        @include('admin.products.partials.form')
    </form>

@endsection