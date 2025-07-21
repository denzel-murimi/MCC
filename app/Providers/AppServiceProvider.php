<?php

namespace App\Providers;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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
        $this->app->bind(LogoutResponse::class, function () {
            return new class implements LogoutResponse {
                public function toResponse($request)
                {
                    return to_route('home');
                }
            };
        });

        $this->app->singleton('hashids', function () {
            return new Hashids(config('hashids.salt'), config('hashids.min_length'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Response::macro('secure', function ($response) {
            return $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');
        });

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

//        DB::listen(function ($query) {
//            Log::info($query->sql);
//        });

        if(!$this->app->isLocal()){
            URL::forceHttps();
        }

        Route::bind('hashid', function ($hashid) {
            try{
                return \App\Support\Facade\Hashids::decode($hashid)[0];
            }catch (\Exception $e){
                Log::error('HAshID Error:', [$e->getMessage()]);
                abort(404, 'No record found');
            }
        });

    }
}
