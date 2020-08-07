@extends('admin.layouts.master')
@push('css')


@endpush
@section("content")
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Player</h1>
<div class="row">
    
    <div class="col-lg-12">
        
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Player</h6>
            </div>
            <div class="card-body">
                <form class="user" autocomplete="off" action="{{route("player.update",base64_encode($player->id))}}" method="POST" enctype="multipart/form-data" id="update_player">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Select Team</label>

                                        <select class=" form-control " name="team_id">
                                            <option value="">Select</option>
                                            @foreach ($teams as $item)
                                            <option value="{{$item->id}}" {{$player->team_id ==  $item->id  ? "selected" : ""}}>{{$item->name}}</option>
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
                                        <label>First Name</label>

                                        <input type="text" class="form-control form-control-user" autocomplete="off"  placeholder="First Name" name="first_name" value="{{old("first_name",$player->firstname)}}">
                                        @error('first_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Last Name</label>

                                    <input type="text" class="form-control form-control-user"  placeholder="Last Name" name="last_name" value="{{old("last_name",$player->lastname)}}">
                                        @error('last_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Profile Image</label>

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
                                        <img height="200px" widht="200px" src="{{asset("storage/".$player->image_uri)}}"/>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Jersey Number</label>
                                        
                                        <input type="text" class="form-control form-control-user" autocomplete="off"  placeholder="Jersey Number" name="jersey_number" value="{{old("jersey_number",$player->jersey_number)}}">
                                        @error('jersey_number')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Country</label>

                                        <input type="text" class="form-control form-control-user"  placeholder="Country" name="country" value="{{old("country",$player->country)}}">
                                        @error('country')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Matches</label>

                                        <input type="text" class="form-control form-control-user" placeholder="Matches"  name="matches" value="{{old("matches",$player->matches)}}">
                                        @error('matches')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Runs</label>

                                        <input type="text" class="form-control form-control-user" placeholder="Runs"  name="runs" value="{{old("runs",$player->runs)}}">
                                        @error('runs')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Highest Score</label>

                                        <input type="text" class="form-control form-control-user" placeholder="Highest Score"  name="highest_score" value="{{old("highest_score",$player->highest_score)}}">
                                        @error('highest_score')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Total Fifties</label>

                                        <input type="text" class="form-control form-control-user"  placeholder="Total 50's" name="total_fifties" value="{{old("total_fifties",$player->total_fifties)}}">
                                        @error('total_fifties')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Total Hundreds</label>

                                        <input type="text" class="form-control form-control-user"  placeholder="Total 100's" name="total_hundreds" value="{{old("total_hundreds",$player->total_hundreds)}}">
                                        @error('total_hundreds')
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
                                Update
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
    
    $("#update_player").validate({
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
            matches : {
                required : true,
                number:true

            },
        },
        messages:{
            team_id : {
                required : "Please select team",
            },
            first_name :{
                required : "First name is required"
            },
            last_name :{
                required : "Last name is required"
            },
            country :{
                required : "Country is required"
            },
            jersey_number :{
                required : "Jersey number is required"
            },
            matches :{
                required : "Matches is required"
            },
        },
        errorPlacement: function (error, element) {
            element.siblings('span , .text-danger').remove()
            element.parent("div").append("<span class='text-danger'>"+error.text()+"</span>")
        },
    })
</script>
@endpush