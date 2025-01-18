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
        
        Listing::create($formFields);
        return redirect('/')->with('message','Listing created succesfully');
    }
}
