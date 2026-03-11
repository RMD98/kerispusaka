<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Helpers\DBSync;
use Illuminate\Support\Facades\DB;
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
        //
         DB::macro('syncInsert', function ($table, $data) {
            return DBSync::insert($table, $data);
        });

        DB::macro('syncUpdate', function ($table, $where, $data) {
            return DBSync::update($table, $where, $data);
        });

        DB::macro('syncDelete', function ($table, $where) {
            return DBSync::delete($table, $where);
        });
        Paginator::useBootstrapFive();

    }
}
