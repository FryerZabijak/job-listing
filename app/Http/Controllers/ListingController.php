<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{

    /*
        index - show all
        show - show single
        create - show form to create
        store - store new listing
        edit - show form to edit listings
        update - update listings
        destroy - delete listing
    */
    // Show all listings
    public function index(){
        return view('listings.index', [
            "listings" => Listing::latest()->filter
            (request(["tag", "search"]))->paginate(6)
        ]);
    }

    // Show single listing
    public function show(Listing $listing){
        return view("listings.show", [
            "listing" => $listing,
        ]);
    }

    // Show Create Form
    public function create(){
        return view("listings.create");
    }

    // Store Listing Data
    public function store(Request $request){
        $formFields = $request->validate([
            "title" => "required",
            "company" => ["required", Rule::unique("listings","company")],
            "location" => "required",
            "website" => "required",
            "email" => ["required", "email"],
            "tags" => "required",
            "description" => "required"
        ]);

        if($request->hasFile("logo")){
            $formFields["logo"]=$request->file("logo")->store("logos", "public");
        }

        Listing::create($formFields);

        return redirect("/")->with("message","Listing Created successfully");
    }

    // Show Edit Form
    public function edit(Listing $listing){
        return view("listings.edit", ["listing"=>$listing]);
    }

    public function update(Request $request, Listing $listing){
        $formFields = $request->validate([
            "title" => "required",
            "company" => ["required"],
            "location" => "required",
            "website" => "required",
            "email" => ["required", "email"],
            "tags" => "required",
            "description" => "required"
        ]);

        if($request->hasFile("logo")){
            $formFields["logo"]=$request->file("logo")->store("logos", "public");
        }

        $listing->update($formFields);

        return back()->with("message","Listing Updated successfully");
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return redirect("/")->with("message","Listing deleted successfully");
    }
}
