@extends('layouts.frontend')

@section('title', 'Free Measure & Quote | Mega Carpets')
@section('meta_description', 'Book a free measure and quote for carpet, hybrid, timber, laminate, vinyl or window furnishings.')

@section('content')

    <style>
        .mq-wrapper {
            --mq-primary: #f58220;
            --mq-primary-dark: #d86d16;
            --mq-text: #332b29;
            --mq-muted: #7a706c;
            --mq-border: #ddd8d3;
            --mq-soft: #f7f2ec;
            --mq-input: #f6f5f4;
        }

        .mq-step {
            position: relative;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 28px;
            background: #eeeeee;
            border: 1px solid #bdbdbd;
            color: #888;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
            clip-path: polygon(0 0, calc(100% - 18px) 0, 100% 50%, calc(100% - 18px) 100%, 0 100%, 18px 50%);
            margin-left: -14px;
            transition: all .25s ease;
        }

        .mq-step:first-child {
            margin-left: 0;
            border-radius: 10px 0 0 10px;
            clip-path: polygon(0 0, calc(100% - 18px) 0, 100% 50%, calc(100% - 18px) 100%, 0 100%);
        }

        .mq-step:last-child {
            border-radius: 0 10px 10px 0;
        }

        .mq-step.is-active {
            background: var(--mq-primary);
            border-color: var(--mq-primary);
            color: #fff;
            z-index: 3;
        }

        .mq-input {
            width: 100%;
            min-height: 56px;
            border-radius: 14px;
            border: 1px solid transparent;
            background: var(--mq-input);
            padding: 14px 16px;
            color: var(--mq-text);
            outline: none;
            transition: .2s ease;
        }

        .mq-input:focus {
            border-color: var(--mq-primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(245, 130, 32, .12);
        }

        .mq-label {
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
            font-weight: 500;
            color: var(--mq-text);
        }

        .mq-required {
            color: #e3342f;
        }

        .mq-check {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 15px;
            color: var(--mq-text);
            cursor: pointer;
            user-select: none;
        }

        .mq-check input {
            width: 18px;
            height: 18px;
            accent-color: var(--mq-primary);
        }

        .mq-btn {
            min-height: 52px;
            padding: 0 30px;
            border-radius: 999px;
            font-size: 15px;
            font-weight: 800;
            transition: .25s ease;
        }

        .mq-btn-primary {
            background: var(--mq-primary);
            color: #fff;
            box-shadow: 0 14px 30px rgba(245, 130, 32, .25);
        }

        .mq-btn-primary:hover {
            background: var(--mq-primary-dark);
            transform: translateY(-1px);
        }

        .mq-btn-outline {
            border: 1px solid #8d8581;
            color: var(--mq-text);
            background: #fff;
        }

        .mq-btn-outline:hover {
            border-color: var(--mq-primary);
            color: var(--mq-primary);
        }

        .mq-panel {
            display: none;
        }

        .mq-panel.is-active {
            display: block;
        }

        @media (max-width: 640px) {
            .mq-step {
                height: 38px;
                padding: 0 18px;
                font-size: 10px;
            }
        }
    </style>

    <section class="mq-wrapper bg-mega-cream py-12 md:py-16">
        <div class="site-container">

            <div class="text-center">
                <div class="section-label">Free measure & quote</div>
                <h1 class="mx-auto max-w-5xl text-3xl font-black uppercase tracking-[0.08em] text-mega-text md:text-3xl">
                    Book a free measure & quote
                </h1>
            </div>

            <div class="my-10 h-px w-full bg-black/10"></div>

            @if(session('quote_success'))
                <div
                    class="mb-8 rounded-[18px] border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-800">
                    {{ session('quote_success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-8 rounded-[18px] border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                    Please check the required fields and try again.
                </div>
            @endif

            <form id="measureQuoteForm" method="POST" action="{{ route('frontend.quote-requests.store') }}"
                class="grid gap-10 lg:grid-cols-[0.92fr_1.08fr]">
                @csrf

                <div>
                    <div class="mb-8 flex max-w-3xl overflow-hidden">
                        <button type="button" class="mq-step is-active flex-1" data-step-tab="1">Your Details</button>
                        <button type="button" class="mq-step flex-1" data-step-tab="2">Job Details</button>
                        <button type="button" class="mq-step flex-1" data-step-tab="3">Booking Details</button>
                    </div>

                    <div class="mq-panel is-active" data-step-panel="1">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mq-label">First Name <span class="mq-required">*</span></label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="mq-input"
                                    required>
                                @error('first_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="mq-label">Last Name <span class="mq-required">*</span></label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="mq-input"
                                    required>
                                @error('last_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mq-label">Email <span class="mq-required">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" class="mq-input" required>
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mq-label">Phone <span class="mq-required">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="mq-input" required>
                                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mq-label">Company/Organisation</label>
                                <input type="text" name="company" value="{{ old('company') }}" class="mq-input">
                            </div>

                            <div class="md:col-span-2">
                                <label class="mq-label">Preferred method of contact</label>

                                @php $oldContact = old('preferred_contact', []); @endphp

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <label class="mq-check">
                                        <input type="checkbox" name="preferred_contact[]" value="email"
                                            @checked(in_array('email', $oldContact))>
                                        <span>E-mail</span>
                                    </label>

                                    <label class="mq-check">
                                        <input type="checkbox" name="preferred_contact[]" value="phone"
                                            @checked(in_array('phone', $oldContact))>
                                        <span>Phone</span>
                                    </label>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label class="mq-check">
                                    <input type="checkbox" name="subscribe" value="1" @checked(old('subscribe', 1))>
                                    <span>Yes, please subscribe me for inspiration, new products & sales</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end border-t border-black/10 pt-8">
                            <button type="button" class="mq-btn mq-btn-primary" data-next-step>Next</button>
                        </div>
                    </div>

                    <div class="mq-panel" data-step-panel="2">
                        <div class="space-y-8">
                            <div>
                                <label class="mq-label">Type of Job <span class="mq-required">*</span></label>

                                @php $oldJobTypes = old('job_type', []); @endphp

                                <div class="space-y-3" data-required-group="job_type">
                                    <label class="mq-check">
                                        <input type="checkbox" name="job_type[]" value="residential"
                                            @checked(in_array('residential', $oldJobTypes))>
                                        <span>Residential</span>
                                    </label>

                                    <label class="mq-check">
                                        <input type="checkbox" name="job_type[]" value="commercial"
                                            @checked(in_array('commercial', $oldJobTypes))>
                                        <span>Commercial</span>
                                    </label>
                                </div>

                                @error('job_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="mq-label">Address for installation <span class="mq-required">*</span></label>
                                <input type="text" name="installation_address" value="{{ old('installation_address') }}"
                                    class="mq-input" required>
                                @error('installation_address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-5 md:grid-cols-[1fr_0.5fr]">
                                <div>
                                    <label class="mq-label">Suburb <span class="mq-required">*</span></label>
                                    <input type="text" name="suburb" value="{{ old('suburb') }}" class="mq-input" required>
                                    @error('suburb') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="mq-label">Postcode <span class="mq-required">*</span></label>
                                    <input type="text" name="postcode" value="{{ old('postcode') }}" class="mq-input"
                                        required>
                                    @error('postcode') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="mq-label">Which rooms/areas do you need covered? <span
                                        class="mq-required">*</span></label>

                                @php $oldRooms = old('rooms', []); @endphp

                                <div class="grid gap-3 sm:grid-cols-2" data-required-group="rooms">
                                    @foreach(['Bedroom', 'Walk/built-in robes', 'Lounge', 'Kitchen', 'Study', 'Bathroom', 'Laundry', 'Extra room', 'Hallway', 'Stairs'] as $room)
                                        <label class="mq-check">
                                            <input type="checkbox" name="rooms[]" value="{{ $room }}" @checked(in_array($room, $oldRooms))>
                                            <span>{{ $room }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                @error('rooms') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="mq-label">What type of products are you interested in? <span
                                        class="mq-required">*</span></label>

                                @php $oldProducts = old('products', []); @endphp

                                <div class="grid gap-3 sm:grid-cols-2" data-required-group="products">
                                    @foreach(['Carpet', 'Timber', 'Hybrid', 'Laminate', 'Vinyl', 'Windows Furnishings'] as $product)
                                        <label class="mq-check">
                                            <input type="checkbox" name="products[]" value="{{ $product }}"
                                                @checked(in_array($product, $oldProducts))>
                                            <span>{{ $product }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                @error('products') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mt-8 flex items-center justify-between border-t border-black/10 pt-8">
                            <button type="button" class="mq-btn mq-btn-outline" data-prev-step>Back</button>
                            <button type="button" class="mq-btn mq-btn-primary" data-next-step>Next</button>
                        </div>
                    </div>

                    <div class="mq-panel" data-step-panel="3">
                        <div class="space-y-8">
                            <div>
                                <label class="mq-label">What days are most suitable for you? <span
                                        class="mq-required">*</span></label>

                                @php $oldDays = old('suitable_days', []); @endphp

                                <div class="grid gap-3 sm:grid-cols-2" data-required-group="suitable_days">
                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                        <label class="mq-check">
                                            <input type="checkbox" name="suitable_days[]" value="{{ $day }}"
                                                @checked(in_array($day, $oldDays))>
                                            <span>{{ $day }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                @error('suitable_days') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="mq-label">
                                    How did you hear about us? <span class="mq-required">*</span>
                                </label>

                                @php
                                    $hearAboutOptions = [
                                        'Google',
                                        'Facebook',
                                        'Instagram',
                                        'Previous Customer',
                                        'Word of Mouth',
                                        'Other',
                                    ];
                                @endphp

                                <select name="local_store" class="mq-input" required>
                                    <option value="" disabled @selected(!old('local_store'))>
                                        Select an option
                                    </option>

                                    @foreach($hearAboutOptions as $option)
                                        <option value="{{ $option }}" @selected(old('local_store') === $option)>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('local_store')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <div class="mb-5 hidden" data-selected-products-wrap>
                                    <div class="rounded-[14px] border border-orange-200 bg-orange-50/40 p-5">
                                        <div class="mb-4 flex items-center justify-between gap-4">
                                            <div>
                                                <p class="text-xs font-black uppercase tracking-[0.22em] text-mega-orange">
                                                    Selected products
                                                </p>

                                                <h3 class="mt-1 text-xl font-black text-mega-black">
                                                    Products added to quote
                                                </h3>
                                            </div>

                                            <span data-selected-products-count
                                                class="rounded-full bg-mega-orange px-3 py-1 text-xs font-black text-white">
                                                0 item
                                            </span>
                                        </div>

                                        <div class="space-y-3" data-selected-products-preview></div>

                                        <p
                                            class="mt-4 rounded-[7px] bg-white px-4 py-3 text-xs font-semibold leading-5 text-mega-muted">
                                            Final quote may change after measurement, installation requirements,
                                            preparation, underlay and product availability.
                                        </p>
                                    </div>
                                </div>

                                <label class="mq-label">Additional Comments</label>

                                <textarea data-customer-note rows="5" class="mq-input min-h-[130px] resize-none"
                                    placeholder="Tell us about your project, preferred products, budget, timeline or any special requirements...">{{ old('comments') }}</textarea>

                                <input type="hidden" name="comments" data-quote-message value="{{ old('comments') }}">
                            </div>

                            <p class="text-sm font-medium text-mega-text">
                                Please see our
                                <a href="#" class="font-bold text-mega-orange underline underline-offset-4">
                                    privacy collection notice
                                </a>
                            </p>
                        </div>

                        <div class="mt-8 flex items-center justify-between border-t border-black/10 pt-8">
                            <button type="button" class="mq-btn mq-btn-outline" data-prev-step>Back</button>
                            <button type="submit" class="mq-btn mq-btn-primary">Book now</button>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-black/10 pt-6 text-[15px] leading-7 text-mega-text/80">
                        <p>
                            Mega Carpets' free measure and quote is completely obligation-free. You pay nothing, there is no
                            deposit, and you are under no pressure to commit.
                        </p>
                        <p class="mt-2">
                            Our quote service covers carpet, timber, hybrid, laminate, vinyl and window furnishings for both
                            residential and commercial properties. You do not need to know exactly what you want beforehand.
                            That is what we are here for.
                        </p>
                    </div>
                </div>

                <div class="lg:sticky lg:top-28 lg:self-start">
                    <div class="overflow-hidden rounded-[28px] bg-white shadow-xl shadow-black/10">
                        <img src="/images/Background Pic 1.webp" alt="Modern flooring consultation room"
                            class="h-[420px] w-full object-cover md:h-[560px] lg:h-[720px]">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('measureQuoteForm');
            if (!form) return;

            const tabs = form.querySelectorAll('[data-step-tab]');
            const panels = form.querySelectorAll('[data-step-panel]');
            const nextButtons = form.querySelectorAll('[data-next-step]');
            const prevButtons = form.querySelectorAll('[data-prev-step]');

            let currentStep = 1;

            function showStep(step) {
                currentStep = step;

                tabs.forEach(tab => {
                    const tabStep = Number(tab.dataset.stepTab);
                    tab.classList.toggle('is-active', tabStep <= currentStep);
                });

                panels.forEach(panel => {
                    const panelStep = Number(panel.dataset.stepPanel);
                    panel.classList.toggle('is-active', panelStep === currentStep);
                });

                window.scrollTo({
                    top: form.getBoundingClientRect().top + window.scrollY - 130,
                    behavior: 'smooth'
                });
            }

            function validateCurrentStep() {
                const activePanel = form.querySelector(`[data-step-panel="${currentStep}"]`);
                const requiredFields = activePanel.querySelectorAll('input[required], textarea[required], select[required]');

                for (const field of requiredFields) {
                    if (!field.checkValidity()) {
                        field.reportValidity();
                        return false;
                    }
                }

                const requiredGroups = activePanel.querySelectorAll('[data-required-group]');

                for (const group of requiredGroups) {
                    const checked = group.querySelectorAll('input[type="checkbox"]:checked').length;

                    if (!checked) {
                        const label = group.previousElementSibling;
                        alert(`Please select at least one option for "${label ? label.innerText.replace('*', '').trim() : 'this field'}".`);
                        return false;
                    }
                }

                return true;
            }

            nextButtons.forEach(button => {
                button.addEventListener('click', function () {
                    if (!validateCurrentStep()) return;
                    showStep(Math.min(currentStep + 1, 3));
                });
            });

            prevButtons.forEach(button => {
                button.addEventListener('click', function () {
                    showStep(Math.max(currentStep - 1, 1));
                });
            });

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    const targetStep = Number(tab.dataset.stepTab);

                    if (targetStep <= currentStep) {
                        showStep(targetStep);
                        return;
                    }

                    if (validateCurrentStep()) {
                        showStep(targetStep);
                    }
                });
            });
        });
    </script>

@endsection