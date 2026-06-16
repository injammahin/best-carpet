import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const KEYS = {
        quote: 'mega_quote_items',
        wishlist: 'mega_wishlist_items',
    };

    const LEGACY_KEYS = {
        quote: ['mega_quote_items_static', 'mega_quote_products'],
        wishlist: ['mega_wishlist_static', 'mega_wishlist_products'],
    };

    const storage = {
        get(key) {
            try {
                const value = JSON.parse(localStorage.getItem(key) || '[]');
                return Array.isArray(value) ? value : [];
            } catch {
                return [];
            }
        },

        set(key, value) {
            localStorage.setItem(key, JSON.stringify(value || []));
        },
    };

    const escapeHtml = (value = '') => {
        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    };

    const money = (amount) => {
        return '$' + Number(amount || 0).toLocaleString('en-US', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2,
        });
    };

    const productKey = (item = {}) => {
        return String(item.id || item.slug || item.name || '');
    };

    const quoteLineKey = (item = {}) => {
        return [
            item.id || item.slug || item.name || '',
            item.size_label || item.size || '',
            item.sqm || '',
            item.colour || '',
            item.type || '',
        ].join('|');
    };

    const parseJson = (value, fallback = {}) => {
        try {
            return JSON.parse(value || '');
        } catch {
            return fallback;
        }
    };

    const parseButtonProduct = (button) => {
        const fromButton = parseJson(button?.dataset?.product, null);

        if (fromButton && Object.keys(fromButton).length) {
            return fromButton;
        }

        const card = button?.closest('[data-product-card]');

        return parseJson(card?.dataset?.product, {});
    };

    const migrateLegacyStorage = () => {
        Object.entries(LEGACY_KEYS).forEach(([type, oldKeys]) => {
            const mainKey = KEYS[type];
            const mainItems = storage.get(mainKey);

            oldKeys.forEach((oldKey) => {
                const oldItems = storage.get(oldKey);

                oldItems.forEach((oldItem) => {
                    const exists = mainItems.some((item) => {
                        return productKey(item) === productKey(oldItem);
                    });

                    if (!exists) {
                        mainItems.push(oldItem);
                    }
                });

                localStorage.removeItem(oldKey);
            });

            storage.set(mainKey, mainItems);
        });
    };

    migrateLegacyStorage();

    const getQuoteItems = () => storage.get(KEYS.quote);

    const saveQuoteItems = (items) => {
        storage.set(KEYS.quote, items);
        updateHeaderCounts();
    };

    const getWishlistItems = () => storage.get(KEYS.wishlist);

    const saveWishlistItems = (items) => {
        storage.set(KEYS.wishlist, items);
        updateHeaderCounts();
        updateWishlistButtons();
    };

    function updateHeaderCounts() {
        const quoteItems = getQuoteItems();
        const wishlistItems = getWishlistItems();

        document.querySelectorAll('[data-quote-count]').forEach((badge) => {
            badge.textContent = quoteItems.length;
            badge.classList.toggle('hidden', quoteItems.length === 0);
        });

        document.querySelectorAll('[data-wishlist-count]').forEach((badge) => {
            badge.textContent = wishlistItems.length;
            badge.classList.toggle('hidden', wishlistItems.length === 0);
        });
    }

    function updateWishlistButtons() {
        const wishlistItems = getWishlistItems();

        document
            .querySelectorAll('.wishlist-toggle, [data-wishlist-button], [data-product-wishlist]')
            .forEach((button) => {
                const product = parseButtonProduct(button);
                const id = String(button.dataset.productId || productKey(product));

                const active = wishlistItems.some((item) => {
                    return productKey(item) === id;
                });

                button.classList.toggle('is-active', active);

                const icon = button.querySelector('svg');

                if (icon) {
                    icon.setAttribute('fill', active ? 'currentColor' : 'none');
                }
            });
    }

    /*
    |--------------------------------------------------------------------------
    | Header
    |--------------------------------------------------------------------------
    */

    const megaHeader = document.querySelector('[data-mega-header]');
    let lastHeaderScroll = window.scrollY || 0;
    let tickingHeader = false;

    const mobileMenuButton = document.querySelector('[data-mobile-menu-button]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    const menuOpenIcon = document.querySelector('[data-menu-open-icon]');
    const menuCloseIcon = document.querySelector('[data-menu-close-icon]');

    const searchToggleButtons = document.querySelectorAll('[data-search-toggle]');
    const headerSearchPanel = document.querySelector('[data-header-search]');
    const searchCloseButton = document.querySelector('[data-search-close]');

    function setMobileMenuState(isOpen) {
        if (!mobileMenu) {
            return;
        }

        mobileMenu.classList.toggle('is-open', isOpen);
        mobileMenuButton?.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

        if (menuOpenIcon && menuCloseIcon) {
            menuOpenIcon.classList.toggle('hidden', isOpen);
            menuCloseIcon.classList.toggle('hidden', !isOpen);
        }

        megaHeader?.classList.remove('is-hidden');
    }

    function closeHeaderSearch() {
        if (!headerSearchPanel) {
            return;
        }

        headerSearchPanel.classList.remove('is-open');

        searchToggleButtons.forEach((button) => {
            button.classList.remove('is-active');
        });
    }

    function openHeaderSearch() {
        if (!headerSearchPanel) {
            return;
        }

        setMobileMenuState(false);

        headerSearchPanel.classList.add('is-open');

        searchToggleButtons.forEach((button) => {
            button.classList.add('is-active');
        });

        const searchInput = headerSearchPanel.querySelector('input[type="search"], input[type="text"]');

        setTimeout(() => {
            searchInput?.focus();
        }, 120);

        megaHeader?.classList.remove('is-hidden');
    }

    function handlePremiumHeader() {
        if (!megaHeader) {
            return;
        }

        const currentScroll = window.scrollY || 0;
        const mobileMenuOpen = mobileMenu?.classList.contains('is-open');
        const searchOpen = headerSearchPanel?.classList.contains('is-open');

        megaHeader.classList.toggle('is-scrolled', currentScroll > 10);
        megaHeader.classList.toggle('is-compact', currentScroll > 8);

        if (mobileMenuOpen || searchOpen) {
            megaHeader.classList.remove('is-hidden');
            lastHeaderScroll = currentScroll;
            tickingHeader = false;
            return;
        }

        if (currentScroll <= 90) {
            megaHeader.classList.remove('is-hidden');
        } else if (currentScroll > lastHeaderScroll && currentScroll > 150) {
            megaHeader.classList.add('is-hidden');
        } else if (currentScroll < lastHeaderScroll) {
            megaHeader.classList.remove('is-hidden');
        }

        lastHeaderScroll = currentScroll;
        tickingHeader = false;
    }

    window.addEventListener(
        'scroll',
        () => {
            if (!tickingHeader) {
                window.requestAnimationFrame(handlePremiumHeader);
                tickingHeader = true;
            }
        },
        { passive: true }
    );

    handlePremiumHeader();

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            setMobileMenuState(!mobileMenu.classList.contains('is-open'));
            closeHeaderSearch();
        });

        mobileMenu.querySelectorAll('a').forEach((item) => {
            item.addEventListener('click', () => {
                setMobileMenuState(false);
            });
        });
    }

    searchToggleButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();

            if (headerSearchPanel?.classList.contains('is-open')) {
                closeHeaderSearch();
            } else {
                openHeaderSearch();
            }
        });
    });

    searchCloseButton?.addEventListener('click', closeHeaderSearch);

    document.addEventListener('click', (event) => {
        if (!headerSearchPanel?.classList.contains('is-open')) {
            return;
        }

        const clickedInsideSearch = headerSearchPanel.contains(event.target);
        const clickedToggle = event.target.closest('[data-search-toggle]');

        if (!clickedInsideSearch && !clickedToggle) {
            closeHeaderSearch();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Hero Slider
    |--------------------------------------------------------------------------
    */

    function initHeroSlider() {
        const hero = document.querySelector('[data-hero-slider]');

        let slides = [];
        let contents = [];
        let dots = [];
        let nextButtons = [];
        let prevButtons = [];

        if (hero) {
            slides = Array.from(hero.querySelectorAll('[data-hero-image]'));
            contents = Array.from(hero.querySelectorAll('[data-slide-content]'));
            dots = Array.from(hero.querySelectorAll('[data-hero-dot]'));
            nextButtons = Array.from(hero.querySelectorAll('[data-hero-next]'));
            prevButtons = Array.from(hero.querySelectorAll('[data-hero-prev]'));
        } else {
            slides = Array.from(document.querySelectorAll('.hero-slide'));
            contents = Array.from(document.querySelectorAll('.hero-slide-content'));
            dots = Array.from(document.querySelectorAll('.hero-dot'));
            nextButtons = Array.from(document.querySelectorAll('[data-hero-next]'));
            prevButtons = Array.from(document.querySelectorAll('[data-hero-prev]'));
        }

        if (!slides.length) {
            return;
        }

        let activeSlide = 0;
        let timer = null;

        const showSlide = (index) => {
            activeSlide = (index + slides.length) % slides.length;

            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === activeSlide);
            });

            contents.forEach((content, contentIndex) => {
                const isActive = contentIndex === activeSlide;

                content.classList.toggle('is-active', isActive);
                content.classList.toggle('hidden', !isActive && !hero);
            });

            dots.forEach((dot, dotIndex) => {
                dot.classList.toggle('is-active', dotIndex === activeSlide);
            });
        };

        const stopSlider = () => {
            if (timer) {
                window.clearInterval(timer);
                timer = null;
            }
        };

        const startSlider = () => {
            stopSlider();

            timer = window.setInterval(() => {
                showSlide(activeSlide + 1);
            }, 6000);
        };

        nextButtons.forEach((button) => {
            button.addEventListener('click', () => {
                showSlide(activeSlide + 1);
                startSlider();
            });
        });

        prevButtons.forEach((button) => {
            button.addEventListener('click', () => {
                showSlide(activeSlide - 1);
                startSlider();
            });
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
                startSlider();
            });
        });

        const sliderWrap = hero || document.querySelector('#top');

        sliderWrap?.addEventListener('mouseenter', stopSlider);
        sliderWrap?.addEventListener('mouseleave', startSlider);

        showSlide(0);
        startSlider();
    }

    initHeroSlider();

    /*
    |--------------------------------------------------------------------------
    | Product Filters
    |--------------------------------------------------------------------------
    */

    function initProductFilter() {
        const searchInput = document.querySelector('[data-product-search]');
        const categoryFilter = document.querySelector('[data-category-filter]');
        const roomFilter = document.querySelector('[data-room-filter]');
        const productCount = document.querySelector('[data-product-count]');

        if (!searchInput && !categoryFilter && !roomFilter) {
            return;
        }

        const productCards = Array.from(document.querySelectorAll('[data-product-card]')).filter((card) => {
            return !card.hasAttribute('data-home-product-card');
        });

        if (!productCards.length) {
            return;
        }

        const filterProducts = () => {
            const search = (searchInput?.value || '').trim().toLowerCase();
            const category = categoryFilter?.value || 'All';
            const room = roomFilter?.value || 'All';

            let visibleCount = 0;

            productCards.forEach((card) => {
                const searchable = (card.dataset.search || '').toLowerCase();
                const cardCategory = card.dataset.category || '';
                const cardRoom = card.dataset.room || '';

                const matchesSearch = !search || searchable.includes(search);
                const matchesCategory = category === 'All' || cardCategory === category;
                const matchesRoom = room === 'All' || cardRoom === room;
                const shouldShow = matchesSearch && matchesCategory && matchesRoom;

                card.classList.toggle('hidden', !shouldShow);
                card.classList.toggle('is-hidden', !shouldShow);

                if (shouldShow) {
                    visibleCount++;
                }
            });

            if (productCount) {
                productCount.textContent = `${visibleCount} ${visibleCount === 1 ? 'product' : 'products'} showing`;
            }
        };

        [searchInput, categoryFilter, roomFilter].forEach((input) => {
            input?.addEventListener('input', filterProducts);
            input?.addEventListener('change', filterProducts);
        });

        filterProducts();
    }

    initProductFilter();

    function initHomeProductFilter() {
        const section = document.querySelector('[data-home-products]');

        if (!section) {
            return;
        }

        const categoryFilter = section.querySelector('[data-home-category-filter]');
        const roomFilter = section.querySelector('[data-home-room-filter]');
        const searchInput = section.querySelector('[data-home-product-search]');
        const countText = section.querySelector('[data-home-product-count]');
        const emptyState = section.querySelector('[data-home-empty-products]');
        const cards = Array.from(section.querySelectorAll('[data-home-product-card]'));

        if (!cards.length) {
            return;
        }

        const applyHomeProductFilters = () => {
            const selectedSet = categoryFilter?.value || '';
            const selectedRoom = roomFilter?.value || 'all';
            const searchTerm = (searchInput?.value || '').trim().toLowerCase();

            let visibleCount = 0;

            cards.forEach((card) => {
                const setMatches = !selectedSet || card.dataset.homeSet === selectedSet;
                const roomMatches = selectedRoom === 'all' || card.dataset.room === selectedRoom;
                const searchMatches = !searchTerm || (card.dataset.search || '').includes(searchTerm);
                const shouldShow = setMatches && roomMatches && searchMatches;

                card.style.display = shouldShow ? '' : 'none';

                if (shouldShow) {
                    visibleCount++;
                }
            });

            if (countText) {
                countText.textContent = `${visibleCount} ${visibleCount === 1 ? 'product' : 'products'} showing`;
            }

            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? '' : 'none';
            }
        };

        categoryFilter?.addEventListener('change', () => {
            if (searchInput) {
                searchInput.value = '';
            }

            if (roomFilter) {
                roomFilter.value = 'all';
            }

            applyHomeProductFilters();
        });

        roomFilter?.addEventListener('change', applyHomeProductFilters);
        searchInput?.addEventListener('input', applyHomeProductFilters);

        applyHomeProductFilters();
    }

    initHomeProductFilter();

    /*
    |--------------------------------------------------------------------------
    | Drawers
    |--------------------------------------------------------------------------
    */

    const quoteDrawer = document.querySelector('[data-quote-drawer]');
    const wishlistDrawer = document.querySelector('[data-wishlist-drawer]');

    function openDrawer(drawer) {
        if (!drawer) {
            return;
        }

        closeHeaderSearch();
        setMobileMenuState(false);

        drawer.classList.add('is-open');
        document.body.style.overflow = 'hidden';
        megaHeader?.classList.remove('is-hidden');
    }

    function closeDrawers() {
        document.querySelectorAll('.drawer').forEach((drawer) => {
            drawer.classList.remove('is-open');
        });

        document.body.style.overflow = '';
    }

    /*
    |--------------------------------------------------------------------------
    | Quote Basket
    |--------------------------------------------------------------------------
    */

    function createQuoteItem(product, extra = {}) {
        return {
            id: product.id || product.slug || product.name,
            slug: product.slug || '',
            name: product.name || product.title || 'Product',
            category: product.category || '',
            image: product.image || '',
            price: Number(extra.price ?? product.price ?? product.price_from ?? 0),
            regular: Number(extra.regular ?? extra.regular_price ?? product.regular ?? product.regular_price ?? 0),
            colour: extra.colour || product.colour || '',
            type: extra.type || product.type || '',
            size_label: extra.size_label || extra.size || product.size_label || product.size || '',
            sqm: extra.sqm || product.sqm || '',
            qty: Number(extra.qty || product.qty || 1),
        };
    }

    function addToQuote(product, extra = {}) {
        if (!product || !Object.keys(product).length) {
            return;
        }

        const newItem = createQuoteItem(product, extra);
        const newLineKey = quoteLineKey(newItem);

        let items = getQuoteItems();

        const existingIndex = items.findIndex((item) => {
            return quoteLineKey(item) === newLineKey;
        });

        if (existingIndex >= 0) {
            items[existingIndex].qty = Number(items[existingIndex].qty || 1) + Number(newItem.qty || 1);
        } else {
            items.push(newItem);
        }

        saveQuoteItems(items);
        renderQuoteDrawer();
        openDrawer(quoteDrawer);

        document.dispatchEvent(new CustomEvent('megaQuoteUpdated'));
    }

    function removeQuoteItem(lineKey) {
        const items = getQuoteItems().filter((item) => {
            return quoteLineKey(item) !== String(lineKey);
        });

        saveQuoteItems(items);
        renderQuoteDrawer();
    }

    function updateQuoteQty(lineKey, delta) {
        const items = getQuoteItems()
            .map((item) => {
                if (quoteLineKey(item) === String(lineKey)) {
                    return {
                        ...item,
                        qty: Math.max(0, Number(item.qty || 1) + delta),
                    };
                }

                return item;
            })
            .filter((item) => Number(item.qty) > 0);

        saveQuoteItems(items);
        renderQuoteDrawer();
    }

    function renderQuoteDrawer() {
        const list = document.querySelector('[data-quote-list]');
        const empty = document.querySelector('[data-quote-empty]');
        const totalNode = document.querySelector('[data-quote-total]');

        if (!list || !empty || !totalNode) {
            return;
        }

        const emptyText = empty.querySelector('p');

        if (emptyText) {
            emptyText.textContent = 'Select a size, then add products to your quote.';
        }

        const items = getQuoteItems();

        list.innerHTML = '';
        empty.classList.toggle('hidden', items.length > 0);

        const total = items.reduce((sum, item) => {
            return sum + Number(item.price || 0) * Number(item.qty || 1);
        }, 0);

        items.forEach((item) => {
            const lineKey = quoteLineKey(item);
            const row = document.createElement('div');

            const metaParts = [
                item.category || '',
                item.size_label || item.size || '',
                item.sqm ? `${item.sqm}m²` : '',
                item.colour || '',
                item.type || '',
            ].filter(Boolean);

            row.className = 'grid grid-cols-[78px_1fr_auto] gap-3 border border-mega-line bg-white p-3 shadow-sm radius-7';

            row.innerHTML = `
                <img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name)}" class="h-[78px] w-[78px] object-cover radius-7">

                <div>
                    <h4 class="text-sm font-semibold leading-tight text-mega-black">${escapeHtml(item.name)}</h4>

                    <p class="mt-1 text-xs text-mega-muted">
                        ${escapeHtml(metaParts.join(' · '))}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-mega-black">
                        ${money(item.price)}
                    </p>

                    <div class="mt-3 flex w-fit items-center rounded-[7px] border border-mega-line">
                        <button type="button" class="grid h-8 w-8 place-items-center" data-qty-minus="${escapeHtml(lineKey)}">−</button>
                        <span class="grid h-8 w-9 place-items-center text-sm font-extrabold">${Number(item.qty || 1)}</span>
                        <button type="button" class="grid h-8 w-8 place-items-center" data-qty-plus="${escapeHtml(lineKey)}">+</button>
                    </div>
                </div>

                <button type="button" class="h-8 w-8 text-mega-muted hover:text-mega-orange" data-remove-quote="${escapeHtml(lineKey)}">
                    ×
                </button>
            `;

            list.appendChild(row);
        });

        totalNode.textContent = money(total);

        list.querySelectorAll('[data-remove-quote]').forEach((button) => {
            button.addEventListener('click', () => {
                removeQuoteItem(button.dataset.removeQuote);
            });
        });

        list.querySelectorAll('[data-qty-minus]').forEach((button) => {
            button.addEventListener('click', () => {
                updateQuoteQty(button.dataset.qtyMinus, -1);
            });
        });

        list.querySelectorAll('[data-qty-plus]').forEach((button) => {
            button.addEventListener('click', () => {
                updateQuoteQty(button.dataset.qtyPlus, 1);
            });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Wishlist
    |--------------------------------------------------------------------------
    */

    function toggleWishlist(product) {
        if (!product || !Object.keys(product).length) {
            return;
        }

        const cleanProduct = {
            id: product.id || product.slug || product.name,
            slug: product.slug || '',
            name: product.name || product.title || 'Product',
            category: product.category || '',
            image: product.image || '',
            price: Number(product.price || product.price_from || 0),
            unit: product.unit || '',
        };

        const key = productKey(cleanProduct);

        let items = getWishlistItems();

        const exists = items.some((item) => {
            return productKey(item) === key;
        });

        if (exists) {
            items = items.filter((item) => {
                return productKey(item) !== key;
            });
        } else {
            items.push(cleanProduct);
        }

        saveWishlistItems(items);
        renderWishlistDrawer();
    }

    function removeWishlistItem(key) {
        const items = getWishlistItems().filter((item) => {
            return productKey(item) !== String(key);
        });

        saveWishlistItems(items);
        renderWishlistDrawer();
    }

    function renderWishlistDrawer() {
        const list = document.querySelector('[data-wishlist-list]');
        const empty = document.querySelector('[data-wishlist-empty]');

        if (!list || !empty) {
            return;
        }

        const items = getWishlistItems();

        list.innerHTML = '';
        empty.classList.toggle('hidden', items.length > 0);

        items.forEach((item) => {
            const key = productKey(item);
            const row = document.createElement('div');

            row.className = 'grid grid-cols-[78px_1fr_auto] gap-3 border border-mega-line bg-white p-3 shadow-sm radius-7';

            row.innerHTML = `
                <img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name)}" class="h-[78px] w-[78px] object-cover radius-7">

                <div>
                    <h4 class="text-sm font-semibold leading-tight text-mega-black">${escapeHtml(item.name)}</h4>
                    <p class="mt-1 text-xs text-mega-muted">${escapeHtml(item.category || '')}</p>

                    <div class="mt-3 flex flex-wrap gap-2">
                        ${item.slug ? `<a href="/products/${escapeHtml(item.slug)}" class="rounded-[7px] bg-mega-orange px-3 py-2 text-xs font-extrabold text-white">View product</a>` : ''}

                        <button type="button" class="rounded-[7px] bg-mega-soft px-3 py-2 text-xs font-extrabold text-mega-black" data-remove-wishlist="${escapeHtml(key)}">
                            Remove
                        </button>
                    </div>
                </div>

                <button type="button" class="h-8 w-8 text-mega-muted hover:text-mega-orange" data-remove-wishlist="${escapeHtml(key)}">
                    ×
                </button>
            `;

            list.appendChild(row);
        });

        list.querySelectorAll('[data-remove-wishlist]').forEach((button) => {
            button.addEventListener('click', () => {
                removeWishlistItem(button.dataset.removeWishlist);
            });
        });
    }

    document.querySelectorAll('[data-open-quote]').forEach((button) => {
        button.addEventListener('click', () => {
            renderQuoteDrawer();
            openDrawer(quoteDrawer);
        });
    });

    document.querySelectorAll('[data-open-wishlist]').forEach((button) => {
        button.addEventListener('click', () => {
            renderWishlistDrawer();
            openDrawer(wishlistDrawer);
        });
    });

    document.querySelectorAll('[data-close-drawer]').forEach((button) => {
        button.addEventListener('click', closeDrawers);
    });

    /*
    |--------------------------------------------------------------------------
    | Size-only product cards
    |--------------------------------------------------------------------------
    | Product flow:
    | Choose size -> show rough price estimate -> add to quote
    */

    function getSizeFromOption(option, product) {
        if (!option || !option.value) {
            return null;
        }

        const sizes = Array.isArray(product.sizes) ? product.sizes : [];
        const sizeFromProduct = sizes[Number(option.value)] || {};

        const label = option.dataset.label || sizeFromProduct.label || option.textContent.trim();
        const sqm = option.dataset.sqm || sizeFromProduct.sqm || '';
        const price = Number(option.dataset.price ?? sizeFromProduct.price ?? 0);
        const regular = Number(
            option.dataset.regularPrice ??
            option.dataset.regular ??
            sizeFromProduct.regular_price ??
            sizeFromProduct.regular ??
            price
        );

        return {
            label,
            sqm,
            price,
            regular,
        };
    }

    function setAddButtonState(button, disabled) {
        if (!button) {
            return;
        }

        button.disabled = disabled;
        button.classList.toggle('opacity-60', disabled);
        button.classList.toggle('cursor-not-allowed', disabled);
    }

    function initSizeOnlyProductCards() {
        document.querySelectorAll('[data-product-card]').forEach((card) => {
            const product = parseJson(card.dataset.product, {});
            const sizeSelect = card.querySelector('[data-size-select]');
            const pricePanel = card.querySelector('[data-price-panel]');
            const priceText = card.querySelector('[data-price-text]');
            const regularText = card.querySelector('[data-regular-text]');
            const priceOutput = card.querySelector('[data-price-output]');
            const addQuoteButton = card.querySelector('[data-add-quote]');

            if (!sizeSelect || !addQuoteButton) {
                return;
            }

            addQuoteButton.dataset.jsBound = '1';

            let selectedSize = null;

            sizeSelect.disabled = false;

            const firstOption = sizeSelect.querySelector('option[value=""]');

            if (firstOption && firstOption.textContent.toLowerCase().includes('colour')) {
                firstOption.textContent = 'Choose a size for rough estimate...';
            }

            if (!firstOption && sizeSelect.options.length) {
                const placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.textContent = 'Choose a size for rough estimate...';
                sizeSelect.prepend(placeholder);
                sizeSelect.value = '';
            }

            setAddButtonState(addQuoteButton, true);
            pricePanel?.classList.add('hidden');

            const resetEstimate = () => {
                selectedSize = null;

                if (priceText) {
                    priceText.textContent = '$0';
                }

                if (regularText) {
                    regularText.textContent = '$0';
                }

                if (priceOutput) {
                    priceOutput.textContent = 'Select size';
                }

                pricePanel?.classList.add('hidden');
                setAddButtonState(addQuoteButton, true);
            };

            sizeSelect.addEventListener('change', () => {
                const option = sizeSelect.options[sizeSelect.selectedIndex];
                selectedSize = getSizeFromOption(option, product);

                if (!selectedSize) {
                    resetEstimate();
                    return;
                }

                if (priceText) {
                    priceText.textContent = money(selectedSize.price);
                }

                if (regularText) {
                    regularText.textContent = selectedSize.regular > 0
                        ? money(selectedSize.regular)
                        : money(selectedSize.price);
                }

                if (priceOutput) {
                    priceOutput.textContent = money(selectedSize.price);
                }

                pricePanel?.classList.remove('hidden');
                setAddButtonState(addQuoteButton, false);
            });

            addQuoteButton.addEventListener('click', () => {
                if (!selectedSize) {
                    sizeSelect.focus();
                    return;
                }

                addToQuote(product, {
                    size_label: selectedSize.label,
                    sqm: selectedSize.sqm,
                    price: selectedSize.price,
                    regular: selectedSize.regular,
                });

                const originalText = addQuoteButton.textContent;

                addQuoteButton.textContent = 'Added to quote';

                setTimeout(() => {
                    addQuoteButton.textContent = originalText || 'Add to quote';
                }, 1200);
            });
        });
    }
    function formatQuoteItemsForMessage() {
        const items = getQuoteItems();
        const customerNote = document.querySelector('[data-customer-note]')?.value.trim() || '';

        const lines = [];

        if (items.length) {
            lines.push('Selected Products for Quote');
            lines.push('');

            items.forEach((item, index) => {
                lines.push(`${index + 1}. ${item.name || 'Product'}`);

                if (item.category) {
                    lines.push(`Category: ${item.category}`);
                }

                if (item.type) {
                    lines.push(`Type: ${item.type}`);
                }

                if (item.size_label || item.size) {
                    lines.push(`Size / Area: ${item.size_label || item.size}`);
                }

                if (item.sqm) {
                    lines.push(`Area: ${item.sqm}m²`);
                }

                if (item.price) {
                    lines.push(`Rough Estimate: ${money(item.price)}`);
                }

                if (item.qty) {
                    lines.push(`Quantity: ${item.qty}`);
                }

                lines.push('');
            });

            lines.push('Note: Final quote may change after measurement, installation requirements, preparation, underlay and product availability.');
        }

        if (customerNote) {
            if (lines.length) {
                lines.push('');
            }

            lines.push('Customer Additional Comments');
            lines.push(customerNote);
        }

        return lines.join('\n').trim();
    }

    function renderSelectedProductsPreview() {
        const wrap = document.querySelector('[data-selected-products-wrap]');
        const preview = document.querySelector('[data-selected-products-preview]');
        const countBadge = document.querySelector('[data-selected-products-count]');

        if (!wrap || !preview) {
            return;
        }

        const items = getQuoteItems();

        wrap.classList.toggle('hidden', items.length === 0);
        preview.innerHTML = '';

        if (countBadge) {
            countBadge.textContent = `${items.length} ${items.length === 1 ? 'item' : 'items'}`;
        }

        items.forEach((item, index) => {
            const metaParts = [
                item.category || '',
                item.type ? `Type: ${item.type}` : '',
                item.size_label || item.size ? `Size: ${item.size_label || item.size}` : '',
                item.sqm ? `${item.sqm}m²` : '',
                item.qty ? `Qty ${item.qty}` : '',
            ].filter(Boolean);

            const card = document.createElement('div');

            card.className = 'grid gap-4 rounded-[7px] border border-orange-100 bg-white p-4 shadow-sm sm:grid-cols-[72px_1fr_auto] sm:items-center';

            card.innerHTML = `
            <div class="h-[72px] w-[72px] overflow-hidden rounded-[7px] bg-mega-soft">
                ${item.image ? `<img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name || 'Product')}" class="h-full w-full object-cover">` : ''}
            </div>

            <div>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-mega-orange/10 px-2.5 py-1 text-[10px] font-black uppercase tracking-[0.14em] text-mega-orange">
                        Product ${index + 1}
                    </span>
                </div>

                <h4 class="mt-2 text-base font-black leading-tight text-mega-black">
                    ${escapeHtml(item.name || 'Product')}
                </h4>

                <p class="mt-1 text-sm font-semibold leading-6 text-mega-muted">
                    ${escapeHtml(metaParts.join(' · '))}
                </p>
            </div>

            <div class="rounded-[7px] bg-[#f7f3ed] px-4 py-3 text-right">
                <p class="text-[10px] font-black uppercase tracking-[0.16em] text-mega-muted">
                    Rough estimate
                </p>

                <p class="mt-1 text-xl font-black text-mega-black">
                    ${money(item.price || 0)}
                </p>
            </div>
        `;

            preview.appendChild(card);
        });
    }

    function syncQuoteItemsToQuoteForm() {
        const messageField = document.querySelector('[data-quote-message]');

        if (!messageField) {
            return;
        }

        renderSelectedProductsPreview();

        messageField.value = formatQuoteItemsForMessage();

        messageField.dispatchEvent(new Event('input', { bubbles: true }));
        messageField.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function goToQuoteFormWithProducts(event) {
        syncQuoteItemsToQuoteForm();

        const quoteSection = document.querySelector('#quote');
        const measureForm = document.querySelector('#measureQuoteForm');

        if (quoteSection || measureForm) {
            event?.preventDefault();

            closeDrawers();

            const target = quoteSection || measureForm;

            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start',
            });

            setTimeout(() => {
                const noteField = document.querySelector('[data-customer-note]');
                noteField?.focus();
            }, 500);
        }
    }

    document.querySelectorAll('[data-continue-quote]').forEach((button) => {
        button.addEventListener('click', goToQuoteFormWithProducts);
    });

    document.querySelector('[data-customer-note]')?.addEventListener('input', syncQuoteItemsToQuoteForm);

    if (window.location.hash === '#quote' || document.querySelector('#measureQuoteForm')) {
        setTimeout(() => {
            syncQuoteItemsToQuoteForm();
        }, 250);
    }

    document.addEventListener('megaQuoteUpdated', () => {
        syncQuoteItemsToQuoteForm();
    });
    initSizeOnlyProductCards();
    function initTypeOnlyProductCards() {
        document.querySelectorAll('[data-product-card][data-types]').forEach((card) => {
            const product = parseJson(card.dataset.product, {});
            const typeSelect = card.querySelector('[data-type-select]');
            const priceOutput = card.querySelector('[data-price-output]');
            const addQuoteButton = card.querySelector('[data-add-quote]');

            if (!typeSelect || !addQuoteButton) {
                return;
            }

            addQuoteButton.dataset.jsBound = '1';

            let selectedType = null;

            const setAddButtonState = (disabled) => {
                addQuoteButton.disabled = disabled;
                addQuoteButton.classList.toggle('opacity-60', disabled);
                addQuoteButton.classList.toggle('cursor-not-allowed', disabled);
            };

            setAddButtonState(true);

            typeSelect.addEventListener('change', () => {
                const selectedOption = typeSelect.options[typeSelect.selectedIndex];

                if (!selectedOption || !selectedOption.value) {
                    selectedType = null;

                    if (priceOutput) {
                        priceOutput.textContent = 'Select type';
                    }

                    setAddButtonState(true);
                    return;
                }

                selectedType = {
                    label: selectedOption.dataset.typeLabel || selectedOption.value,
                    price: Number(selectedOption.dataset.typePrice || 0),
                };

                if (priceOutput) {
                    priceOutput.textContent = money(selectedType.price) + '/m²';
                }

                setAddButtonState(false);
            });

            addQuoteButton.addEventListener('click', () => {
                if (!selectedType) {
                    typeSelect.focus();
                    return;
                }

                addToQuote(product, {
                    type: selectedType.label,
                    price: selectedType.price,
                });

                const originalText = addQuoteButton.textContent;

                addQuoteButton.textContent = 'Added to quote';

                setTimeout(() => {
                    addQuoteButton.textContent = originalText || 'Add to quote';
                }, 1200);
            });
        });
    }


    initTypeOnlyProductCards();
    document.querySelectorAll('[data-add-quote]').forEach((button) => {
        if (button.dataset.jsBound === '1') {
            return;
        }

        button.addEventListener('click', () => {
            addToQuote(parseButtonProduct(button));
        });
    });

    document
        .querySelectorAll('.wishlist-toggle, [data-wishlist-button], [data-product-wishlist]')
        .forEach((button) => {
            button.addEventListener('click', () => {
                toggleWishlist(parseButtonProduct(button));
            });
        });

    /*
    |--------------------------------------------------------------------------
    | AI Panel
    |--------------------------------------------------------------------------
    */

    const aiPanel = document.querySelector('[data-ai-panel]');

    document.querySelectorAll('[data-open-ai]').forEach((button) => {
        button.addEventListener('click', () => {
            closeHeaderSearch();
            setMobileMenuState(false);
            aiPanel?.classList.toggle('is-open');
            megaHeader?.classList.remove('is-hidden');
        });
    });

    document.querySelectorAll('[data-close-ai]').forEach((button) => {
        button.addEventListener('click', () => {
            aiPanel?.classList.remove('is-open');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Product Gallery + Zoom
    |--------------------------------------------------------------------------
    */

    function initGalleryAndZoom() {
        const mainImage = document.querySelector('[data-main-image]');

        document.querySelectorAll('[data-gallery-thumb]').forEach((button, index) => {
            if (index === 0) {
                button.classList.add('is-active');
            }

            button.addEventListener('click', () => {
                document.querySelectorAll('[data-gallery-thumb]').forEach((item) => {
                    item.classList.remove('is-active');
                });

                button.classList.add('is-active');

                if (mainImage && button.dataset.image) {
                    mainImage.src = button.dataset.image;
                }
            });
        });

        document.querySelectorAll('[data-zoom-wrap]').forEach((wrap) => {
            wrap.addEventListener('mouseenter', () => {
                wrap.classList.add('is-zooming');
            });

            wrap.addEventListener('mouseleave', () => {
                wrap.classList.remove('is-zooming');
            });

            wrap.addEventListener('mousemove', (event) => {
                const rect = wrap.getBoundingClientRect();
                const x = ((event.clientX - rect.left) / rect.width) * 100;
                const y = ((event.clientY - rect.top) / rect.height) * 100;

                wrap.style.setProperty('--zoom-x', `${x}%`);
                wrap.style.setProperty('--zoom-y', `${y}%`);
            });
        });
    }

    initGalleryAndZoom();

    /*
    |--------------------------------------------------------------------------
    | Measure Quote Multi-step Form
    |--------------------------------------------------------------------------
    */

    function initMeasureQuoteForm() {
        const form = document.getElementById('measureQuoteForm');

        if (!form) {
            return;
        }

        const tabs = form.querySelectorAll('[data-step-tab]');
        const panels = form.querySelectorAll('[data-step-panel]');
        const nextButtons = form.querySelectorAll('[data-next-step]');
        const prevButtons = form.querySelectorAll('[data-prev-step]');

        if (!tabs.length || !panels.length) {
            return;
        }

        let currentStep = 1;

        const showStep = (step) => {
            currentStep = step;

            tabs.forEach((tab) => {
                const tabStep = Number(tab.dataset.stepTab);
                tab.classList.toggle('is-active', tabStep <= currentStep);
            });

            panels.forEach((panel) => {
                const panelStep = Number(panel.dataset.stepPanel);
                panel.classList.toggle('is-active', panelStep === currentStep);
            });

            window.scrollTo({
                top: form.getBoundingClientRect().top + window.scrollY - 130,
                behavior: 'smooth',
            });
        };

        const validateCurrentStep = () => {
            const activePanel = form.querySelector(`[data-step-panel="${currentStep}"]`);

            if (!activePanel) {
                return true;
            }

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
                    const labelText = label ? label.innerText.replace('*', '').trim() : 'this field';

                    alert(`Please select at least one option for "${labelText}".`);
                    return false;
                }
            }

            return true;
        };

        nextButtons.forEach((button) => {
            button.addEventListener('click', () => {
                if (!validateCurrentStep()) {
                    return;
                }

                showStep(Math.min(currentStep + 1, 3));
            });
        });

        prevButtons.forEach((button) => {
            button.addEventListener('click', () => {
                showStep(Math.max(currentStep - 1, 1));
            });
        });

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
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

        showStep(1);
    }

    initMeasureQuoteForm();

    /*
    |--------------------------------------------------------------------------
    | Escape Key
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') {
            return;
        }

        closeHeaderSearch();
        closeDrawers();
        setMobileMenuState(false);
        aiPanel?.classList.remove('is-open');
    });

    updateHeaderCounts();
    updateWishlistButtons();
    renderQuoteDrawer();
    renderWishlistDrawer();
});