@extends('layouts.admin')

@section('title', 'Add Special Promo | Mega Carpets Admin')
@section('page_title', 'Add Special Promo')

@section('content')
    @include('admin.special-promos.partials.form', [
        'promo' => $promo,
        'action' => route('admin.special-promos.store'),
        'method' => 'POST',
    ])
@endsection