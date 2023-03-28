<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Offer;

class CompanyController extends Controller
{
    /**
     * Store a newly created company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
		public function index()
		{
			$companies = Company::all();
			return view('edit_sheet.company.index', ['companies' => $companies]);
		}
 
	
        public function destroy($id)
        {
            $company = Company::find($id);
        
            Offer::where('company_id', $company->id)->delete();
        
            $company->delete();
        
            return redirect()->back()->with('success', 'L\'entreprise et ses offres associées ont été supprimées avec succès.');
        }

        public function update(Request $request)
        {
            $id = $request->input('company_id');
        
            $validatedData = $request->validate([
                'sector' => 'required',
                'street_number' => 'required',
                'street_name' => 'required',
                'postal_code' => 'required',
                'city' => 'required',
                'interns_number' => 'required|integer',
                'pilot_trust' => 'required',
            ]);
        
            $company = Company::find($id);
        

            $oldCompanyName = $company->company_name;
        
            $company->update($validatedData);
        
            return redirect()->back()->with('success', 'L\'entreprise a été mise à jour avec succès.');
        }
        

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
			'company_name' => ['required', 'max:255'],
			'sector' => ['required', 'max:255'],
			'street_number' => ['required', 'max:255'],
			'street_name' => ['required', 'max:255'],
			'postal_code' => ['required', 'max:255'],
			'city' => ['required', 'max:255'],
			'interns_number' => ['required', 'integer', 'min:1'],
			'pilot_trust' => ['required', 'integer', 'min:0', 'max:2'],
			'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ]);

        // Save the image to storage
        $imageName = $request->company_name . '.png';
        $request->image->storeAs('public/images', $imageName);

        // Create the new company object and save to database
        $company = new Company(); 
        $company->company_name = $validatedData['company_name'];
        $company->sector = $validatedData['sector'];
        $company->street_number = $validatedData['street_number']; 
        $company->street_name = $validatedData['street_name'];
        $company->postal_code = $validatedData['postal_code'];
        $company->city = $validatedData['city'];
        $company->building = $request->input('building');
        $company->floor = $request->input('floor');
        $company->interns_number = $validatedData['interns_number'];
        $company->pilot_trust = $validatedData['pilot_trust'];
        $company->save();

        return redirect()->back()->with('success', 'Entreprise ajoutée avec succès.');
    }

}
