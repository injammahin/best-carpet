@extends('layouts.admin')

@section('title', 'Add Category | Mega Carpets Admin')
@section('page_title', 'Add Category')

@section('content')

    <form method="POST" action="{{ route('admin.product-categories.store') }}" enctype="multipart/form-data">
        @csrf

        @include('admin.product-categories.partials.form')
    </form>

@endsection