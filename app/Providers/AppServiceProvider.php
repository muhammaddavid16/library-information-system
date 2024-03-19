<?php

namespace App\Providers;

use App\Contracts\BookContract;
use App\Contracts\BookshelfContract;
use App\Contracts\CategoryContract;
use App\Contracts\LoanContract;
use App\Contracts\LoanTrackingContract;
use App\Contracts\MemberContract;
use App\Contracts\SettingContract;
use App\Contracts\UserContract;
use App\Services\BookService;
use App\Services\BookshelfService;
use App\Services\CategoryService;
use App\Services\LoanService;
use App\Services\LoanTrackingService;
use App\Services\MemberService;
use App\Services\SettingService;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $singletons = [
        UserContract::class => UserService::class,
        MemberContract::class => MemberService::class,
        CategoryContract::class => CategoryService::class,
        BookshelfContract::class => BookshelfService::class,
        BookContract::class => BookService::class,
        LoanContract::class => LoanService::class,
        LoanTrackingContract::class => LoanTrackingService::class,
        SettingContract::class => SettingService::class,
    ];

    public function provides(): array
    {
        return [
            UserContract::class,
            MemberContract::class,
            CategoryContract::class,
            BookshelfContract::class,
            BookContract::class,
            LoanContract::class,
            LoanTrackingContract::class,
            SettingContract::class,
        ];
    }

    public function register(): void
    {
    }

    public function boot(): void
    {
        Paginator::useBootstrapFour();

        // Autofocus
        Blade::directive('autofocus', fn (bool $expression = false) => "<?= ($expression) ? 'autofocus' : '' ?>");
    }
}
