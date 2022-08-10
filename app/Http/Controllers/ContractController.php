<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auction;
// use App\Models\Contract;
use App\Contract;
use App\Models\Document;
use App\Models\PostCategory;
// use App\Models\PostTag;
use App\User;
use Hash;
use Session;
use Auth;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
        //     $contracts = Contract::all();
        
        // return view('user.contract.index',compact('$contracts'));
            $contracts=Contract::getAllContract();
            // return $posts;
            return view('user.contract.index')->with('contracts',$contracts);
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=PostCategory::get();

        $users=User::get();
        return view('user.feedback.create')->with('users',$users)->with('categories',$categories);
    
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
        $check=$this->createContract($data);
        Session::put('auction',$data['title']);   
        // $status=Auction::create($data);

        if($check){
       
            
                request()->session()->flash('success','Contract Successfully added');
                return redirect()->route('contract.index');
           
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        // return redirect()->route('post.index');
    }
    public function createContract(array $data){
        return Contract::create([
            'title'=>$data['title'],
            'description'=>$data['description'],
             'user_id'=>auth()->id()]);
        }
        
            // $request->validate([
        //     'title'=>'required',
        //     'description'=>'required',
        // ]);
        // $contract=new Contract();
        // $contract->title=$request->get('title');
        // $contract->description=$request->get('description');
        // $succss=$contract->save();
        // if($status){
        //     request()->session()->flash('success','Contract Successfully added');
        //     return redirect()->route('contract.index');
           
        // }
        // else{
        //     request()->session()->flash('error','Please try again!!');
        // }
        //
    

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
        $contract=Contract::findOrFail($id);
        $categories=PostCategory::get();
        // $tags=PostTag::get();
        $users=User::get();
        return view('user.contract.edit')->with('categories',$categories)->with('users',$users)->with('contract',$contract);
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
        $contract=Contract::findOrFail($id);
        // return $request->all();
        $this->validate($request,[
           'title'=>'string|required',
        //    'quote'=>'string|nullable',
        //    'summary'=>'string|required',
           'description'=>'string|nullable',
           'user_id'->auth()->id()
        //    'photo'=>'string|nullable',
        //    'tags'=>'nullable',post_cat_id'=>'required',
        //    'status'=>'required|in:active,inactive'
       ]);

       $data=$request->all();
       $tags=$request->input('tags');
       // return $tags;
       if($tags){
           $data['tags']=implode(',',$tags);
       }
       else{
           $data['tags']='';
       }
       // return $data;

       $status=$post->fill($data)->save();
       if($status){
           request()->session()->flash('success','Contract Successfully updated');
       }
       else{
           request()->session()->flash('error','Please try again!!');
       }
       return redirect()->route('contract.index');
        //
        //    'added_by'=>'nullable',
        //    '
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract=Contract::findOrFail($id);
       
        $status=$contract->delete();
        
        if($status){
            request()->session()->flash('success','Contract successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting Auction ');
        }
        return redirect()->route('contract.index');
    }
}
        //


