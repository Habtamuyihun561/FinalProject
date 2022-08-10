<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Auction;
// use App\Models\Contract;
use App\Contract;
use App\Feedback;
use App\Models\Document;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\User;
use Hash;
use Session;
use Auth;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks=Feedback::getAllFeedback();
            // return $posts;
            return view('user.feedback.index')->with('feedbacks',$feedbacks);
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
        $check=$this->createFeedback($data);
        Session::put('feedback',$data['title']);   
        // $status=Auction::create($data);

        if($check){
       
            
                request()->session()->flash('success','Feedback Successfully sent');
                return redirect()->route('feedback.index');
           
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        // return redirect()->route('post.index');
    }
    public function createFeedback(array $data){
        return Feedback::create([
            'title'=>$data['title'],
            'description'=>$data['description'],
             'user_id'=>auth()->id()]);
        }

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
        $feedback=Feedback::findOrFail($id);
        $categories=PostCategory::get();
        // $tags=PostTag::get();
        $users=User::get();
        return view('user.contract.edit')->with('categories',$categories)->with('users',$users)->with('contract',$feedback);
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
        $feedback=Feedback::findOrFail($id);
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
        $feedback=Feedback::findOrFail($id);
       
        $status=$feedback->delete();
        
        if($status){
            request()->session()->flash('success','Contract successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting Auction ');
        }
        return redirect()->route('contract.index');
    }
    public function feedbackLists()
    {
        $feedback=Feedback::orderBy('created_at','ASC')->paginate(10);
        return view('user.feedback.feedback_list')->with('feedback',$feedback);
    }

        //
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}

