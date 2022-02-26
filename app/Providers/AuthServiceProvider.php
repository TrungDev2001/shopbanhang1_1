<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
        Slider::class => SliderPolicy::class,
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\Ads' => 'App\Policies\AdsPolicy',
        'App\Models\Oder' => 'App\Policies\ManageOderPolicy',
        'App\Models\Voucher' => 'App\Policies\VoucherPolicy',
        'App\Models\TransportFee' => 'App\Policies\TransportFeePolicy',
        'App\Models\CategoryPost' => 'App\Policies\CategoryPostPolicy',
        Post::class => PostPolicy::class,
        Video::class => VideoPolicy::class,
        Contact::class => ContactPolicy::class,
        ProductDocument::class => DocumentPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->gateDefine();
    }

    public function gateDefine()
    {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@viewAny');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');

        Gate::define('brand-list', 'App\Policies\BrandPolicy@viewAny');
        Gate::define('brand-add', 'App\Policies\BrandPolicy@create');
        Gate::define('brand-edit', 'App\Policies\BrandPolicy@update');
        Gate::define('brand-delete', 'App\Policies\BrandPolicy@delete');

        Gate::define('slider-list', 'App\Policies\SliderPolicy@viewAny');
        Gate::define('slider-add', 'App\Policies\SliderPolicy@create');
        Gate::define('slider-edit', 'App\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SliderPolicy@delete');

        Gate::define('product-list', 'App\Policies\ProductPolicy@viewAny');
        Gate::define('product-add', 'App\Policies\ProductPolicy@create');
        Gate::define('product-edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product-delete', 'App\Policies\ProductPolicy@delete');

        Gate::define('ads-list', 'App\Policies\AdsPolicy@viewAny');
        Gate::define('ads-add', 'App\Policies\AdsPolicy@create');
        Gate::define('ads-edit', 'App\Policies\AdsPolicy@update');
        Gate::define('ads-delete', 'App\Policies\AdsPolicy@delete');

        Gate::define('manageOrder-list', 'App\Policies\ManageOderPolicy@viewAny');
        Gate::define('manageOrder-print', 'App\Policies\ManageOderPolicy@print');
        Gate::define('manageOrder-edit', 'App\Policies\ManageOderPolicy@update');
        Gate::define('manageOrder-show', 'App\Policies\ManageOderPolicy@view');

        Gate::define('voucher-list', 'App\Policies\VoucherPolicy@viewAny');
        Gate::define('voucher-add', 'App\Policies\VoucherPolicy@create');
        Gate::define('voucher-edit', 'App\Policies\VoucherPolicy@update');
        Gate::define('voucher-delete', 'App\Policies\VoucherPolicy@delete');

        Gate::define('transportFee-list', 'App\Policies\TransportFeePolicy@viewAny');
        Gate::define('transportFee-add', 'App\Policies\TransportFeePolicy@create');
        Gate::define('transportFee-edit', 'App\Policies\TransportFeePolicy@update');
        Gate::define('transportFee-delete', 'App\Policies\TransportFeePolicy@delete');

        Gate::define('categoryPost-list', 'App\Policies\CategoryPostPolicy@viewAny');
        Gate::define('categoryPost-add', 'App\Policies\CategoryPostPolicy@create');
        Gate::define('categoryPost-edit', 'App\Policies\CategoryPostPolicy@update');
        Gate::define('categoryPost-delete', 'App\Policies\CategoryPostPolicy@delete');

        Gate::define('post-list', 'App\Policies\PostPolicy@viewAny');
        Gate::define('post-add', 'App\Policies\PostPolicy@create');
        Gate::define('post-edit', 'App\Policies\PostPolicy@update');
        Gate::define('post-delete', 'App\Policies\PostPolicy@delete');

        Gate::define('video-list', 'App\Policies\VideoPolicy@viewAny');
        Gate::define('video-add', 'App\Policies\VideoPolicy@create');
        Gate::define('video-edit', 'App\Policies\VideoPolicy@update');
        Gate::define('video-delete', 'App\Policies\VideoPolicy@delete');

        Gate::define('contact-list', 'App\Policies\ContactPolicy@viewAny');
        Gate::define('contact-reply', 'App\Policies\ContactPolicy@reply_message');
        Gate::define('contact-edit', 'App\Policies\ContactPolicy@update');
        Gate::define('contact-delete', 'App\Policies\ContactPolicy@delete');

        Gate::define('document-list', 'App\Policies\DocumentPolicy@viewAny');
        Gate::define('document-delete', 'App\Policies\DocumentPolicy@delete');

        Gate::define('user-list', 'App\Policies\UserPolicy@viewAny');
        Gate::define('user-add', 'App\Policies\UserPolicy@create');
        Gate::define('user-edit', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');

        Gate::define('role-list', 'App\Policies\RolePolicy@viewAny');
        Gate::define('role-add', 'App\Policies\RolePolicy@create');
        Gate::define('role-edit', 'App\Policies\RolePolicy@update');
        Gate::define('role-delete', 'App\Policies\RolePolicy@delete');

        Gate::define('permission-list', 'App\Policies\PermissionPolicy@viewAny');
        Gate::define('permission-add', 'App\Policies\PermissionPolicy@create');
    }
}
