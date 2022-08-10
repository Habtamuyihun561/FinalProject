@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Feedback List</h6>
      <a href="" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add User</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="user-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>id</th>
              <th>Title</th>
              {{-- <th>Category</th> --}}
              <th>Description</th>
              {{-- <th>EndDate</th> --}}
              {{-- <th>Role</th> --}}
              {{-- <th>Type</th>
              <th>Status</th>
              <th>Purpose</th> --}}
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>id</th>
                <th>Title</th>
                {{-- <th>Category</th> --}}
                <th>Description</th>
                {{-- <th>EndDate</th> --}}
                {{-- <th>Role</th> --}}
                {{-- <th>Type</th>
                <th>Status</th>
                <th>Purpose</th> --}}
                <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($feedback as $feedback)   
                <tr>
                    <td>{{$feedback->id}}</td>
                    <td>{{$feedback->title}}</td>
                    <td>{{Str::limit($feedback->description, 300)}}</td>
                    {{-- <td>{{$auction->endDate}}</td> --}}
                    {{-- <td>
                        @if($user->photo)
                            <img src="{{$user->photo}}" class="img-fluid rounded-circle" style="max-width:50px" alt="{{$user->photo}}">
                        @else
                            <img src="{{asset('backend/img/avatar.png')}}" class="img-fluid rounded-circle" style="max-width:50px" alt="avatar.png">
                        @endif
                    </td> --}}
                    {{-- <td>{{(($user->created_at)? $user->created_at->diffForHumans() : '')}}</td>
                    <td>{{$user->role}}</td> --}}
                    {{-- <td>
                        @if($auction->status=='active')
                            <span class="badge badge-success">{{$auction->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$auction->status}}</span>
                        @endif
                    </td>
                    <td>{{$auction->type}}</td>
                    <td>{{$auction->purpose}}</td> --}}
                    <td>
                        {{-- <a href="" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a> --}}
                    <form method="POST" action="{{route('feedback.destroy',[$feedback->id])}}">
                      @csrf 
                      @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id={{$feedback->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    {{-- Delete Modal --}}
                    {{-- <div class="modal fade" id="delModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$user->id}}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="#delModal{{$user->id}}Label">Delete user</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="{{ route('users.destroy',$user->id) }}">
                                @csrf 
                                @method('delete')
                                <button type="submit" class="btn btn-danger" style="margin:auto; text-align:center">Parmanent delete user</button>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div> --}}
                </tr>  
            @endforeach
          </tbody>
        </table>
        {{-- <span style="float:right">{{$feedback->links()}}</span> --}}
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#user-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[6,7]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush