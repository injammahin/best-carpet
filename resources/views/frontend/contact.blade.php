@extends('layouts.frontend')

@section('title', 'Contact | Mega Carpets')
@section('meta_description', 'Contact Mega Carpets for flooring advice, product enquiries and free measure and quote.')

@section('content')

    <section class="bg-mega-cream py-16 md:py-24">
        <div class="site-container">
            <div class="grid gap-10 lg:grid-cols-[0.85fr_1.15fr]">
                <div>
                    <div class="section-label">Contact</div>
                    <h1 class="section-title">Talk to Mega Carpets about your flooring project.</h1>
                    <p class="section-text">
                        Use this page for general product enquiries, showroom questions, service area questions and quote
                        requests.
                    </p>

                    <div class="mt-8 grid gap-4">
                        <div class="clean-card bg-white p-5">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">Phone</p>
                            <h2 class="mt-2 text-2xl">1300 131 196</h2>
                        </div>

                        <div class="clean-card bg-white p-5">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">Email</p>
                            <h2 class="mt-2 text-2xl">hello@example.com</h2>
                        </div>

                        <div class="clean-card bg-white p-5">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">Service</p>
                            <h2 class="mt-2 text-2xl">Melbourne focused flooring support</h2>
                        </div>
                    </div>
                </div>

                <form class="clean-card bg-white p-6 md:p-8">
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Full name</label>
                            <input type="text" class="input-clean" placeholder="Your name">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Phone</label>
                            <input type="text" class="input-clean" placeholder="Phone number">
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-mega-text">Email</label>
                            <input type="email" class="input-clean" placeholder="Email address">
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-mega-text">Message</label>
                            <textarea rows="6" class="input-clean" placeholder="How can we help?"></textarea>
                        </div>
                    </div>

                    <button type="button" class="btn-primary mt-6">
                        Send message
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection