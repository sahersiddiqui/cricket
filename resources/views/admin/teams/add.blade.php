@extends('admin.layouts.master')
@push('css')


@endpush
@section("content")
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Team</h1>
<div class="row">
    
    <div class="col-lg-6">
        
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Team</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <form class="user" autocomplete="off" action="{{route("team.store")}}" method="POST" enctype="multipart/form-data" id="add_team">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Name</label>
                                        <input type="text" class="form-control form-control-user" autocomplete="off"  placeholder="Name" name="name" value="{{old("name")}}">
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Club State</label>

                                        <input type="text" class="form-control form-control-user"  placeholder="Club State" name="club_state" value="{{old("club_state")}}">
                                        @error('club_state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Logo</label>

                                        <input type="file" class="form-control form-control-user"  name="logo">
                                        @error('logo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a  href="{{route("team.index")}}" class="btn btn-danger btn-user btn-block text-white">
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