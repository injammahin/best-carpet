<div class="fixed bottom-5 right-5 z-40 flex flex-col gap-3">
    {{-- <button type="button" data-open-ai
        class="grid h-14 w-14 place-items-center rounded-full border-4 border-white bg-mega-orange text-white shadow-soft transition hover:scale-105"
        aria-label="AI assistant">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M12 2l1.8 6.2L20 10l-6.2 1.8L12 18l-1.8-6.2L4 10l6.2-1.8L12 2z" />
            <path d="M19 15l.9 3.1L23 19l-3.1.9L19 23l-.9-3.1L15 19l3.1-.9L19 15z" />
        </svg>
    </button> --}}

    <button type="button" data-open-quote
        class="relative grid h-14 w-14 place-items-center rounded-full border-4 border-white bg-mega-black text-white shadow-soft transition hover:scale-105"
        aria-label="Open quote basket">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M6 6h15l-2 8H8L6 6z" />
            <path d="M6 6L5 3H2" />
            <circle cx="9" cy="20" r="1.5" />
            <circle cx="18" cy="20" r="1.5" />
        </svg>

        <span data-quote-count
            class="hidden premium-count-badge absolute -right-1 -top-1 h-6 min-w-6 place-items-center rounded-full border-2 border-white bg-mega-orange px-1 text-xs font-extrabold text-white">
            0
        </span>
    </button>
</div>

<div data-ai-panel
    class="ai-panel fixed bottom-36 right-5 z-50 w-[calc(100vw-40px)] max-w-sm overflow-hidden border border-mega-line bg-white shadow-2xl radius-7">
    <div class="bg-mega-black p-5 text-white">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-mega-orange">
                    AI flooring assistant
                </p>

                <h3 class="mt-2 text-xl font-extrabold">
                    Help customers choose faster.
                </h3>

                <p class="mt-2 text-sm leading-6 text-white/65">
                    Demo assistant for flooring questions, room ideas and quote guidance.
                </p>
            </div>

            <button type="button" data-close-ai class="text-xl text-white/70 hover:text-white"
                aria-label="Close assistant">
                ×
            </button>
        </div>
    </div>

    <div class="space-y-3 p-4">
        <button type="button"
            class="w-full bg-mega-soft p-3 text-left text-sm font-bold text-mega-black hover:bg-mega-orange hover:text-white radius-7">
            Which floor is best for bedrooms?
        </button>

        <button type="button"
            class="w-full bg-mega-soft p-3 text-left text-sm font-bold text-mega-black hover:bg-mega-orange hover:text-white radius-7">
            Compare vinyl, laminate and timber.
        </button>

        <button type="button"
            class="w-full bg-mega-soft p-3 text-left text-sm font-bold text-mega-black hover:bg-mega-orange hover:text-white radius-7">
            Help me prepare a quote request.
        </button>

        <a href="{{ route('frontend.quote') }}" class="btn-primary w-full justify-center">
            Book consultation
        </a>
    </div>
</div>

<div data-quote-drawer class="drawer fixed inset-0 z-[80]">
    <div data-close-drawer class="absolute inset-0 bg-black/55 backdrop-blur-sm"></div>

    <aside class="drawer-panel absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl">
        <div class="flex h-full flex-col">
            <div class="flex items-center justify-between border-b border-mega-line p-5">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-mega-orange">
                        Quote basket
                    </p>

                    <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-mega-black">
                        Saved products
                    </h2>
                </div>

                <button type="button" data-close-drawer
                    class="grid h-10 w-10 place-items-center hover:bg-mega-soft radius-7"
                    aria-label="Close quote basket">
                    ×
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-5">
                <div data-quote-empty class="grid h-full place-items-center text-center">
                    <div>
                        <h3 class="text-xl font-extrabold text-mega-black">
                            No products saved yet
                        </h3>

                        <p class="mt-2 text-sm font-medium text-mega-muted">
                            Add products from the catalogue to build a quote request.
                        </p>
                    </div>
                </div>

                <div data-quote-list class="space-y-4"></div>
            </div>

            <div class="border-t border-mega-line p-5">
                <div class="mb-4 bg-[#f7f3ed] p-4 radius-7">
                    <div class="flex items-center justify-between text-sm font-extrabold text-mega-muted">
                        <span>Indicative product total</span>
                        <span data-quote-total class="text-xl text-mega-black">$0</span>
                    </div>

                    <p class="mt-2 text-xs font-medium leading-5 text-mega-muted">
                        Final quote depends on measurements, preparation, underlay, install requirements and product
                        availability.
                    </p>
                </div>

                <a href="{{ route('frontend.quote') }}" data-close-drawer class="btn-primary w-full justify-center">
                    Continue to quote form
                </a>
            </div>
        </div>
    </aside>
</div>

<div data-wishlist-drawer class="drawer fixed inset-0 z-[80]">
    <div data-close-drawer class="absolute inset-0 bg-black/55 backdrop-blur-sm"></div>

    <aside class="drawer-panel absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl">
        <div class="flex h-full flex-col">
            <div class="flex items-center justify-between border-b border-mega-line p-5">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-mega-orange">
                        Wishlist
                    </p>

                    <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-mega-black">
                        Favourite products
                    </h2>
                </div>

                <button type="button" data-close-drawer
                    class="grid h-10 w-10 place-items-center hover:bg-mega-soft radius-7" aria-label="Close wishlist">
                    ×
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-5">
                <div data-wishlist-empty class="grid h-full place-items-center text-center">
                    <div>
                        <h3 class="text-xl font-extrabold text-mega-black">
                            No wishlist products yet
                        </h3>

                        <p class="mt-2 text-sm font-medium text-mega-muted">
                            Click the heart icon on any product card to save it here.
                        </p>
                    </div>
                </div>

                <div data-wishlist-list class="space-y-4"></div>
            </div>
        </div>
    </aside>
</div>