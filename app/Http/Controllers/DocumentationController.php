<?php

namespace App\Http\Controllers;

use App\Models\Ticap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentationController extends Controller
{
    public function ticaps() {
        return view('documentation');
    }

    public function viewTicap($id) {
        $ticap = Ticap::find($id);

        // Return back if ticap doesn't exists
        if (!$ticap) {
            return back();
        }

        return view('documentation.view-ticap', ['ticap' => $ticap]);
    }

    public function downloadExhibitFiles(Request $request, $id) {
        $ticap = Ticap::find($id);

        $filePath = 'public/ticap/' . $ticap->folder . '/group-exhibits.zip';

        // Check if there are exhibit files saved in this ticap
        if (!Storage::disk('local')->exists($filePath)) {
            $request->session()->flash('status', 'red');
            $request->session()->flash('message', 'No exhibits were documented in this TICaP.');

            return back();
        }

        return Storage::download($filePath);
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
