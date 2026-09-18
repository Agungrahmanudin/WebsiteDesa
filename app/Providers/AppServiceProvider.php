<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Kontak;

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
        // Share kontak data to all views
        View::composer('*', function ($view) {
            $kontak = Kontak::first();
            if (!$kontak) {
                $kontak = (object)[
                    'nama' => 'Pemerintah Desa',
                    'nama_desa' => 'Desa Banjaran',
                    'alamat' => '',
                    'no_telepon' => '',
                    'email' => 'admin@desa.id',
                    'logo' => null,
                ];
            }
            $view->with('kontakDesa', $kontak);
        });
    }
}
