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
                <h6 class="m-0 font-weight-bold text-primary">Add Player</h6>
            </div>
            <div class="card-body">
                <form class="user" autocomplete="off" action="{{route("player.store")}}" method="POST" enctype="multipart/form-data" id="add_player">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <select class=" form-control " name="team_id">
                                            <option value="">Select</option>
                                            @foreach ($teams as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('team_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" autocomplete="off"  placeholder="First Name" name="first_name" value="{{old("first_name")}}">
                                        @error('first_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  placeholder="Last Name" name="last_name">
                                        @error('last_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="file" class="form-control form-control-user"  name="image">
                                        @error('image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  placeholder="Total 50's" name="total_fifties">
                                        @error('total_fifties')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  placeholder="Total 100's" name="total_hundreds">
                                        @error('total_hundreds')
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
                                        @error('jersey_number')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  placeholder="Country" name="country">
                                        @error('country')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="Matches"  name="matches">
                                        @error('matches')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="Runs"  name="runs">
                                        @error('runs')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="Highest Score"  name="highest_score">
                                        @error('highest_score')
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
    
    $("#add_player").validate({
        rules :{
            team_id : {
                required:true
            },
            first_name : {
                required:true
            },
            last_name : {
                required:true
            },
            country : {
                required : true
            },
            jersey_number : {
                required : true,
                number:true
            },
            image : {
                required : true
            },
            matches : {
                required : true,
                number:true

            },
        },
        messages:{
            team_id : {
                required : "Please select team",
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