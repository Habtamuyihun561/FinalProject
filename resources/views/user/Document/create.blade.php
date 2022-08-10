@extends('user.layouts.master')

@section('main-content')
<!--  auction_name	category	description	startDate	endDate	status	min_price	photo	openedTime -->
<div class="card">
    <h5 class="card-header">Add Products</h5>
    <div class="card-body">
      <form method="post" action="{{route('document.store')}}">
        {{csrf_field()}}
        {{-- <div class="form-group">
          <label for="inputTitle" class="col-form-label">Auction Code <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="code" placeholder="Enter Auction Code"  value="{{old('code')}}" class="form-control">
          @error('code')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}
        <div class="form-group">
          <label for="post_cat_id">Auction Code <span class="text-danger">*</span></label>
          <select name="auction_id" class="form-control">
              <option value="">--Select Current Auction--</option>
              @foreach($posts as $key=>$data)
                  <option value='{{$data->id}}'>{{$data->title}}</option>
              @endforeach
          </select>
        </div>
      <div class="form-group">
          <label for="inputTitle" class="col-form-label">product_name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="product_name" placeholder="Enter product_name"  value="{{old('product_name')}}" class="form-control">
          @error('product_name')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">product_Type <span class="text-danger">*</span></label>
          <select name="product_type" class="form-control">
              <option value="">--Select any type--</option>
              @foreach($categories as $key=>$data)
                  <option value='{{$data->id}}'>{{$data->title}}</option>
              @endforeach
          </select>
          @error('product_type')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        {{-- <div class="form-group">
          <label for="inputTitle" class="col-form-label">product_Type <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="product_type" placeholder="Enter product_type"  value="{{old('product_type')}}" class="form-control">
          @error('product_type')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">product_measure <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="product_measure" placeholder="Enter product_measure"  value="{{old('product_measure')}}" class="form-control">
          @error('product_measure')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">product_amount <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="product_amount" placeholder="Enter product_amount"  value="{{old('product_amount')}}" class="form-control">
          @error('product_amount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">product_price <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="product_price" placeholder="Enter product_price"  value="{{old('product_price')}}" class="form-control">
          @error('product_price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<style>
h4 {
   width: 100%; 
   text-align: center; 
   border-bottom: 1px solid #000; 
   line-height: 0.1em;
   margin: 10px 40px 20px; 
} 

h4 span { 
    background:#fff; 
    padding:0 10px; 
}

</style>
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Write detail Quote.....",
          tabsize: 2,
          height: 100
      });
    });
    // $('select').selectpicker();

</script>
@endpush