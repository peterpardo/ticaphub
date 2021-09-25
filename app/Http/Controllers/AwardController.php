<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index() {
        $title = 'Project Assessment';
        $scripts = [
            asset('js/awards/addAward.js'),
        ];
        return view('awards.index', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }
}
