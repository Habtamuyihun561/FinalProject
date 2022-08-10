<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auction;
use App\Models\Document;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\User;
use Hash;
use Session;
use Auth;

class FreeAuctionController extends Controller
{
    public function index(){
        // $flights = Flight::where('active', 1)
        //        ->orderBy('name')
        //        ->take(10)
        //        ->get();
        $auctions=Auction::where('type','free')->get();
        // return $posts;
        return view('user.free-auction.index')->with('posts',$auctions);

        return view();
    }
    //
}
