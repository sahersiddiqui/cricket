@extends('admin.layouts.master')
@push('css')


@endpush
@section("content")
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Match</h1>
<div class="row">
    
    <div class="col-lg-12">
        
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Match</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <form class="user" autocomplete="off" action="{{route("match.update",base64_encode($match->id))}}" method="POST" id="add_match">
                                @method("PUT")
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>First Team</label>
                                        <select class="form-control" name="first_team">
                                            <option value="">Select Team</option>
                                            @foreach ($teams as $item)
                                                <option value="{{$item->id}}" {{old("first_team",$match->first_team_id) == $item->id ? "selected" : ""}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('first_team')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Second Team</label>
                                        <select class="form-control" name="second_team">
                                            <option value="">Select Team</option>
                                            @foreach ($teams as $item)
                                            <option value="{{$item->id}}" {{old("second_team",$match->second_team_id) == $item->id ? "selected" : ""}}>{{$item->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('second_team')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Match Date</label>
                                        <input type="date" name="match_date" class="form-control" value="{{date("d/m/Y",strtotime(old("match_date",$match->match_date)))}}" />
                                        @error('match_date')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Match Result</label>
                                        <select class="form-control" name="result">
                                            <option value="">Select</option>
                                            <option value="{{DRAW}}" {{old("result",$match->result) == "0" ? "selected" : ""}}>Draw</option>
                                            <option value="{{WINNER}}" {{old("result",$match->result) == "1" ? "selected" : ""}}>Winning</option>
                                        </select>
                                        @error('result')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @php
                                        $winner = $match->point ?($match->point->team_id == $match->first_team_id ? "first_team" : "second_team") : "";
                                    @endphp
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Winning Team</label>
                                        <select class="form-control" name="winner">
                                            <option value="">Select</option>
                                            <option value="first_team" {{old("first_team",$winner) == "first_team" ? "selected" : ""}}>First Team</option>
                                            <option value="second_team" {{old("second_team",$winner) == "second_team" ? "selected" : ""}}>Second Team</option>
                                        </select>
                                        @error('winner')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a  href="{{route("match.index")}}" class="btn btn-danger btn-user btn-block text-white">
                                            Back
                                        </a>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
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
        </div>
        
    </div>
    
    
</div>

@endsection

@push('js')

<script>

    $("#add_match").validate({
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