@extends('frontend.layouts.master')

@section('title','AUS | Auction Detail page')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Auction Document Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <section class="blog-single shop-blog grid section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <form action="{{route('submiteddocument.store')}}" method="post">
                            {{csrf_field()}}
                            {{-- @csrf --}}
                        @if(count((array)$documents)>0)
                        <label for="">Auction Document</label>
                        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>code</th>
                              <th>product_name</th>
                              <th>Type </th>
                              <th>Measure</th>
                              <th>Amount</th>
                              <th>Price</th>
                              <th>Bidding Price</th>
                            
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                                <th>#</th>
                                <th>code</th>
                                <th>product_name</th>
                                <th>Type </th>
                                <th>Measure</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>Total Price <input type="text" name="total_price" readonly  id="total_amount"></th>
                             
                            </tr>
                          </tfoot>
                          <tbody>
                           
                          
                            @foreach($documents as $document)   
                              @php 
                              $author_info=DB::table('users')->select('name')->where('id',$document->user_id)->get();
                              // dd($sub_cat_info);
                              // dd($author_info);
                
                              @endphp
                                <tr>
                                
                                    <td>{{$document->id}}</td>
                                    <td>{{$document->code}}</td>
                                    <td>{{$document->product_name}}</td>
                                    <td>{{$document->product_type}}</td>
                                    <td>{{$document->product_measure}}</td>
                                    <td>{{$document->product_amont}}</td>
                                    <td>{{$document->product_price}}</td>
                                    <td><input type="number" name="bid_price" class="amount"/></td>

                                </tr>  
                                <input type="hidden" name="auction_id" value="{{$document->auction_id}}" >
                            @endforeach
                          </tbody>
                        </table>
                        {{-- <span style="float:right">{{$documents->links()}}</span> --}}
                        
                        

                        
                        <div class="form-group mb-3">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                             
                          </div>
                          @else
                          <h6 class="text-center">No documets found!!! Please create Post</h6>
                        @endif
                      
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
<style>
    .amount{
    background-color: rgb(238, 245, 245);
    }
</style>

@endpush
@push('scripts')
<script>
$(document).ready(function(){

    (function($) {
        "use strict";

        $('.btn-reply.reply').click(function(e){
            e.preventDefault();
            $('.btn-reply.reply').show();

            $('.comment_btn.comment').hide();
            $('.comment_btn.reply').show();

            $(this).hide();
            $('.btn-reply.cancel').hide();
            $(this).siblings('.btn-reply.cancel').show();

            var parent_id = $(this).data('id');
            var html = $('#commentForm');
            $( html).find('#parent_id').val(parent_id);
            $('#commentFormContainer').hide();
            $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');
          }); 
          //to calculate the sum of input price   bid_price
          
          
            $('.amount').keyup(function(){
          
          });

          //
          //
        //   $(function(){
   

//    });
   // 
//    $(document).ready(function(){
//   var test_qty = 0;
//   $(".amount").each(function(){
//     test_qty += parseInt($(this).val());
//     console.log(test_qty);
//   });
//   $('#total_amount').val(sum);
//     $('.amount').keyup(function(){
//         total_amount();
//     });
});

        $('.comment-list').on('click','.btn-reply.cancel',function(e){
            e.preventDefault();
            $(this).hide();
            $('.btn-reply.reply').show();

            $('.comment_btn.reply').hide();
            $('.comment_btn.comment').show();

            $('#commentFormContainer').show();
            var html = $('#commentForm');
            $( html).find('#parent_id').val('');

            $('#commentFormContainer').append(html);
        });
        
 });
//   })
 var total_amount= function(){
       
        var sum = 0
          $('.amount').each(function() { 
             if(!isNaN(parseFloat($(this).val())))
               
                sum+=parseFloat($(this).val());
            });
            $('#total_amount').val(sum);
        }
    $('.amount').keyup(function(){
       
        total_amount();
    });
    console.log('helll');

</script>

@endpush