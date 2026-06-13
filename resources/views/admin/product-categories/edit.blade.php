@extends('layouts.admin')

@section('title', 'Edit Category | Mega Carpets Admin')
@section('page_title', 'Edit Category')

@section('content')

    <form method="POST" action="{{ route('admin.product-categories.update', $category) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.product-categories.partials.form')
    </form>

@endsection