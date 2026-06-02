@extends('layouts.frontend')

@section('title', 'Free Measure & Quote | Mega Carpets')
@section('meta_description', 'Book a free measure and quote for carpet, hybrid, timber, laminate, vinyl or rugs.')

@section('content')

    <section class="bg-mega-cream py-16 md:py-24">
        <div class="site-container">
            <div class="grid gap-10 lg:grid-cols-[0.85fr_1.15fr]">
                <div>
                    <div class="section-label">Free measure & quote</div>
                    <h1 class="section-title">Request flooring advice before making a decision.</h1>
                    <p class="section-text">
                        This page is built for lead generation. Later it will store requests in the database and show them
                        in the admin panel.
                    </p>

                    <div class="mt-8 space-y-4">
                        @foreach(['Free local measure request', 'Mobile showroom visit option', 'Upload existing quote can be added later', 'Admin lead tracking later'] as $point)
                            <div class="flex gap-3">
                                <svg class="thin-icon mt-1 text-mega-orange" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                <p class="text-sm leading-6">{{ $point }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <form class="clean-card bg-white p-6 md:p-8">
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Full name</label>
                            <input type="text" class="input-clean" placeholder="Your name">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Phone number</label>
                            <input type="text" class="input-clean" placeholder="Phone number">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Email address</label>
                            <input type="email" class="input-clean" placeholder="Email address">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Suburb or postcode</label>
                            <input type="text" class="input-clean" placeholder="Melbourne, Essendon, Niddrie">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Product interest</label>
                            <select class="input-clean">
                                <option>Carpet</option>
                                <option>Hybrid Flooring</option>
                                <option>Timber</option>
                                <option>Laminate</option>
                                <option>Vinyl</option>
                                <option>Rugs</option>
                                <option>Not sure yet</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Preferred service</label>
                            <select class="input-clean">
                                <option>Free measure & quote</option>
                                <option>Mobile showroom visit</option>
                                <option>Product enquiry</option>
                                <option>Commercial flooring</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-mega-text">Project details</label>
                            <textarea rows="5" class="input-clean"
                                placeholder="Tell us about room size, preferred product, property type or timeline"></textarea>
                        </div>
                    </div>

                    <button type="button" class="btn-primary mt-6">
                        Submit request
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection