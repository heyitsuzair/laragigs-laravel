<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }


    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
    public function create()
    {
        return view('listings.create', [
            'listing' => new Listing()
        ]);
    }
    public function store(Request $req)
    {
        $formFields = $req->validate([
            'title' => 'required|max:255',
            'company' => 'required|unique:listings',
            'email' => 'required|email',
            'location' => 'required',
            'tags' => 'required',
            'description' => 'required|max:255',
            'website' => 'string',
        ]);

        Listing::create($formFields);

        return redirect('/');
    }
}