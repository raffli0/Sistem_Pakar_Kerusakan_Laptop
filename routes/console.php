<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:about-project', function () {
    $this->info('Sistem Pakar Diagnosa Kerusakan Hardware dan Software Laptop');
});
