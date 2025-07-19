<?php

// app/Http/Controllers/Admin/KontakAdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;

class KontakAdminController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::with('user')->latest()->get();
        return view('admin.kontak.index', compact('kontaks'));
    }
}
