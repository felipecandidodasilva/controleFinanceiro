<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('dinheiro', function($valor){
            return "<?php echo number_format($valor,2,',','.'); ?>";
        });

        Blade::directive('dataBr', function($data){
            return "<?php echo  date('d/m/Y', strtotime($data)) ; ?>";
        });


    }
}
