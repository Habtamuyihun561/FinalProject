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



class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions=Auction::getAllAuction();
        // return $posts;
        return view('user.auction.index')->with('posts',$auctions);
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
        return view('user.auction.create')->with('users',$users)->with('categories',$categories);
    }

    public function auctionfee()
    {
   
        return view('user.auction.document');
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function documentstore(Request $request){
    //         $status =  $this->validate($request,[
    //             'auction_code' => 'required',
    //             'product_name'=>'required',        
    //             'product_type'=>'required',
    //             'product_measure'=>'string|required',        
    //             'product_amount'=>'required',
    //             'product_price'=>'required',         
                
    //         ]);
    //         $data=$request->all();  
    //         $status=Document::create($data);
    //         if($status){
    //         request()->session()->flash('success','Auction Successfully added');
               
    //         }
    //         else{
    //             request()->session()->flash('error','Please try again!!');
    //         }
    //         return redirect()->route('post.index');
    // }


    //  auction_name	category	description	startDate	endDate	status	min_price	photo	openedTime	auctioneer_id
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'code'=>'required',
            'title'=>'required', 
            'category_id' =>'required',    
            'description'=>'required',
            'startDate'=>'required',
            // 'openedTime'=>'required', 
            'endDate' => 'required',
            'min_price'=>'nullable', 
            'photo'=>'string|nullable',        
            'type'=>'required',
            'purpose'=>'required',
            // 'status'=>'required|in:active,inactive'
        ]);

        // product_name	product_type	product_measure	product_amount	product_price	total_price
    
        $data=$request->all(); 
        $check=$this->createAuction($data);
        Session::put('auction_code',$data['code']);   
        // $status=Auction::create($data);

        if($check){
       
            
                request()->session()->flash('success','Auction Successfully added');
                return redirect()->route('post.index');
           
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        // return redirect()->route('post.index');
    }
    public function createAuction(array $data){
        return Auction::create([
            'code'=>$data['code'],
            'title'=>$data['title'],
            'category_id'=>$data['category_id'],
            'description'=>$data['description'],
            'startDate'=>$data['startDate'],
            // 'openedTime'=>$data['openedTime'],
            'endDate'=>$data['endDate'],
            'min_price'=>$data['min_price'],
            'photo'=>$data['photo'],
            'type'=>$data['type'],
            'purpose'=>$data['purpose'],
            // 'status'=>$data['status'],
            'user_id'=>auth()->id()


            ]);
            
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
        $post=Auction::findOrFail($id);
        $categories=PostCategory::get();
        // $tags=PostTag::get();
        $users=User::get();
        return view('user.auction.edit')->with('categories',$categories)->with('users',$users)->with('post',$post);
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
        $post=Auction::findOrFail($id);
         // return $request->all();
         $this->validate($request,[
            'code'=>'required',
            'title'=>'required', 
            'category' =>'required',    
            'description'=>'required',
            'startDate'=>'required',
            // 'openedTime'=>'required', 
            'endDate' => 'required',
            'min_price'=>'nullable', 
            'photo'=>'string|nullable',        
            'type'=>'required',
            'purpose'=>'required',
            // 'status'=>'required|in:active,inactive'
        ]);

        $data=$request->all();
        $data['user_id']=auth()->id();
        // $check=$this->updateAuction($data);
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
            request()->session()->flash('success','Auction Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('post.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Auction::findOrFail($id);
       
        $status=$post->delete();
        
        if($status){
            request()->session()->flash('success','Auction successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting Auction ');
        }
        return redirect()->route('post.index');
    }
    public function auctioLists()
    {
        $auctions=Auction::orderBy('created_at','ASC')->paginate(10);
        return view('user.auction.auction_list')->with('auctions',$auctions);
    }
}
