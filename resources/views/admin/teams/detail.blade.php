@extends('admin.layouts.master')
@push('css')


@endpush
@section("content")
<!-- Page Heading -->
 <h1 class="h3 mb-2 text-gray-800">Team <code>{{$team->name}}</code> :  {{$team->points->sum("points")}} Points</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 ">
        <div class="row">
            <div class="col-sm-6">
                <h6 class="m-0 font-weight-bold text-primary">{{$team->name}}</h6>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route("player.create",["team_id" => base64_encode($team->id)])}}" class="btn btn-primary btn-circle btn-sm" title="Add Player">
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
                        <th>Name</th>
                        <th>Club State</th>
                        <th>Logo</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<input type="hidden" id="team_id" value="{{$team->id}}"/>
@endsection

@push('js')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('js/datatables/team-players.js')}}"></script>

@endpush