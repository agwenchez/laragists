<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listing
    public function index(){
        return view('listings.index', [
            "listings" => Listing::latest()
                ->filter(request(['tag','search']))
                ->paginate(6)
        ]);
    }

    // single listing
    public function show(Listing $listing){
        return view('listings.show', [
            "listing" => $listing
        ]);
    }

    // Show create form
    public function create(Listing $listing){
        return view('listings.create');
    }

    // Store Listing data
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'email' => ['required','email'],
            'company' => ['required', Rule::unique('listings', 'company')],
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        Listing::create($formFields);
        return redirect('/')->with('message','Listing created succesfully');
    }

    // Show Edit form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing'=> $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing){
        $formFields = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'email' => ['required','email'],
            'company' => ['required'],
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        $listing->update($formFields);
        return back()->with('message','Listing updated succesfully');
    }

    // Delete listing
    public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted succesfully');
    }
}
