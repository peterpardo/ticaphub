<?php

namespace App\Http\Controllers;

use App\Models\Ticap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardController extends Controller
{
    public function index() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        if(!$ticap->invitation_is_set) {
            return redirect()->route('set-invitation');
        }
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
