@extends('layouts.frontend')

@section('title', 'Mobile Showroom | Mega Carpets')
@section('meta_description', 'Request a mobile showroom visit and compare flooring samples at home.')

@section('content')

    <section class="bg-mega-cream py-16 md:py-24">
        <div class="site-container">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <div>
                    <div class="section-label">Mobile showroom</div>
                    <h1 class="section-title">See flooring samples in your own home.</h1>
                    <p class="section-text">
                        A mobile showroom page is important because customers want to see colour, texture and lighting
                        before making a flooring decision.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('frontend.quote') }}" class="btn-primary">Request visit</a>
                        <a href="{{ route('frontend.products') }}" class="btn-light">Browse products</a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80"
                        alt="Home flooring consultation" class="h-[430px] w-full object-cover radius-7">
                    <div class="space-y-4">
                        <img src="https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=900&q=80"
                            alt="Flooring samples" class="h-[207px] w-full object-cover radius-7">
                        <div class="bg-mega-black p-6 text-white radius-7">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">At home</p>
                            <h2 class="mt-3 text-2xl leading-tight text-white">
                                Compare samples in real light.
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-20">
        <div class="site-container">
            <div class="grid gap-5 md:grid-cols-3">
                @foreach([
                        ['step' => '01', 'title' => 'Tell us your room', 'text' => 'Customer shares property type, room size and flooring interest.'],
                        ['step' => '02', 'title' => 'Compare samples', 'text' => 'Mega Carpets brings suitable flooring samples to the home.'],
                        ['step' => '03', 'title' => 'Get clear quote', 'text' => 'Customer receives advice, measure details and installation support.'],
                    ] as $item)
                    <div class="clean-card p-6">
                            <p class="text-sm font-medium text-mega-orange">{{ $item['step'] }}</p>
                            <h3 class="mt-4 text-2xl">{{ $item['title'] }}</h3>
                            <p class="mt-3 text-sm leading-6">{{ $item['text'] }}</p>
                        </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection