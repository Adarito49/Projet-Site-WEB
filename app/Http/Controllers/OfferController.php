<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Company;
use Jenssegers\Agent\Agent;

class OfferController extends Controller
{

	public function show($id)
	{
		$offer = Offer::with('company')->find($id);

		if ($offer) {
			return response()->json($offer);
		}

		return response()->json(['error' => 'Offre non trouvée'], 404);
	}
	
	public function showOffer($id)
	{
		$offer = Offer::with('company')->find($id);

		if ($offer) {
			return view('offer-details', compact('offer'));
		}

		abort(404, 'Offre non trouvée');
	}

    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'skills' => 'required|string|max:255',
        'type' => 'required|string|in:Stage,Alternance',
        'company_name' => 'required|string|max:255',
        'duration' => 'required|string|max:255',
        'salary' => 'required|string|max:255',
        'date' => 'required|string|max:255',
        'number' => 'required|integer|min:1',
        'email' => 'required|email',
        'postal_code' => 'required|string|max:5',
        'city' => 'required|string|max:255',
        'offer_description' => 'required|string|max:10000',
    ]);


    $company = Company::where('company_name', $validatedData['company_name'])->firstOrFail();

    $offer = new Offer;
    $offer->title = $validatedData['title'];
    $offer->skills = $validatedData['skills'];
    $offer->type = $validatedData['type'];
    $offer->company_id = $company->id;
    $offer->duration = $validatedData['duration'];
    $offer->salary = $validatedData['salary'];
    $offer->date = $validatedData['date'];
    $offer->city = $validatedData['city'];
    $offer->postal_code = $validatedData['postal_code'];
    $offer->number = $validatedData['number'];
    $offer->email = $validatedData['email'];
    $offer->offer_description = $validatedData['offer_description'];
    $offer->save();

    return redirect()->back()->with('success', 'L\'offre a été créée avec succès.');
    }

    public function index()
    {
        $offers = Offer::all();
        return view('edit_sheet.offer.index', compact('offers'));
    }
    
    public function update(Request $request)
    {
        $id = $request->input('offer_id');
        $validatedData = $request->validate([
            'title' => 'required',
            'skills' => 'required',
            'duration' => 'required',
            'salary' => 'required',
            'date' => 'required',
            'number' => 'required',
            'email' => 'required|email',
            'offer_description' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
        ]);
    
        $offer = Offer::findOrFail($id);
        $offer->update($validatedData);
    
        return redirect()->route('offer.index')->with('success', 'Offre mise à jour avec succès !');
    }
    
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
    
        return redirect()->route('offer.index')->with('success', 'Offre supprimée avec succès !');
    }
}
