<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Rating;

class RatingController extends Controller
{

    public function index()
    {
        $companies = Company::with('ratings')->paginate(6);
        return view('companies.ratings', compact('companies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        $rating = Rating::firstOrNew([
            'user_id' => auth()->user()->id,
            'company_id' => $validatedData['company_id'],
        ]);
    
        $rating->rating = $validatedData['rating'];
        $rating->save();
    
        return redirect()->back()->with('success', 'Votre note a été enregistrée avec succès.');
    }

    public function rate(Company $company)
{
    $userRating = $company->ratings->where('user_id', auth()->user()->id)->first();

    return view('companies.rate', compact('company', 'userRating'));
}
}
