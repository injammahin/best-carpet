@extends('layouts.admin')

@section('title', 'Edit FAQ | Mega Carpets Admin')
@section('page_title', 'Edit FAQ')

@section('content')

    <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
        @csrf
        @method('PUT')
        @include('admin.faqs.partials.form')
    </form>

@endsection