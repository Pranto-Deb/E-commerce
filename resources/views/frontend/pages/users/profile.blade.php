@extends('frontend.pages.users.master')

@section('sub-content')
	<div class="container">
	<div class="card-body mb-5">
                    <form method="POST" action="{{ route('user.profile.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('user_name') ? ' has-error' : '' }}">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>

                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control" name="user_name" value="{{ $user->user_name }}" required autofocus>

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

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
                                <input id="phone_no" type="text" class="form-control" name="phone_no" value="{{ $user->phone_no }}" required>

                                @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('district_id') ? ' has-error' : '' }}">
                            <label for="district_id" class="col-md-4 col-form-label text-md-right">District</label>
                            <div class="col-md-6">
                               <select class="form-control" name="district_id">
                                   <option>Please Select your district</option>
                                   @foreach($districts as $district)
                                        <option value="{{$district->id}}"{{ $user->district_id == $district->id ? 'selected':''}}>{{$district->name}}</option>
                                   @endforeach
                               </select> 
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('division_id') ? ' has-error' : '' }}">
                            <label for="division_id" class="col-md-4 col-form-label text-md-right">Division</label>
                            <div class="col-md-6">
                               <select class="form-control" name="division_id">
                                   <option>Please Select your division</option>
                                   @foreach($divisions as $division)
                                        <option value="{{$division->id}}"{{ $user->division_id == $division->id ? 'selected':''}}>{{$division->name}}</option>
                                   @endforeach
                               </select> 
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('street_address') ? ' has-error' : '' }}">
                            <label for="street_address" class="col-md-4 col-form-label text-md-right">Street Address</label>

                            <div class="col-md-6">
                                <input id="street_address" type="text" class="form-control" name="street_address" value="{{ $user->street_address }}" required>

                                @if ($errors->has('street_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('shipping_address') ? ' has-error' : '' }}">
                            <label for="shipping_address" class="col-md-4 col-form-label text-md-right">Shipping Address(optional)</label>

                            <div class="col-md-6">
                                <textarea id="shipping_address" type="text" class="form-control" name="shipping_address" rows="4">{{ $user->shipping_address }}</textarea>

                                @if ($errors->has('shipping_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password(optional)</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>	
	</div>
@endsection