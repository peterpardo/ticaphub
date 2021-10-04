<?php

namespace App\Http\Controllers;

use App\Models\Ticap;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index() {
        $title = 'Documentation';
        $ticaps = Ticap::all();
        return view('documentation.index', [
            'title' => $title,
            'ticaps' => $ticaps,
        ]);
    }

    public function ticapFiles($ticapId) {
        $title = 'Documentation';
        $ticap = Ticap::find($ticapId);
        return view('documentation.ticap-file', [
            'title' => $title,
            'ticap' => $ticap,
        ]);
    }
}
