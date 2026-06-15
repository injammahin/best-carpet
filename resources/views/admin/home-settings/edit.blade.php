@extends('layouts.admin')

@section('title', 'Home Page Settings')

@section('content')
    @php
        $heroSlides = $homeSetting->hero_slides ?: \App\Models\HomePageSetting::defaultHeroSlides();
        $recentWorks = $homeSetting->recent_work_concepts ?: \App\Models\HomePageSetting::defaultRecentWork();
        $shopRoomItems = $homeSetting->shop_room_items ?: \App\Models\HomePageSetting::defaultData()['shop_room_items'];
        $visualizerFeatures = implode("\n", $homeSetting->visualizer_features ?: \App\Models\HomePageSetting::defaultData()['visualizer_features']);
    @endphp

    <div class="min-h-screen bg-[#f7f3ed] px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex flex-col justify-between gap-4 lg:flex-row lg:items-end">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-orange-600">
                        Admin control
                    </p>

                    <h1 class="mt-2 text-4xl font-black tracking-[-0.05em] text-zinc-950">
                        Home Page Settings
                    </h1>

                    <p class="mt-3 max-w-2xl text-base leading-7 text-zinc-600">
                        Manage hero slides, visualiser image, shop the room image, recent work cards and quote section
                        image.
                    </p>
                </div>

                <a href="{{ route('frontend.home') }}" target="_blank"
                    class="inline-flex items-center justify-center rounded-[7px] border border-zinc-200 bg-white px-5 py-3 text-sm font-bold text-zinc-900 shadow-sm hover:border-orange-500 hover:text-orange-600">
                    View homepage
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-[7px] border border-green-200 bg-green-50 px-5 py-4 text-sm font-bold text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-[7px] border border-red-200 bg-red-50 px-5 py-4 text-sm font-bold text-red-700">
                    Please check the form fields and try again.
                </div>
            @endif

            <form method="POST" action="{{ route('admin.home-settings.update') }}" enctype="multipart/form-data"
                class="space-y-8">
                @csrf
                @method('PUT')

                <section class="rounded-[18px] border border-zinc-200 bg-white p-6 shadow-[0_20px_80px_rgba(7,7,7,.06)]">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.22em] text-orange-600">
                                Hero
                            </p>

                            <h2 class="mt-1 text-2xl font-black text-zinc-950">
                                Hero slides and side images
                            </h2>
                        </div>

                        <button type="button" data-add-slide
                            class="rounded-[7px] bg-orange-600 px-4 py-3 text-sm font-black text-white hover:bg-orange-700">
                            Add slide
                        </button>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-zinc-800">
                                Right side van image
                            </label>

                            <input type="hidden" name="hero_side_image_one_existing"
                                value="{{ $homeSetting->hero_side_image_one }}">

                            <input type="file" name="hero_side_image_one_file"
                                class="w-full rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">

                            @if($homeSetting->imageUrl($homeSetting->hero_side_image_one))
                                <img src="{{ $homeSetting->imageUrl($homeSetting->hero_side_image_one) }}"
                                    class="mt-3 h-36 w-full rounded-[7px] object-cover">
                            @endif
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-zinc-800">
                                Right side mascot image
                            </label>

                            <input type="hidden" name="hero_side_image_two_existing"
                                value="{{ $homeSetting->hero_side_image_two }}">

                            <input type="file" name="hero_side_image_two_file"
                                class="w-full rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">

                            @if($homeSetting->imageUrl($homeSetting->hero_side_image_two))
                                <img src="{{ $homeSetting->imageUrl($homeSetting->hero_side_image_two) }}"
                                    class="mt-3 h-36 w-full rounded-[7px] object-contain bg-zinc-50">
                            @endif
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-zinc-800">
                                Hero card kicker
                            </label>

                            <input type="text" name="hero_card_kicker"
                                value="{{ old('hero_card_kicker', $homeSetting->hero_card_kicker) }}"
                                class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm"
                                placeholder="Premium demo ready">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-zinc-800">
                                Hero card text
                            </label>

                            <input type="text" name="hero_card_text"
                                value="{{ old('hero_card_text', $homeSetting->hero_card_text) }}"
                                class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm"
                                placeholder="A quote-first showroom experience...">
                        </div>
                    </div>

                    <div id="heroSlidesWrapper" class="mt-8 space-y-5">
                        @foreach($heroSlides as $index => $slide)
                            <div class="repeater-item rounded-[14px] border border-zinc-200 bg-zinc-50 p-5">
                                <div class="mb-4 flex items-center justify-between gap-4">
                                    <h3 class="text-lg font-black text-zinc-950">
                                        Slide {{ $index + 1 }}
                                    </h3>

                                    <button type="button" data-remove-repeater
                                        class="rounded-[7px] bg-white px-3 py-2 text-sm font-bold text-red-600 hover:bg-red-50">
                                        Remove
                                    </button>
                                </div>

                                <input type="hidden" name="hero_slides[{{ $index }}][image_existing]"
                                    value="{{ $slide['image'] ?? '' }}">

                                <div class="grid gap-4 lg:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-zinc-800">Eyebrow</label>
                                        <input type="text" name="hero_slides[{{ $index }}][eyebrow]"
                                            value="{{ $slide['eyebrow'] ?? '' }}"
                                            class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-zinc-800">Slide image</label>
                                        <input type="file" name="hero_slides[{{ $index }}][image_file]"
                                            class="w-full rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="mb-2 block text-sm font-bold text-zinc-800">Headline</label>
                                        <input type="text" name="hero_slides[{{ $index }}][title]"
                                            value="{{ $slide['title'] ?? '' }}"
                                            class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="mb-2 block text-sm font-bold text-zinc-800">Headline text</label>
                                        <textarea name="hero_slides[{{ $index }}][text]" rows="3"
                                            class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">{{ $slide['text'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                @if(!empty($slide['image']))
                                    <img src="{{ $homeSetting->imageUrl($slide['image']) }}"
                                        class="mt-4 h-40 w-full rounded-[7px] object-cover">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[18px] border border-zinc-200 bg-white p-6 shadow-[0_20px_80px_rgba(7,7,7,.06)]">
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-orange-600">
                        Room visualiser
                    </p>

                    <h2 class="mt-1 text-2xl font-black text-zinc-950">
                        Let customers imagine section
                    </h2>

                    <div class="mt-6 grid gap-6 lg:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-zinc-800">Section image</label>

                            <input type="hidden" name="visualizer_image_existing"
                                value="{{ $homeSetting->visualizer_image }}">

                            <input type="file" name="visualizer_image_file"
                                class="w-full rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">

                            @if($homeSetting->imageUrl($homeSetting->visualizer_image))
                                <img src="{{ $homeSetting->imageUrl($homeSetting->visualizer_image) }}"
                                    class="mt-3 h-48 w-full rounded-[7px] object-cover">
                            @endif
                        </div>

                        <div class="grid gap-4">
                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Kicker</label>
                                <input type="text" name="visualizer_kicker"
                                    value="{{ old('visualizer_kicker', $homeSetting->visualizer_kicker) }}"
                                    class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Title</label>
                                <input type="text" name="visualizer_title"
                                    value="{{ old('visualizer_title', $homeSetting->visualizer_title) }}"
                                    class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Text</label>
                                <textarea name="visualizer_text" rows="3"
                                    class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">{{ old('visualizer_text', $homeSetting->visualizer_text) }}</textarea>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">
                                    Feature points, one per line
                                </label>

                                <textarea name="visualizer_features_text" rows="5"
                                    class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">{{ old('visualizer_features_text', $visualizerFeatures) }}</textarea>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="rounded-[18px] border border-zinc-200 bg-white p-6 shadow-[0_20px_80px_rgba(7,7,7,.06)]">
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-orange-600">
                        Shop the room
                    </p>

                    <h2 class="mt-1 text-2xl font-black text-zinc-950">
                        Shop the room content
                    </h2>

                    <div class="mt-6 grid gap-6 lg:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-zinc-800">Section image</label>

                            <input type="hidden" name="shop_room_image_existing"
                                value="{{ $homeSetting->shop_room_image }}">

                            <input type="file" name="shop_room_image_file"
                                class="w-full rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">

                            @if($homeSetting->imageUrl($homeSetting->shop_room_image))
                                <img src="{{ $homeSetting->imageUrl($homeSetting->shop_room_image) }}"
                                    class="mt-3 h-48 w-full rounded-[7px] object-cover">
                            @endif
                        </div>

                        <div class="grid gap-4">
                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Kicker</label>
                                <input type="text" name="shop_room_kicker"
                                    value="{{ old('shop_room_kicker', $homeSetting->shop_room_kicker) }}"
                                    class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Title</label>
                                <input type="text" name="shop_room_title"
                                    value="{{ old('shop_room_title', $homeSetting->shop_room_title) }}"
                                    class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Text</label>
                                <textarea name="shop_room_text" rows="4"
                                    class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">{{ old('shop_room_text', $homeSetting->shop_room_text) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-4 lg:grid-cols-2">
                        @foreach($shopRoomItems as $index => $item)
                            <div class="rounded-[14px] border border-zinc-200 bg-zinc-50 p-4">
                                <div class="grid gap-3 sm:grid-cols-3">
                                    <input type="text" name="shop_room_items[{{ $index }}][type]"
                                        value="{{ $item['type'] ?? '' }}"
                                        class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm" placeholder="Type">

                                    <input type="text" name="shop_room_items[{{ $index }}][name]"
                                        value="{{ $item['name'] ?? '' }}"
                                        class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm" placeholder="Name">

                                    <input type="color" name="shop_room_items[{{ $index }}][color]"
                                        value="{{ $item['color'] ?? '#dcd8cd' }}"
                                        class="h-[46px] rounded-[7px] border border-zinc-200 bg-white px-2 py-2">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[18px] border border-zinc-200 bg-white p-6 shadow-[0_20px_80px_rgba(7,7,7,.06)]">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.22em] text-orange-600">
                                Recent work
                            </p>

                            <h2 class="mt-1 text-2xl font-black text-zinc-950">
                                Recent work concepts
                            </h2>
                        </div>

                        <button type="button" data-add-project
                            class="rounded-[7px] bg-orange-600 px-4 py-3 text-sm font-black text-white hover:bg-orange-700">
                            Add project
                        </button>
                    </div>

                    <div id="recentWorkWrapper" class="space-y-5">
                        @foreach($recentWorks as $index => $project)
                            <div class="repeater-item rounded-[14px] border border-zinc-200 bg-zinc-50 p-5">
                                <div class="mb-4 flex items-center justify-between gap-4">
                                    <h3 class="text-lg font-black text-zinc-950">
                                        Project {{ $index + 1 }}
                                    </h3>

                                    <button type="button" data-remove-repeater
                                        class="rounded-[7px] bg-white px-3 py-2 text-sm font-bold text-red-600 hover:bg-red-50">
                                        Remove
                                    </button>
                                </div>

                                <input type="hidden" name="recent_work_concepts[{{ $index }}][image_existing]"
                                    value="{{ $project['image'] ?? '' }}">

                                <div class="grid gap-4 lg:grid-cols-2">
                                    <input type="text" name="recent_work_concepts[{{ $index }}][title]"
                                        value="{{ $project['title'] ?? '' }}"
                                        class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm"
                                        placeholder="Project title">

                                    <input type="text" name="recent_work_concepts[{{ $index }}][type]"
                                        value="{{ $project['type'] ?? '' }}"
                                        class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm"
                                        placeholder="Project type">

                                    <input type="text" name="recent_work_concepts[{{ $index }}][location]"
                                        value="{{ $project['location'] ?? '' }}"
                                        class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm" placeholder="Location">

                                    <input type="file" name="recent_work_concepts[{{ $index }}][image_file]"
                                        class="rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">
                                </div>

                                @if(!empty($project['image']))
                                    <img src="{{ $homeSetting->imageUrl($project['image']) }}"
                                        class="mt-4 h-40 w-full rounded-[7px] object-cover">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[18px] border border-zinc-200 bg-white p-6 shadow-[0_20px_80px_rgba(7,7,7,.06)]">
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-orange-600">
                        Quote section
                    </p>

                    <h2 class="mt-1 text-2xl font-black text-zinc-950">
                        Quote section image and text
                    </h2>

                    <div class="mt-6 grid gap-6 lg:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-zinc-800">Quote image</label>

                            <input type="hidden" name="quote_image_existing" value="{{ $homeSetting->quote_image }}">

                            <input type="file" name="quote_image_file"
                                class="w-full rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">

                            @if($homeSetting->imageUrl($homeSetting->quote_image))
                                <img src="{{ $homeSetting->imageUrl($homeSetting->quote_image) }}"
                                    class="mt-3 h-48 w-full rounded-[7px] object-cover">
                            @endif
                        </div>

                        <div class="grid gap-4">
                            <input type="text" name="quote_kicker"
                                value="{{ old('quote_kicker', $homeSetting->quote_kicker) }}"
                                class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm"
                                placeholder="Book a free consultation">

                            <input type="text" name="quote_title"
                                value="{{ old('quote_title', $homeSetting->quote_title) }}"
                                class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm"
                                placeholder="Quote section title">

                            <input type="text" name="quote_phone"
                                value="{{ old('quote_phone', $homeSetting->quote_phone) }}"
                                class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm" placeholder="Phone number">

                            <textarea name="quote_text" rows="4"
                                class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm"
                                placeholder="Quote section description">{{ old('quote_text', $homeSetting->quote_text) }}</textarea>
                        </div>
                    </div>
                </section>

                <div class="sticky bottom-4 z-20 flex justify-end">
                    <button type="submit"
                        class="rounded-[7px] bg-orange-600 px-8 py-4 text-sm font-black text-white shadow-[0_18px_45px_rgba(255,90,0,.28)] hover:bg-orange-700">
                        Save home page settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const heroSlidesWrapper = document.getElementById('heroSlidesWrapper');
            const recentWorkWrapper = document.getElementById('recentWorkWrapper');

            let slideIndex = {{ count($heroSlides) }};
            let projectIndex = {{ count($recentWorks) }};

            document.querySelector('[data-add-slide]')?.addEventListener('click', function () {
                const html = `
                    <div class="repeater-item rounded-[14px] border border-zinc-200 bg-zinc-50 p-5">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <h3 class="text-lg font-black text-zinc-950">New slide</h3>
                            <button type="button" data-remove-repeater class="rounded-[7px] bg-white px-3 py-2 text-sm font-bold text-red-600 hover:bg-red-50">Remove</button>
                        </div>

                        <input type="hidden" name="hero_slides[${slideIndex}][image_existing]" value="">

                        <div class="grid gap-4 lg:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Eyebrow</label>
                                <input type="text" name="hero_slides[${slideIndex}][eyebrow]" class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Slide image</label>
                                <input type="file" name="hero_slides[${slideIndex}][image_file]" class="w-full rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">
                            </div>

                            <div class="lg:col-span-2">
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Headline</label>
                                <input type="text" name="hero_slides[${slideIndex}][title]" class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm">
                            </div>

                            <div class="lg:col-span-2">
                                <label class="mb-2 block text-sm font-bold text-zinc-800">Headline text</label>
                                <textarea name="hero_slides[${slideIndex}][text]" rows="3" class="w-full rounded-[7px] border border-zinc-200 px-4 py-3 text-sm"></textarea>
                            </div>
                        </div>
                    </div>
                `;

                heroSlidesWrapper.insertAdjacentHTML('beforeend', html);
                slideIndex++;
            });

            document.querySelector('[data-add-project]')?.addEventListener('click', function () {
                const html = `
                    <div class="repeater-item rounded-[14px] border border-zinc-200 bg-zinc-50 p-5">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <h3 class="text-lg font-black text-zinc-950">New project</h3>
                            <button type="button" data-remove-repeater class="rounded-[7px] bg-white px-3 py-2 text-sm font-bold text-red-600 hover:bg-red-50">Remove</button>
                        </div>

                        <input type="hidden" name="recent_work_concepts[${projectIndex}][image_existing]" value="">

                        <div class="grid gap-4 lg:grid-cols-2">
                            <input type="text" name="recent_work_concepts[${projectIndex}][title]" class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm" placeholder="Project title">
                            <input type="text" name="recent_work_concepts[${projectIndex}][type]" class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm" placeholder="Project type">
                            <input type="text" name="recent_work_concepts[${projectIndex}][location]" class="rounded-[7px] border border-zinc-200 px-4 py-3 text-sm" placeholder="Location">
                            <input type="file" name="recent_work_concepts[${projectIndex}][image_file]" class="rounded-[7px] border border-zinc-200 bg-white px-4 py-3 text-sm">
                        </div>
                    </div>
                `;

                recentWorkWrapper.insertAdjacentHTML('beforeend', html);
                projectIndex++;
            });

            document.addEventListener('click', function (event) {
                const removeButton = event.target.closest('[data-remove-repeater]');

                if (!removeButton) {
                    return;
                }

                removeButton.closest('.repeater-item')?.remove();
            });
        });
    </script>
@endsection