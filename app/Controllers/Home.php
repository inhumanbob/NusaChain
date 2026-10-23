<?php

namespace App\Controllers;

use App\Models\KonsorsiumModel;

class Home extends BaseController
{
    public function index()
    {
        return view('landing');
    }

    // Katalog Publik: menampilkan konsorsium berstatus Penuh (siap ekspor) tanpa wajib login
    public function eksplor()
    {
        $konsorsiumModel = new KonsorsiumModel();
        $keyword         = trim((string) $this->request->getGet('hs_code'));

        $builder = $konsorsiumModel->where('status_kuota', 'Penuh');
        if ($keyword !== '') {
            $builder->like('target_hs_code', $keyword, 'after');
        }

        return view('eksplor', [
            'daftarKonsorsium' => $builder->findAll(),
            'keyword'          => $keyword,
        ]);
    }
}