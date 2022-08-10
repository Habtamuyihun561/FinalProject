<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
// use App\Models\Contract;
use App\Models\Document;
use App\SubmitedDocuement;
use App\User;
use Hash;
use Session;
use Auth;
class SubmittedDocument extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all(); 
        $check=$this->createFeedback($data);
        if($check){
                    request()->session()->flash('success','Document Successfully added');
                    return redirect()->route('home');
                   
                }
                else{
                    request()->session()->flash('error','Please try again!!');
                }
    }
    public function createFeedback(array $data){
        return SubmitedDocuement::create([
            'total_price'=>$data['total_price'],
             'user_id'=>auth()->id(),
             'auction_id'=>$data['auction_id']]);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function submittedDocument($id){

    }
}
