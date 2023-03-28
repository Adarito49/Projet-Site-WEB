<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobApplication;
use App\Models\Offer;
use App\Models\Applied;

class ApplyController extends Controller
{
    public function showForm($offer_id)
    {
        $offer = Offer::findOrFail($offer_id);
        return view('apply', ['offer' => $offer]);
    }

    public function sendEmail(Request $request, $offer_id)
    {
        $offer = Offer::findOrFail($offer_id);
    
        $hasApplied = Applied::where('user_id', Auth::user()->id)
                             ->where('offer_id', $offer_id)
                             ->exists();
    
        if ($hasApplied) {
            return redirect()->back()->with('Error', 'Vous avez déjà candidaté à cette offre');
        }
    
        $data = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'message' => $request->input('message'),
            'cv' => $request->file('cv'),
        ];
    
        Mail::to($offer->email)->send(new JobApplication($offer, $data));
    
        $this->saveApplied($offer_id);
    
        return redirect()->back()->with('success', 'Votre candidature a été envoyée avec succès !');
    }

    private function saveApplied($offer_id)
    {
        $applied = new Applied;
        $applied->user_id = Auth::user()->id;
        $applied->offer_id = $offer_id;
        $applied->save();
    }
}
