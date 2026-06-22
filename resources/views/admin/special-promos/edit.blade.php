@extends('layouts.admin')

@section('title', 'Edit Special Promo | Mega Carpets Admin')
@section('page_title', 'Edit Special Promo')

@section('content')
    @include('admin.special-promos.partials.form', [
        'promo' => $promo,
        'action' => route('admin.special-promos.update', $promo),
        'method' => 'PUT',
    ])
@endsection