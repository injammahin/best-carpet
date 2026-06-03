import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const QUOTE_KEY = 'mega_quote_items_static';
    const WISHLIST_KEY = 'mega_wishlist_static';

    const getStored = (key) => {
        try {
            return JSON.parse(localStorage.getItem(key) || '[]');
        } catch (error) {
            return [];
        }
    };

    const setStored = (key, value) => {
        localStorage.setItem(key, JSON.stringify(value));
    };

    const money = (amount) => {
        return '$' + Number(amount || 0).toLocaleString('en-US');
    };

    const updateCounts = () => {
        const quoteItems = getStored(QUOTE_KEY);
        const wishlistItems = getStored(WISHLIST_KEY);

        document.querySelectorAll('[data-quote-count]').forEach((el) => {
            el.textContent = quoteItems.length;
            el.classList.toggle('hidden', quoteItems.length === 0);
        });

        document.querySelectorAll('[data-wishlist-count]').forEach((el) => {
            el.textContent = wishlistItems.length;
            el.classList.toggle('hidden', wishlistItems.length === 0);
        });

        document.querySelectorAll('.wishlist-toggle').forEach((button) => {
            const id = Number(button.dataset.productId);
            const active = wishlistItems.some((item) => Number(item.id) === id);

            button.classList.toggle('is-active', active);

            const icon = button.querySelector('svg');
            if (icon) {
                icon.setAttribute('fill', active ? 'currentColor' : 'none');
            }
        });
    };

    const parseProduct = (button) => {
        try {
            return JSON.parse(button.dataset.product || '{}');
        } catch (error) {
            return {};
        }
    };

    const megaHeader = document.querySelector('[data-mega-header]');
    let lastHeaderScroll = window.scrollY || 0;
    let tickingHeader = false;

    const handlePremiumHeader = () => {
        if (!megaHeader) return;

        const currentScroll = window.scrollY || 0;
        const mobileMenu = document.querySelector('[data-mobile-menu]');
        const mobileMenuOpen = mobileMenu?.classList.contains('is-open');
        const searchOpen = document.querySelector('[data-header-search]')?.classList.contains('is-open');

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
    };

    window.addEventListener('scroll', () => {
        if (!tickingHeader) {
            window.requestAnimationFrame(handlePremiumHeader);
            tickingHeader = true;
        }
    }, { passive: true });

    handlePremiumHeader();

    const mobileMenuButton = document.querySelector('[data-mobile-menu-button]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    const menuOpenIcon = document.querySelector('[data-menu-open-icon]');
    const menuCloseIcon = document.querySelector('[data-menu-close-icon]');

    const setMobileMenuState = (isOpen) => {
        if (!mobileMenu) return;

        mobileMenu.classList.toggle('is-open', isOpen);

        if (menuOpenIcon && menuCloseIcon) {
            menuOpenIcon.classList.toggle('hidden', isOpen);
            menuCloseIcon.classList.toggle('hidden', !isOpen);
        }

        if (megaHeader) {
            megaHeader.classList.remove('is-hidden');
        }
    };

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            setMobileMenuState(!mobileMenu.classList.contains('is-open'));
        });

        mobileMenu.querySelectorAll('a, button').forEach((item) => {
            item.addEventListener('click', () => {
                setMobileMenuState(false);
            });
        });
    }

    const searchToggleButtons = document.querySelectorAll('[data-search-toggle]');
    const headerSearchPanel = document.querySelector('[data-header-search]');
    const searchCloseButton = document.querySelector('[data-search-close]');

    const closeHeaderSearch = () => {
        if (!headerSearchPanel) return;

        headerSearchPanel.classList.remove('is-open');

        searchToggleButtons.forEach((button) => {
            button.classList.remove('is-active');
        });
    };

    const openHeaderSearch = () => {
        if (!headerSearchPanel) return;

        setMobileMenuState(false);

        headerSearchPanel.classList.add('is-open');

        searchToggleButtons.forEach((button) => {
            button.classList.add('is-active');
        });

        const searchInput = headerSearchPanel.querySelector('input[type="search"]');

        setTimeout(() => {
            searchInput?.focus();
        }, 120);

        if (megaHeader) {
            megaHeader.classList.remove('is-hidden');
        }
    };

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

    if (searchCloseButton) {
        searchCloseButton.addEventListener('click', closeHeaderSearch);
    }

    document.addEventListener('click', (event) => {
        if (!headerSearchPanel?.classList.contains('is-open')) return;

        const clickedInsideSearch = headerSearchPanel.contains(event.target);
        const clickedToggle = event.target.closest('[data-search-toggle]');

        if (!clickedInsideSearch && !clickedToggle) {
            closeHeaderSearch();
        }
    });

    const slides = Array.from(document.querySelectorAll('.hero-slide'));
    const slideContents = Array.from(document.querySelectorAll('.hero-slide-content'));
    const dots = Array.from(document.querySelectorAll('.hero-dot'));
    const nextButtons = document.querySelectorAll('[data-hero-next]');
    const prevButtons = document.querySelectorAll('[data-hero-prev]');

    let activeSlide = 0;

    const showSlide = (index) => {
        if (!slides.length) return;

        activeSlide = (index + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            slide.classList.toggle('is-active', slideIndex === activeSlide);
        });

        slideContents.forEach((content, contentIndex) => {
            content.classList.toggle('hidden', contentIndex !== activeSlide);
        });

        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('is-active', dotIndex === activeSlide);
        });
    };

    nextButtons.forEach((button) => {
        button.addEventListener('click', () => {
            showSlide(activeSlide + 1);
        });
    });

    prevButtons.forEach((button) => {
        button.addEventListener('click', () => {
            showSlide(activeSlide - 1);
        });
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
        });
    });

    if (slides.length) {
        showSlide(0);

        setInterval(() => {
            showSlide(activeSlide + 1);
        }, 5200);
    }

    const searchInput = document.querySelector('[data-product-search]');
    const categoryFilter = document.querySelector('[data-category-filter]');
    const roomFilter = document.querySelector('[data-room-filter]');
    const productCards = Array.from(document.querySelectorAll('[data-product-card]'));
    const productCount = document.querySelector('[data-product-count]');

    const filterProducts = () => {
        const search = (searchInput?.value || '').toLowerCase();
        const category = categoryFilter?.value || 'All';
        const room = roomFilter?.value || 'All';

        let visibleCount = 0;

        productCards.forEach((card) => {
            const searchable = (card.dataset.search || '').toLowerCase();
            const cardCategory = card.dataset.category || '';
            const cardRoom = card.dataset.room || '';

            const matchesSearch = searchable.includes(search);
            const matchesCategory = category === 'All' || cardCategory === category;
            const matchesRoom = room === 'All' || cardRoom === room;

            const shouldShow = matchesSearch && matchesCategory && matchesRoom;

            card.classList.toggle('hidden', !shouldShow);

            if (shouldShow) {
                visibleCount++;
            }
        });

        if (productCount) {
            productCount.textContent = `${visibleCount} products showing`;
        }
    };

    [searchInput, categoryFilter, roomFilter].forEach((el) => {
        if (el) {
            el.addEventListener('input', filterProducts);
            el.addEventListener('change', filterProducts);
        }
    });

    filterProducts();

    const quoteDrawer = document.querySelector('[data-quote-drawer]');
    const wishlistDrawer = document.querySelector('[data-wishlist-drawer]');

    const openDrawer = (drawer) => {
        if (!drawer) return;

        closeHeaderSearch();
        setMobileMenuState(false);

        drawer.classList.add('is-open');
        document.body.style.overflow = 'hidden';

        if (megaHeader) {
            megaHeader.classList.remove('is-hidden');
        }
    };

    const closeDrawers = () => {
        document.querySelectorAll('.drawer').forEach((drawer) => {
            drawer.classList.remove('is-open');
        });

        document.body.style.overflow = '';
    };

    document.querySelectorAll('[data-close-drawer]').forEach((button) => {
        button.addEventListener('click', closeDrawers);
    });

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

    const saveQuote = (items) => {
        setStored(QUOTE_KEY, items);
        updateCounts();
    };

    const addToQuote = (product) => {
        if (!product || !product.id) return;

        const items = getStored(QUOTE_KEY);
        const existing = items.find((item) => Number(item.id) === Number(product.id));

        if (existing) {
            existing.qty += 1;
        } else {
            items.push({
                id: product.id,
                name: product.name,
                category: product.category,
                price: Number(product.price),
                image: product.image,
                qty: 1,
            });
        }

        saveQuote(items);
        renderQuoteDrawer();
        openDrawer(quoteDrawer);
    };

    const updateQty = (id, delta) => {
        let items = getStored(QUOTE_KEY);

        items = items
            .map((item) => {
                if (Number(item.id) === Number(id)) {
                    return {
                        ...item,
                        qty: Math.max(0, Number(item.qty) + delta),
                    };
                }

                return item;
            })
            .filter((item) => item.qty > 0);

        saveQuote(items);
        renderQuoteDrawer();
    };

    const renderQuoteDrawer = () => {
        const list = document.querySelector('[data-quote-list]');
        const empty = document.querySelector('[data-quote-empty]');
        const totalEl = document.querySelector('[data-quote-total]');

        if (!list || !empty || !totalEl) return;

        const items = getStored(QUOTE_KEY);
        const total = items.reduce((sum, item) => sum + Number(item.price) * Number(item.qty), 0);

        empty.classList.toggle('hidden', items.length > 0);
        list.innerHTML = '';

        items.forEach((item) => {
            const row = document.createElement('div');

            row.className = 'grid grid-cols-[86px_1fr] gap-4 rounded-[7px] border border-mega-line p-3 shadow-sm';

            row.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="h-24 w-full rounded-[7px] object-cover">

                <div>
                    <h3 class="font-extrabold leading-tight text-mega-black">${item.name}</h3>
                    <p class="mt-1 text-sm font-bold text-mega-muted">${money(item.price)}/m² · ${item.category}</p>

                    <div class="mt-3 flex items-center justify-between">
                        <div class="flex items-center rounded-[7px] border border-mega-line">
                            <button type="button" class="grid h-8 w-8 place-items-center" data-qty-minus="${item.id}">−</button>
                            <span class="grid h-8 w-9 place-items-center text-sm font-extrabold">${item.qty}</span>
                            <button type="button" class="grid h-8 w-8 place-items-center" data-qty-plus="${item.id}">+</button>
                        </div>

                        <strong class="text-sm font-extrabold text-mega-black">${money(item.qty * item.price)}</strong>
                    </div>
                </div>
            `;

            list.appendChild(row);
        });

        totalEl.textContent = money(total);

        document.querySelectorAll('[data-qty-minus]').forEach((button) => {
            button.addEventListener('click', () => {
                updateQty(button.dataset.qtyMinus, -1);
            });
        });

        document.querySelectorAll('[data-qty-plus]').forEach((button) => {
            button.addEventListener('click', () => {
                updateQty(button.dataset.qtyPlus, 1);
            });
        });
    };

    document.querySelectorAll('[data-add-quote]').forEach((button) => {
        button.addEventListener('click', () => {
            addToQuote(parseProduct(button));
        });
    });

    const saveWishlist = (items) => {
        setStored(WISHLIST_KEY, items);
        updateCounts();
    };

    const isWishlisted = (id) => {
        const items = getStored(WISHLIST_KEY);
        return items.some((item) => Number(item.id) === Number(id));
    };

    const toggleWishlist = (product) => {
        if (!product || !product.id) return;

        let items = getStored(WISHLIST_KEY);

        if (isWishlisted(product.id)) {
            items = items.filter((item) => Number(item.id) !== Number(product.id));
        } else {
            items.push({
                id: product.id,
                name: product.name,
                category: product.category,
                price: Number(product.price),
                image: product.image,
            });
        }

        saveWishlist(items);
        renderWishlistDrawer();
    };

    const renderWishlistDrawer = () => {
        const list = document.querySelector('[data-wishlist-list]');
        const empty = document.querySelector('[data-wishlist-empty]');

        if (!list || !empty) return;

        const items = getStored(WISHLIST_KEY);

        empty.classList.toggle('hidden', items.length > 0);
        list.innerHTML = '';

        items.forEach((item) => {
            const row = document.createElement('div');

            row.className = 'grid grid-cols-[86px_1fr] gap-4 rounded-[7px] border border-mega-line p-3 shadow-sm';

            row.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="h-24 w-full rounded-[7px] object-cover">

                <div>
                    <h3 class="font-extrabold leading-tight text-mega-black">${item.name}</h3>
                    <p class="mt-1 text-sm font-bold text-mega-muted">${money(item.price)}/m² · ${item.category}</p>

                    <div class="mt-3 flex gap-2">
                        <button type="button" class="rounded-[7px] bg-mega-orange px-3 py-2 text-xs font-extrabold text-white" data-wishlist-add-quote="${item.id}">
                            Add to quote
                        </button>

                        <button type="button" class="rounded-[7px] bg-mega-soft px-3 py-2 text-xs font-extrabold text-mega-black" data-wishlist-remove="${item.id}">
                            Remove
                        </button>
                    </div>
                </div>
            `;

            list.appendChild(row);
        });

        document.querySelectorAll('[data-wishlist-remove]').forEach((button) => {
            button.addEventListener('click', () => {
                const item = items.find((product) => Number(product.id) === Number(button.dataset.wishlistRemove));
                if (item) {
                    toggleWishlist(item);
                }
            });
        });

        document.querySelectorAll('[data-wishlist-add-quote]').forEach((button) => {
            button.addEventListener('click', () => {
                const item = items.find((product) => Number(product.id) === Number(button.dataset.wishlistAddQuote));
                if (item) {
                    addToQuote(item);
                }
            });
        });
    };

    document.querySelectorAll('.wishlist-toggle').forEach((button) => {
        button.addEventListener('click', () => {
            toggleWishlist(parseProduct(button));
        });
    });

    const aiButton = document.querySelector('[data-open-ai]');
    const aiPanel = document.querySelector('[data-ai-panel]');
    const aiClose = document.querySelector('[data-close-ai]');

    if (aiButton && aiPanel) {
        aiButton.addEventListener('click', () => {
            closeHeaderSearch();
            setMobileMenuState(false);

            aiPanel.classList.toggle('is-open');

            if (megaHeader) {
                megaHeader.classList.remove('is-hidden');
            }
        });
    }

    if (aiClose && aiPanel) {
        aiClose.addEventListener('click', () => {
            aiPanel.classList.remove('is-open');
        });
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeHeaderSearch();
            closeDrawers();
            setMobileMenuState(false);

            if (aiPanel) {
                aiPanel.classList.remove('is-open');
            }
        }
    });

    updateCounts();
    renderQuoteDrawer();
    renderWishlistDrawer();
});
document.addEventListener('DOMContentLoaded', () => {
    const storage = {
        get(key) {
            try {
                return JSON.parse(localStorage.getItem(key)) || [];
            } catch (error) {
                return [];
            }
        },
        set(key, value) {
            localStorage.setItem(key, JSON.stringify(value));
        },
    };

    const quoteKey = 'mega_quote_products';
    const wishlistKey = 'mega_wishlist_products';

    const money = (amount) => `$${Number(amount || 0).toLocaleString('en-US')}`;

    function updateCounts() {
        const quoteItems = storage.get(quoteKey);
        const wishlistItems = storage.get(wishlistKey);

        document.querySelectorAll('[data-quote-count]').forEach((badge) => {
            badge.textContent = quoteItems.length;
            badge.classList.toggle('hidden', quoteItems.length === 0);
        });

        document.querySelectorAll('[data-wishlist-count]').forEach((badge) => {
            badge.textContent = wishlistItems.length;
            badge.classList.toggle('hidden', wishlistItems.length === 0);
        });

        document.querySelectorAll('[data-wishlist-button]').forEach((button) => {
            const id = Number(button.dataset.productId);
            const exists = wishlistItems.some((item) => Number(item.id) === id);
            button.classList.toggle('is-active', exists);
        });
    }

    function renderQuoteDrawer() {
        const list = document.querySelector('[data-quote-list]');
        const empty = document.querySelector('[data-quote-empty]');
        const totalNode = document.querySelector('[data-quote-total]');
        if (!list || !empty || !totalNode) return;

        const items = storage.get(quoteKey);
        list.innerHTML = '';

        empty.classList.toggle('hidden', items.length > 0);

        let total = 0;

        items.forEach((item) => {
            total += Number(item.price || 0);

            const row = document.createElement('div');
            row.className = 'grid grid-cols-[78px_1fr_auto] gap-3 border border-mega-line bg-white p-3 shadow-sm radius-7';

            row.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="h-[78px] w-[78px] object-cover radius-7">
                <div>
                    <h4 class="text-sm font-semibold leading-tight text-mega-black">${item.name}</h4>
                    <p class="mt-1 text-xs text-mega-muted">${item.category} · ${item.colour || ''}</p>
                    <p class="mt-1 text-xs text-mega-muted">${item.type || ''}</p>
                    <p class="mt-2 text-sm font-semibold text-mega-black">${money(item.price)}/m²</p>
                </div>
                <button type="button" class="h-8 w-8 text-mega-muted hover:text-mega-orange" data-remove-quote="${item.id}">
                    ×
                </button>
            `;

            list.appendChild(row);
        });

        totalNode.textContent = money(total);

        list.querySelectorAll('[data-remove-quote]').forEach((button) => {
            button.addEventListener('click', () => {
                const id = Number(button.dataset.removeQuote);
                const updated = storage.get(quoteKey).filter((item) => Number(item.id) !== id);
                storage.set(quoteKey, updated);
                renderQuoteDrawer();
                updateCounts();
            });
        });
    }

    function renderWishlistDrawer() {
        const list = document.querySelector('[data-wishlist-list]');
        const empty = document.querySelector('[data-wishlist-empty]');
        if (!list || !empty) return;

        const items = storage.get(wishlistKey);
        list.innerHTML = '';

        empty.classList.toggle('hidden', items.length > 0);

        items.forEach((item) => {
            const row = document.createElement('div');
            row.className = 'grid grid-cols-[78px_1fr_auto] gap-3 border border-mega-line bg-white p-3 shadow-sm radius-7';

            row.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="h-[78px] w-[78px] object-cover radius-7">
                <div>
                    <h4 class="text-sm font-semibold leading-tight text-mega-black">${item.name}</h4>
                    <p class="mt-1 text-xs text-mega-muted">${item.category}</p>
                    <a href="/products/${item.slug}" class="mt-2 inline-flex text-xs font-medium text-mega-orange">View product →</a>
                </div>
                <button type="button" class="h-8 w-8 text-mega-muted hover:text-mega-orange" data-remove-wishlist="${item.id}">
                    ×
                </button>
            `;

            list.appendChild(row);
        });

        list.querySelectorAll('[data-remove-wishlist]').forEach((button) => {
            button.addEventListener('click', () => {
                const id = Number(button.dataset.removeWishlist);
                const updated = storage.get(wishlistKey).filter((item) => Number(item.id) !== id);
                storage.set(wishlistKey, updated);
                renderWishlistDrawer();
                updateCounts();
            });
        });
    }

    function openDrawer(drawer) {
        if (!drawer) return;
        drawer.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawers() {
        document.querySelectorAll('.drawer').forEach((drawer) => drawer.classList.remove('is-open'));
        document.body.style.overflow = '';
    }

    document.querySelectorAll('[data-open-quote]').forEach((button) => {
        button.addEventListener('click', () => {
            renderQuoteDrawer();
            openDrawer(document.querySelector('[data-quote-drawer]'));
        });
    });

    document.querySelectorAll('[data-open-wishlist]').forEach((button) => {
        button.addEventListener('click', () => {
            renderWishlistDrawer();
            openDrawer(document.querySelector('[data-wishlist-drawer]'));
        });
    });

    document.querySelectorAll('[data-close-drawer]').forEach((button) => {
        button.addEventListener('click', closeDrawers);
    });

    const aiPanel = document.querySelector('[data-ai-panel]');
    document.querySelectorAll('[data-open-ai]').forEach((button) => {
        button.addEventListener('click', () => aiPanel?.classList.toggle('is-open'));
    });
    document.querySelectorAll('[data-close-ai]').forEach((button) => {
        button.addEventListener('click', () => aiPanel?.classList.remove('is-open'));
    });

    document.querySelectorAll('[data-product-card]').forEach((card) => {
        let variants = [];
        let product = {};
        let selectedColour = null;
        let selectedType = null;

        try {
            variants = JSON.parse(card.dataset.variants || '[]');
            product = JSON.parse(card.dataset.product || '{}');
        } catch (error) {
            variants = [];
            product = {};
        }

        const colourName = card.querySelector('[data-selected-colour]');
        const typeList = card.querySelector('[data-type-list]');
        const priceOutput = card.querySelector('[data-price-output]');
        const addButton = card.querySelector('[data-add-quote]');

        function resetType() {
            selectedType = null;
            priceOutput.textContent = 'Select type';
            addButton.disabled = true;
            addButton.classList.add('opacity-60');
        }

        function renderTypes(types) {
            typeList.innerHTML = '';

            types.forEach((type) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'type-choice';
                button.textContent = `${type.label} · ${money(type.price)}/m²`;
                button.dataset.typeLabel = type.label;
                button.dataset.typePrice = type.price;

                button.addEventListener('click', () => {
                    typeList.querySelectorAll('.type-choice').forEach((item) => item.classList.remove('is-active'));
                    button.classList.add('is-active');

                    selectedType = {
                        label: type.label,
                        price: Number(type.price),
                    };

                    priceOutput.textContent = `${money(type.price)}/m²`;
                    addButton.disabled = false;
                    addButton.classList.remove('opacity-60');
                });

                typeList.appendChild(button);
            });
        }

        card.querySelectorAll('[data-colour-index]').forEach((button) => {
            button.addEventListener('click', () => {
                const index = Number(button.dataset.colourIndex);
                selectedColour = variants[index];

                card.querySelectorAll('[data-colour-index]').forEach((item) => item.classList.remove('is-active'));
                button.classList.add('is-active');

                colourName.textContent = selectedColour ? selectedColour.name : 'Select a colour first.';

                resetType();

                if (selectedColour && selectedColour.types) {
                    renderTypes(selectedColour.types);
                }
            });
        });

        addButton?.addEventListener('click', () => {
            if (!selectedColour || !selectedType) return;

            const items = storage.get(quoteKey);
            const finalItem = {
                ...product,
                colour: selectedColour.name,
                type: selectedType.label,
                price: selectedType.price,
            };

            const exists = items.some((item) => Number(item.id) === Number(product.id));
            const updated = exists
                ? items.map((item) => Number(item.id) === Number(product.id) ? finalItem : item)
                : [...items, finalItem];

            storage.set(quoteKey, updated);
            updateCounts();
            renderQuoteDrawer();
            openDrawer(document.querySelector('[data-quote-drawer]'));
        });
    });

    document.querySelectorAll('[data-wishlist-button]').forEach((button) => {
        button.addEventListener('click', () => {
            const card = button.closest('[data-product-card]');
            if (!card) return;

            let product = {};
            try {
                product = JSON.parse(card.dataset.product || '{}');
            } catch (error) {
                product = {};
            }

            const items = storage.get(wishlistKey);
            const exists = items.some((item) => Number(item.id) === Number(product.id));

            const updated = exists
                ? items.filter((item) => Number(item.id) !== Number(product.id))
                : [...items, product];

            storage.set(wishlistKey, updated);
            renderWishlistDrawer();
            updateCounts();
        });
    });

    const searchInput = document.querySelector('[data-product-search]');
    const categoryFilter = document.querySelector('[data-category-filter]');
    const roomFilter = document.querySelector('[data-room-filter]');
    const countNode = document.querySelector('[data-product-count]');

    function filterProducts() {
        const search = (searchInput?.value || '').trim().toLowerCase();
        const category = categoryFilter?.value || 'All';
        const room = roomFilter?.value || 'All';

        let count = 0;

        document.querySelectorAll('[data-product-card]').forEach((card) => {
            const matchesSearch = !search || (card.dataset.search || '').includes(search);
            const matchesCategory = category === 'All' || card.dataset.category === category;
            const matchesRoom = room === 'All' || card.dataset.room === room;

            const visible = matchesSearch && matchesCategory && matchesRoom;
            card.classList.toggle('is-hidden', !visible);

            if (visible) count++;
        });

        if (countNode) {
            countNode.textContent = `${count} products showing`;
        }
    }

    [searchInput, categoryFilter, roomFilter].forEach((input) => {
        input?.addEventListener('input', filterProducts);
        input?.addEventListener('change', filterProducts);
    });

    const slides = Array.from(document.querySelectorAll('.hero-slide'));
    const contents = Array.from(document.querySelectorAll('.hero-slide-content'));
    const dots = Array.from(document.querySelectorAll('.hero-dot'));
    const next = document.querySelector('[data-hero-next]');
    const prev = document.querySelector('[data-hero-prev]');
    let activeSlide = 0;

    function showSlide(index) {
        activeSlide = (index + slides.length) % slides.length;

        slides.forEach((slide, i) => slide.classList.toggle('is-active', i === activeSlide));
        contents.forEach((content, i) => content.classList.toggle('hidden', i !== activeSlide));
        dots.forEach((dot, i) => dot.classList.toggle('is-active', i === activeSlide));
    }

    next?.addEventListener('click', () => showSlide(activeSlide + 1));
    prev?.addEventListener('click', () => showSlide(activeSlide - 1));
    dots.forEach((dot, index) => dot.addEventListener('click', () => showSlide(index)));

    if (slides.length) {
        setInterval(() => showSlide(activeSlide + 1), 6500);
    }

    updateCounts();
});