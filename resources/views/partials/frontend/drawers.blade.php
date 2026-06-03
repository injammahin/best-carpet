<div data-ai-panel
    class="ai-panel fixed bottom-36 right-5 z-50 w-[calc(100vw-40px)] max-w-sm overflow-hidden border border-mega-line bg-white shadow-2xl radius-7">
    <div class="bg-mega-black p-5 text-white">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">AI flooring assistant</p>
                <h3 class="mt-2 text-xl font-semibold">Help customers choose faster.</h3>
                <p class="mt-2 text-sm leading-6 text-white/65">
                    Demo assistant for flooring questions, room ideas and quote guidance.
                </p>
            </div>

            <button type="button" data-close-ai class="text-xl text-white/70 hover:text-white">×</button>
        </div>
    </div>

    <div class="space-y-3 p-4">
        <button type="button"
            class="w-full bg-mega-soft p-3 text-left text-sm font-medium text-mega-black hover:bg-mega-orange hover:text-white radius-7">
            Which floor is best for bedrooms?
        </button>

        <button type="button"
            class="w-full bg-mega-soft p-3 text-left text-sm font-medium text-mega-black hover:bg-mega-orange hover:text-white radius-7">
            Compare vinyl, laminate and timber.
        </button>

        <button type="button"
            class="w-full bg-mega-soft p-3 text-left text-sm font-medium text-mega-black hover:bg-mega-orange hover:text-white radius-7">
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
                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">Quote basket</p>
                    <h2 class="mt-1 text-2xl font-semibold tracking-tight text-mega-black">Saved products</h2>
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
                        <h3 class="text-xl font-semibold text-mega-black">No products saved yet</h3>
                        <p class="mt-2 text-sm font-normal text-mega-muted">
                            Select colour and type, then add products to your quote.
                        </p>
                    </div>
                </div>

                <div data-quote-list class="space-y-4"></div>
            </div>

            <div class="border-t border-mega-line p-5">
                <div class="mb-4 bg-[#f7f3ed] p-4 radius-7">
                    <div class="flex items-center justify-between text-sm font-medium text-mega-muted">
                        <span>Indicative product total</span>
                        <span data-quote-total class="text-xl text-mega-black">$0</span>
                    </div>

                    <p class="mt-2 text-xs font-normal leading-5 text-mega-muted">
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
                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">Wishlist</p>
                    <h2 class="mt-1 text-2xl font-semibold tracking-tight text-mega-black">Favourite products</h2>
                </div>

                <button type="button" data-close-drawer
                    class="grid h-10 w-10 place-items-center hover:bg-mega-soft radius-7" aria-label="Close wishlist">
                    ×
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-5">
                <div data-wishlist-empty class="grid h-full place-items-center text-center">
                    <div>
                        <h3 class="text-xl font-semibold text-mega-black">No wishlist products yet</h3>
                        <p class="mt-2 text-sm font-normal text-mega-muted">
                            Click the heart icon on any product card to save it here.
                        </p>
                    </div>
                </div>

                <div data-wishlist-list class="space-y-4"></div>
            </div>
        </div>
    </aside>
</div>