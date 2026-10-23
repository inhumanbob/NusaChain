<?php

namespace App\Controllers;

use App\Models\KonsorsiumModel;

class Konsorsium extends BaseController
{
    // Halaman konsorsium milik UMKM yang sedang login (via navbar, tanpa ID di URL)
    public function detail()
    {
        $detail = (new KonsorsiumModel())->getDetailByUser((int) session()->get('id_user'));

        if (! $detail) {
            return view('konsorsium/dashboard', ['hasKonsorsium' => false]);
        }

        return view('konsorsium/dashboard', ['hasKonsorsium' => true] + $detail);
    }
}