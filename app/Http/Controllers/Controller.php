<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// Memeriksa koneksi DB.
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Memeriksa koneksi DB.
    public function db_try_connect() {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return 0;
        }
        return 1;
    }
}
