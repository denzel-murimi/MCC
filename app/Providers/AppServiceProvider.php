<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\BackupsCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DatabaseSizeCheck;
use Spatie\Health\Checks\Checks\DatabaseTableSizeCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\QueueCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Health::checks([
            BackupsCheck::new(),
            CacheCheck::new(),
            DatabaseCheck::new(),
            DatabaseConnectionCountCheck::new()
                ->warnWhenMoreConnectionsThan(20)
                ->failWhenMoreConnectionsThan(50),
            DatabaseSizeCheck::new()
                ->failWhenSizeAboveGb(errorThresholdGb: 2.0),
            DatabaseTableSizeCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            OptimizedAppCheck::new(),
            PingCheck::new()
                ->url((string) env('APP_URL')),
            QueueCheck::new(),
            UsedDiskSpaceCheck::new(),
        ]);

        DB::listen(function ($query) {
            Log::info($query->sql);
        });
    }
}
