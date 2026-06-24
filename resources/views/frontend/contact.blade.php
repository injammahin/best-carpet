@extends('layouts.frontend')

@section('title', 'Contact | Mega Carpets')
@section('meta_description', 'Contact Mega Carpets for flooring advice, product enquiries and free measure and quote.')

@section('content')

    <section class="bg-mega-cream py-16 md:py-24">
        <div class="site-container">
            <div class="grid gap-10 lg:grid-cols-[0.85fr_1.15fr]">
                <div>
                    <div class="section-label">Contact</div>

                    <h1 class="section-title">
                        Talk to Mega Carpets about your flooring project.
                    </h1>

                    <p class="section-text">
                        Use this page for general product enquiries, showroom questions, service area questions and quote
                        requests.
                    </p>

                    <div class="mt-8 grid gap-4">
                        <div class="clean-card bg-white p-5">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">Phone</p>

                            <h2 class="mt-2 text-2xl">
                                <a href="tel:1300131196" class="transition hover:text-mega-orange">
                                    1300 131 196
                                </a>
                            </h2>
                        </div>

                        <div class="clean-card bg-white p-5">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">Email</p>

                            <h2 class="mt-2 text-2xl">
                                <a href="mailto:sales@megacarpet.com.au" class="transition hover:text-mega-orange">
                                    sales@megacarpet.com.au
                                </a>
                            </h2>
                        </div>

                        <div class="clean-card bg-white p-5">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">Service</p>

                            <h2 class="mt-2 text-2xl">
                                Melbourne focused flooring support
                            </h2>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('frontend.quick-quote.store') }}"
                    class="clean-card bg-white p-6 md:p-8">
                    @csrf

                    @if(session('quick_quote_success'))
                        <div
                            class="mb-5 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">
                            {{ session('quick_quote_success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div
                            class="mb-5 rounded-[14px] border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                            Please check the form fields and try again.
                        </div>
                    @endif

                    <input type="hidden" name="product_category" value="Contact Enquiry">
                    <input type="hidden" name="room" value="General Enquiry">
                    <input type="hidden" name="approximate_size" value="Not provided from contact page">

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">
                                Full name
                            </label>

                            <input type="text" name="full_name" value="{{ old('full_name') }}" class="input-clean"
                                placeholder="Your name" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">
                                Phone
                            </label>

                            <input type="text" name="phone" value="{{ old('phone') }}" class="input-clean"
                                placeholder="Phone number" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-mega-text">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}" class="input-clean"
                                placeholder="Email address" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-mega-text">
                                Message
                            </label>

                            <textarea rows="6" name="message" class="input-clean"
                                placeholder="How can we help?">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary mt-6">
                        Send message
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection