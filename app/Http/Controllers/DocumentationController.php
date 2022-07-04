<?php

namespace App\Http\Controllers;

use App\Models\Ticap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentationController extends Controller
{
    public function index() {
        $ticaps = Ticap::orderBy('created_at', 'desc')->paginate(5);

        // Check if ticap is not set
        $showSidebar = true;
        if (is_null(auth()->user()->ticap_id)) {
            $showSidebar = false;
        }

        return view('documentation', [
            'ticaps' => $ticaps,
            'showSidebar' => $showSidebar
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

    public function deleteTicap(Request $request) {
        $validator = Validator::make($request->all(), [
            'ticap_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong. Try again.'
            ]);
        } else {
            Ticap::where('id', $request->ticap_id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'TICaP successfully deleted'
            ]);
        }
    }
}
