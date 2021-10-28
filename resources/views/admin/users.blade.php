@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Posts</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Posts</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Posts List</h6>

        <div class="col-12 p-0">
          @if(session()->has('message'))
            <div class="alert alert-success">
              {{session('message')}}
            </div>
          @endif
        </div>

        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="mb-5">
                @if($users)
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                          <button onclick="showSwal('passing-parameter-execute-cancel', {{$user->id}})" type="button" class="btn btn-danger btn-icon">
                            <i data-feather="trash-2"></i>
                          </button>
                          <form id="delete-user-{{$user->id}}" action="{{route('user.destroy', $user->id)}}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                          </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No User Found</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script>
    $(function() {
      showSwal = function(type, id) {
      'use strict';
        if (type === 'passing-parameter-execute-cancel') {
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'ml-2',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
              swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              ).then(function() {
                  var elementID = "delete-user-" + id;
                  document.getElementById(elementID).submit();
              });
            } else if (
              // Read more about handling dismissals
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
            }
          })
        }
      }
    });
  </script>
@endpush