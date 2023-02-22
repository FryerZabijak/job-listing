<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            (request(["tag", "search"]))->get()
        ]);
    }

    // Show single listing
    public function show(Listing $listing){
        return view("listings.show", [
            "listing" => $listing,
        ]);
    }
}
