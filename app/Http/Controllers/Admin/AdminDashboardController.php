<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use App\Models\Faq;
use App\Models\ProductCategory;
use App\Models\ProductRange;
use App\Models\ProductSizeOption;
use App\Models\QuoteRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_products' => $this->safeCount(ProductRange::class, 'product_ranges'),
            'active_products' => $this->safeCount(ProductRange::class, 'product_ranges', fn ($query) => $query->where('is_active', true)),

            'total_categories' => $this->safeCount(ProductCategory::class, 'product_categories'),
            'active_categories' => $this->safeCount(ProductCategory::class, 'product_categories', fn ($query) => $query->where('is_active', true)),

            'total_sizes' => $this->safeCount(ProductSizeOption::class, 'product_size_options'),
            'active_sizes' => $this->safeCount(ProductSizeOption::class, 'product_size_options', fn ($query) => $query->where('is_active', true)),

            'total_quotes' => $this->safeCount(QuoteRequest::class, 'quote_requests'),
            'unread_quotes' => $this->safeCount(QuoteRequest::class, 'quote_requests', fn ($query) => $query->whereNull('read_at')),
            'new_quotes' => $this->safeCount(QuoteRequest::class, 'quote_requests', fn ($query) => $query->where('status', 'new')),

            'total_reviews' => $this->safeCount(CustomerReview::class, 'customer_reviews'),
            'active_reviews' => $this->safeCount(CustomerReview::class, 'customer_reviews', fn ($query) => $query->where('is_active', true)),

            'total_faqs' => $this->safeCount(Faq::class, 'faqs'),
            'active_faqs' => $this->safeCount(Faq::class, 'faqs', fn ($query) => $query->where('is_active', true)),

            'settings_count' => $this->safeCount(SiteSetting::class, 'site_settings'),
        ];

        $recentQuotes = $this->recentQuotes();
        $recentProducts = $this->recentProducts();

        $dashboardCards = [
            [
                'title' => 'Total Products',
                'value' => $stats['total_products'],
                'sub_value' => $stats['active_products'] . ' active products',
                'description' => 'Product ranges shown across catalogue and homepage.',
                'icon' => 'box',
                'theme' => 'light',
                'url' => $this->routeOrNull('admin.products.index'),
            ],
            [
                'title' => 'Categories',
                'value' => $stats['total_categories'],
                'sub_value' => $stats['active_categories'] . ' active categories',
                'description' => 'Carpet, timber, hybrid, laminate, vinyl, rugs and subcategories.',
                'icon' => 'grid',
                'theme' => 'light',
                'url' => $this->routeOrNull('admin.product-categories.index'),
            ],
            [
                'title' => 'Quote Requests',
                'value' => $stats['total_quotes'],
                'sub_value' => $stats['unread_quotes'] . ' unread requests',
                'description' => 'Customer quote submissions from website forms.',
                'icon' => 'quote',
                'theme' => 'light',
                'url' => $this->routeOrNull('admin.quote-requests.index'),
            ],
            [
                'title' => 'Reviews',
                'value' => $stats['total_reviews'],
                'sub_value' => $stats['active_reviews'] . ' active reviews',
                'description' => 'Customer trust content for the homepage slider.',
                'icon' => 'star',
                'theme' => 'dark',
                'url' => $this->routeOrNull('admin.reviews.index'),
            ],
        ];

        $modules = [
            [
                'title' => 'Products',
                'desc' => 'Add and manage carpets, vinyl, timber, laminate, rugs and prices.',
                'url' => $this->routeOrNull('admin.products.index'),
                'badge' => $stats['total_products'] . ' items',
            ],
            [
                'title' => 'Categories',
                'desc' => 'Control product category and subcategory structure.',
                'url' => $this->routeOrNull('admin.product-categories.index'),
                'badge' => $stats['total_categories'] . ' categories',
            ],
            [
                'title' => 'Area Sizes',
                'desc' => 'Manage size options used for product pricing.',
                'url' => $this->routeOrNull('admin.product-sizes.index'),
                'badge' => $stats['active_sizes'] . ' active',
            ],
            [
                'title' => 'Quote Requests',
                'desc' => 'Track customer enquiries and update request status.',
                'url' => $this->routeOrNull('admin.quote-requests.index'),
                'badge' => $stats['unread_quotes'] . ' unread',
            ],
            [
                'title' => 'Reviews',
                'desc' => 'Manage customer reviews shown on the homepage.',
                'url' => $this->routeOrNull('admin.reviews.index'),
                'badge' => $stats['active_reviews'] . ' active',
            ],
            [
                'title' => 'FAQs',
                'desc' => 'Manage dynamic FAQ questions and answers.',
                'url' => $this->routeOrNull('admin.faqs.index'),
                'badge' => $stats['active_faqs'] . ' active',
            ],
            [
                'title' => 'Website Settings',
                'desc' => 'Control logo, favicon, footer, header, contact and SEO settings.',
                'url' => $this->routeOrNull('admin.settings.edit'),
                'badge' => $stats['settings_count'] . ' saved',
            ],
            [
                'title' => 'Preview Website',
                'desc' => 'Open the live frontend in a new browser tab.',
                'url' => $this->routeOrNull('frontend.home'),
                'badge' => 'Frontend',
                'external' => true,
            ],
        ];

        $quickActions = [
            [
                'label' => 'Add product',
                'url' => $this->routeOrNull('admin.products.create'),
            ],
            [
                'label' => 'View quote requests',
                'url' => $this->routeOrNull('admin.quote-requests.index'),
            ],
            [
                'label' => 'Add review',
                'url' => $this->routeOrNull('admin.reviews.create'),
            ],
            [
                'label' => 'Add FAQ',
                'url' => $this->routeOrNull('admin.faqs.create'),
            ],
            [
                'label' => 'Website settings',
                'url' => $this->routeOrNull('admin.settings.edit'),
            ],
            [
                'label' => 'Preview website',
                'url' => $this->routeOrNull('frontend.home'),
                'external' => true,
            ],
        ];

        return view('admin.dashboard', compact(
            'stats',
            'dashboardCards',
            'modules',
            'quickActions',
            'recentQuotes',
            'recentProducts'
        ));
    }

    private function safeCount(string $model, string $table, ?callable $callback = null): int
    {
        if (!class_exists($model) || !Schema::hasTable($table)) {
            return 0;
        }

        $query = $model::query();

        if ($callback) {
            $callback($query);
        }

        return (int) $query->count();
    }

    private function recentQuotes()
    {
        if (!class_exists(QuoteRequest::class) || !Schema::hasTable('quote_requests')) {
            return collect();
        }

        return QuoteRequest::query()
            ->latest()
            ->take(5)
            ->get();
    }

    private function recentProducts()
    {
        if (!class_exists(ProductRange::class) || !Schema::hasTable('product_ranges')) {
            return collect();
        }

        return ProductRange::query()
            ->with(['category'])
            ->latest()
            ->take(5)
            ->get();
    }

    private function routeOrNull(string $name): ?string
    {
        return Route::has($name) ? route($name) : null;
    }
}