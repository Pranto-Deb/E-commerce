@extends('frontend.layouts.master')

@section('content')
<div class="container margin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First_name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last_name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                        <div class="form-group row{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">Phone No</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="text" class="form-control" name="phone_no" value="{{ old('phone_no') }}" required>

                                @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('division_id') ? ' has-error' : '' }}">
                            <label for="division_id" class="col-md-4 col-form-label text-md-right">Division</label>
                            <div class="col-md-6">
                               <select class="form-control" name="division_id" id="division_id">
                                   <option>Please Select your division</option>
                                   @foreach($divisions as $division)
                                        <option value="{{$division->id}}">{{$division->name}}</option>
                                   @endforeach
                               </select> 
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('district_id') ? ' has-error' : '' }}">
                            <label for="district_id" class="col-md-4 col-form-label text-md-right">District</label>
                            <div class="col-md-6">
                               <select class="form-control" name="district_id" id="district-area">
                                
                               </select> 
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('street_address') ? ' has-error' : '' }}">
                            <label for="street_address" class="col-md-4 col-form-label text-md-right">Street Address</label>

                            <div class="col-md-6">
                                <input id="street_address" type="text" class="form-control" name="street_address" value="{{ old('street_address') }}" required>

                                @if ($errors->has('street_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script>
    $("#division_id").change(function(){
        var division = $("#division_id").val();
        //send an ajax request to server with this division
        $("#district-area").html("");
        var option = "";
        $.get( "http://localhost/LaraEcommerce/public/get-districts/"+division, function( data ) {
            data = JSON.parse(data);
            data.forEach(function(element){
                option += "<option value='"+ element.id +"'>"+ element.name +"</option>";
            });
            $("#district-area").html(option);
        });
    });
    
</script>
@endsection
