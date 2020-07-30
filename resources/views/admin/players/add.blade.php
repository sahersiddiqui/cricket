@extends('admin.layouts.master')
@push('css')


@endpush
@section("content")
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Team</h1>
<div class="row">
    
    <div class="col-lg-12">
        
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Team</h6>
            </div>
            <div class="card-body">
                <form class="user" autocomplete="off" action="{{route("team.store")}}" method="POST" enctype="multipart/form-data" id="add_team">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <select class=" form-control " name="team_id">
                                            <option>Select</option>
                                            @foreach ($teams as $item)
                                                <option>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" autocomplete="off"  placeholder="First Name" name="first_name">
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  placeholder="Last Name" name="last_name">
                                        @error('club_state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="file" class="form-control form-control-user"  name="image">
                                        @error('logo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  placeholder="Total 50's" name="last_name">
                                        @error('club_state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  placeholder="Total 100's" name="last_name">
                                        @error('club_state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" autocomplete="off"  placeholder="Jersey Number" name="jersey_number">
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  placeholder="Country" name="country">
                                        @error('club_state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="Matches"  name="matches">
                                        @error('logo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="Runs"  name="matches">
                                        @error('logo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="Highest Score"  name="matches">
                                        @error('logo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0"></div>
                        <div class="col-sm-2 mb-3 mb-sm-0">
                            <a  href="{{route("team.index")}}" class="btn btn-danger btn-user btn-block text-white">
                                Back
                            </a>
                        </div>
                        <div class="col-sm-2 mb-3 mb-sm-0">
                            <button  class="btn btn-primary btn-user btn-block">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        
    </div>
    
    
</div>

@endsection

@push('js')

<script>
    
    $("#add_team").validate({
        rules :{
            name : {
                required:true
            },
            club_state : {
                required : true
            },
            logo : {
                required : true
            },
        },
        messages:{
            name : {
                required : "Name is required",
            },
            club_state :{
                required : "Club state is required"
            },
            logo :{
                required : "Logo  is required"
            },
        },
        errorPlacement: function (error, element) {
            element.siblings('span , .text-danger').remove()
            element.parent("div").append("<span class='text-danger'>"+error.text()+"</span>")
        },
    })
</script>
@endpush