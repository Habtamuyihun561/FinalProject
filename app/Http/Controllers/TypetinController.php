<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinNumber;

class TypetinController extends Controller
{
    // public function autocompleteSearch(Request $request)
    // {
    //       $query = $request->get('query');
    //       $filterResult = TinNumber::where('tin_num', 'LIKE', '%'. $query. '%')->get();
    //       return response()->json($filterResult);
    // }
    public function index($tin_num){
        $isExist = SupplierList::select('tin_number')
        ->where('tin_number', $tin_number)
        ->exists();

if ($isExist) {
    return true;
}
else{
    return false;
}

    }
}
