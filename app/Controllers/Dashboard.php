<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Sesuaikan nama string di dalam view() dengan nama file view milikmu
        // Misalnya filemu ada di app/Views/umkm/dashboard_mandiri.php
        return view('umkm/dashboard_grup'); 
    }
}