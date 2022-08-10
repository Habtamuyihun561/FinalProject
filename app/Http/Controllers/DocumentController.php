<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auction;
use App\Models\Document;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\User;
use DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=PostCategory::get();
        $documents=Document::get();
        // return $posts;
        return view('user.document.index')->with('documents',$documents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id=auth()->id();
        $categories=PostCategory::get();
        $posts=Auction::where('user_id',$user_id)->get();

        $users=User::get();
        //return view('backend.post.create')->with('users',$users)->with('categories',$categories);
        return view('user.document.create')->with('posts',$posts)->with('categories',$categories);
    }

   

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   


    //  auction_name	category	description	startDate	endDate	status	min_price	photo	openedTime	auctioneer_id
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'auction_id' => 'required',
            'product_name'=>'required',        
            'product_type'=>'required',
            'product_measure'=>'string|required',        
            'product_amount'=>'required',
            'product_price'=>'required', 
             
        ]);
        $product=new Document();
        $product->auction_id=$request->get('auction_id');
        $product->product_name=$request->get('product_name');
        $product->product_type=$request->get('product_type');
        $product->product_measure=$request->get('product_measure');
        $product->product_amount=$request->get('product_amount');
        $product->product_price=$request->get('product_price');
        $product->user_id=auth()->id();
        // $pri_id=
        $status=$product->save();
        if($status){
                    request()->session()->flash('success','Document Successfully added');
                    return redirect()->route('document.index');
                   
                }
                else{
                    request()->session()->flash('error','Please try again!!');
                }
    }

        // product_name	product_type	product_measure	product_amount	product_price	total_price
    
        // $data=$request->all(); 
        // $check=$this->createDocument($data);
        // Session::put('document',$data['code']);   
        // $status=Document::create($data);

    //     if($check){
    //         request()->session()->flash('success','Document Successfully added');
    //         return redirect()->route('document.create');
           
    //     }
    //     else{
    //         request()->session()->flash('error','Please try again!!');
    //     }
       
    // }
    // public function createDocument(array $data){
    //     // $auction=Auction::where($auction->id(),auth()->id());
    //     return Document::create([
    //         'code'=>$data['code'],
    //         'product_name'=>$data['product_name'],
    //         'product_type'=>$data['product_type'],
    //         'product_measure'=>$data['product_measure'],
    //         'product_amount'=>$data['product_amount'],
    //         'product_price'=>$data['product_price'],
    //         'user_id'=>auth()->id(),
    //         // 'action_id'=> DB::table('auctions')->latest('id')->first()


    //         ]);
            
    // }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $auctions=Document::where('code',$code);
        // $document=Document::get();

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
        $post=Post::findOrFail($id);
        $categories=PostCategory::get();
        $tags=PostTag::get();
        $users=User::get();
        return view('backend.post.edit')->with('categories',$categories)->with('users',$users)->with('tags',$tags)->with('post',$post);
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
        $post=Post::findOrFail($id);
         // return $request->all();
         $this->validate($request,[
            'title'=>'string|required',
            'quote'=>'string|nullable',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|nullable',
            'tags'=>'nullable',
            'added_by'=>'nullable',
            'post_cat_id'=>'required',
            'status'=>'required|in:active,inactive'
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
            request()->session()->flash('success','Post Successfully updated');
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
        $post=Post::findOrFail($id);
       
        $status=$post->delete();
        
        if($status){
            request()->session()->flash('success','Post successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting post ');
        }
        return redirect()->route('post.index');
    }
    public function show_detail($code){
        
        $documents=Document::where('code',$code)->get();
        return view('frontend.auction_document')->with('documenets',$documents);


    }
      public function document_detail($code){
        // $code;
        // $documents=Document::where('code',$code);
        request()->session()->put('code',$code);
        $code = session('code');
        $documents=Document::where('auction_id', $code)->get();
        return view('frontend.pages.auction_document')->with('documents',$documents);

    }
}
