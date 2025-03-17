<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Định nghĩa route model bindings và pattern filters.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Đăng ký các routes của ứng dụng.
     */
    public function map(): void
    {
        $this->mapApiRoutes(); // Đăng ký API routes
        $this->mapWebRoutes(); // Đăng ký Web routes
    }

    /**
     * Định nghĩa API routes.
     */
    protected function mapApiRoutes(): void
    {
        Route::middleware('api') // Sử dụng middleware API
            ->prefix('api') // Thêm tiền tố /api vào đường dẫn
            ->group(base_path('routes/api.php')); // Load file api.php từ thư mục routes
    }

    /**
     * Định nghĩa Web routes.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
