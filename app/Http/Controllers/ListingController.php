<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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

        if ($req->hasFile('logo')) {
            $formFields['logo'] = $req->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing Created Successfully!');
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }
    public function update(Request $req, Listing $listing)
    {
        $formFields = $req->validate([
            'title' => 'required|max:255',
            'email' => 'required|email',
            'location' => 'required',
            'tags' => 'required',
            'description' => 'required|max:255',
            'website' => 'string',
        ]);

        if ($req->hasFile('logo')) {
            $formFields['logo'] = $req->file('logo')->store('logos', 'public');
            $listing->logo = $formFields['logo'];
        }
        $listing->update($formFields);
        return back()->with('message', 'Listing Updated Successfully!');
    }
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted Successfully!');
    }
}