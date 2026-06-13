@extends('layouts.admin')

@section('title', 'Add FAQ | Mega Carpets Admin')
@section('page_title', 'Add FAQ')

@section('content')

    <form method="POST" action="{{ route('admin.faqs.store') }}">
        @csrf
        @include('admin.faqs.partials.form')
    </form>

@endsection