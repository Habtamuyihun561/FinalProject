@extends('user.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Post</h5>
    <div class="card-body">
      <form method="post" action="{{route('post.update',$post->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Auction Code <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="code" placeholder="Enter Code"  value={{random_int(100, 999)}} class="form-control" readonly>
          @error('code')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Auction Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="post_cat_id">Category <span class="text-danger">*</span></label>
          <select name="category" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$data)
                  <option value='{{$data->id}}'>{{$data->title}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
       
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Start Date<span class="text-danger">*</span></label>
          <input id="inputTitle" type="date" name="startDate" class="form-control">
          <input type="hidden" name="u_id" value="{{ Auth::user()->id}}">
          @error('startDate')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        {{-- <div class="form-group">
          <label for="inputTitle" class="col-form-label">Open Time<span class="text-danger">*</span></label>
          <input id="inputTitle" type="time" name="openedTime" class="form-control">
          @error('openedTime')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">End Date<span class="text-danger">*</span></label>
          <input id="inputTitle" type="datetime-local" name="endDate" class="form-control">
          @error('endDate')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Starting Price<span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="min_price" class="form-control">
          @error('min_price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Type <span class="text-danger">*</span></label>
          <select name="type" class="form-control">
              <option value="free">Free</option>
              <option value="premium">premium</option>
          </select>
          @error('type')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Purpose<span class="text-danger">*</span></label>
          <select name="purpose" class="form-control">
              <option value="sale">Sale</option>
              <option value="buy">Buy</option>
          </select>
          @error('type')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
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
        height: 150
    });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Write short Quote.....",
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
</script>
@endpush