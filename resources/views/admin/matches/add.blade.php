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
                <h6 class="m-0 font-weight-bold text-primary">Add Match</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <form class="user" autocomplete="off" action="{{route("match.store")}}" method="POST" enctype="multipart/form-data" id="add_match">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>First Team</label>
                                        <select class="form-control" name="first_team">
                                            <option value="">Select Team</option>
                                            @foreach ($teams as $item)
                                                <option value="{{$item->id}}" {{old("first_team") == $item->id ? "selected" : ""}}>{{$item->name}}</option>
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
                                            <option value="{{$item->id}}" {{old("second_team") == $item->id ? "selected" : ""}}>{{$item->name}}</option>
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
                                        <input type="date" name="match_date" class="form-control" value="{{old("match_date")}}" />
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
                                            <option value="{{DRAW}}" {{old("result") == "0" ? "selected" : ""}}>Draw</option>
                                            <option value="{{WINNER}}" {{old("result") == "1" ? "selected" : ""}}>Winning</option>
                                        </select>
                                        @error('result')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Winning Team</label>
                                        <select class="form-control" name="winner">
                                            <option value="">Select</option>
                                            <option value="first_team">First Team</option>
                                            <option value="second_team">Second Team</option>
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
                                            Add
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
            first_team : {
                required:true
            },
            second_team : {
                required : true
            },
            match_date : {
                required : true
            },
            result : {
                required : true
            },
            winner : {
                required : function(){
                    return $("[name='result']").val() == 1 ? true:false;
                }
            },
        },
        messages:{
            first_team : {
                required : "First Team is required",
            },
            second_team :{
                required : "Second Team state is required"
            },
            match_date :{
                required : "Match Date  is required"
            },
            result :{
                required : "Result  is required"
            },
            winner :{
                required : "Winner  is required"
            },
        },
        errorPlacement: function (error, element) {
            element.siblings('span , .text-danger').remove()
            element.parent("div").append("<span class='text-danger'>"+error.text()+"</span>")
        },
    })
</script>
@endpush