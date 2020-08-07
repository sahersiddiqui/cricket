@extends('admin.layouts.master')
@push('css')

<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">


@endpush
@section("content")
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Matches</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 ">
        <div class="row">
            <div class="col-sm-6">
                <h6 class="m-0 font-weight-bold text-primary">Listing</h6>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route("match.create")}}" class="btn btn-primary btn-circle btn-sm" title="Add Match">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>First Team</th>
                        <th>Second Team</th>
                        <th>Match Date</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/datatables/matches.js')}}"></script>
@endpush