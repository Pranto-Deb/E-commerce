@extends('frontend.layouts.master')

@section('content')
	<div class="container margin-top-20">
		<div class="card card-body">
			<h2>Confirm Items</h2>
			<hr>
			<div class="row">
			<div class="col-md-7 border-right">
						@foreach(App\Models\Cart::totalCarts() as $cart)
							<p>
								{{ $cart->product->title }} -
								<strong> {{ $cart->product->price }} Taka </strong>
								-{{ $cart->product_quantity }} item
							</p>
						@endforeach
				</div>
				<div class="col-md-5">
				@php
					$total_price = 0;
				@endphp
				@foreach(App\Models\Cart::totalCarts() as $cart)
					@php
						$total_price += $cart->product->price * $cart->product_quantity;
					@endphp		
				@endforeach	
				<p>Total Price: <strong> {{ $total_price }} </strong> Taka </p>	
				<p>Total Price with shipping cost: <strong> {{ $total_price + App\Models\Setting::first()->shipping_cost }} </strong> Taka 
				</p>	
				</div>
			</div>
			<p>
			<a href="{{ route('carts') }}">Change Cart Item</a>
			</p>
			</div>
			<div class="card card-body mt-2 mb-4">
			<h2>Shipping Address</h2>
			<form method="POST" action="{{ route('checkouts.store') }}">
  		{{ csrf_field() }}

  		<div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="name" class="col-md-4 col-form-label text-md-right">Receiver Name</label>

    	<div class="col-md-6">
          <input id="name" type="text" class="form-control" name="name" value="{{ Auth::check() ? Auth::user()->first_name.' '.Auth::user()->last_name : old('name')}}" required autofocus>

          @if ($errors->has('name'))
              <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
      </div>
  		</div>

  	<div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
      <div class="col-md-6">
          <input id="email" type="email" class="form-control" name="email" value="{{ Auth::check() ? Auth::user()->email : old('email')}}" required>

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
          <input id="phone_no" type="text" class="form-control" name="phone_no" value="{{ Auth::check() ? Auth::user()->phone_no : old('phone_no')}}" required>

          @if ($errors->has('phone_no'))
              <span class="help-block">
                  <strong>{{ $errors->first('phone_no') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group row{{ $errors->has('message') ? ' has-error' : '' }}">
      <label for="message" class="col-md-4 col-form-label text-md-right">Additional Message(Optional)</label>
      <div class="col-md-6">
          <textarea id="message" type="text" class="form-control" name="message" rows="4"></textarea>

          @if ($errors->has('message'))
              <span class="help-block">
                  <strong>{{ $errors->first('message') }}</strong>
              </span>
          @endif
      </div>
  </div> 
  <div class="form-group row{{ $errors->has('shipping_address') ? ' has-error' : '' }}">
      <label for="shipping_address" class="col-md-4 col-form-label text-md-right">Shipping Address(*)</label>
      <div class="col-md-6">
          <textarea id="shipping_address" type="text" class="form-control" name="shipping_address" required rows="4">{{ Auth::check() ? Auth::user()->shipping_address : old('shipping_address') }}</textarea>

          @if ($errors->has('shipping_address'))
              <span class="help-block">
                  <strong>{{ $errors->first('shipping_address') }}</strong>
              </span>
          @endif
      </div>
  </div>
   <div class="form-group row{{ $errors->has('payment_method') ? ' has-error' : '' }}">
      <label for="payment_method" class="col-md-4 col-form-label text-md-right">Select a payment method</label>
      <div class="col-md-6">
          <select class="form-control" name="payment_method_id" id="payments" required>
          	<option value="">Please select a payment method</option>
          	@foreach($payments as $payment)
          			<option value="{{$payment->short_name}}">{{$payment->name}}</option>
          	@endforeach
          </select>
          @foreach($payments as $payment)
          		@if($payment->short_name == "cash_in")
          				<div class="alert alert-success text-center hidden mt-2" id="payment_{{ $payment->short_name }}">
          					<h3>
          						For cash in there is nothing necessary. Just finish the order.
          						<br>
          						<small>
          							You will get your product in two or three days.
          						</small>
          					</h3>
          				</div>
          		@else
          		<div class="alert alert-success text-center hidden mt-2" id="payment_{{ $payment->short_name }}">
          					<h3>{{ $payment->name }} Payment</h3>
          					<p>
          						<strong>{{ $payment->name }} No: {{ $payment->no }}</strong>
          						<br>
          						<strong>Account type: {{ $payment->type }}</strong>
          					</p>
          					<div class="alert alert-success">
          						Please send the avobe money to this Bkash No and write your transaction code below there.
          					</div>
          			</div>
          		@endif
          @endforeach
          <input type="text" name="transaction_id" id="transaction_id" class="form-control hidden" placeholder="Enter transaction code">
      </div>
      </div>
      <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">
          <button type="submit" class="btn btn-primary">
            Order Now
          </button>
      </div>
  	</div>
  	</form>			
  </div>	        
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		$("#payments").change(function(){
				$payment_method = $("#payments").val();
				if ($payment_method == 'cash_in') {
					$("#payment_cash_in").removeClass('hidden');
					$("#payment_bkash").addClass('hidden');
					$("#payment_rocket").addClass('hidden');
				}
				else if($payment_method == 'bkash'){
					$("#payment_bkash").removeClass('hidden');
					$("#payment_cash_in").addClass('hidden');
					$("#payment_rocket").addClass('hidden');
					$("#transaction_id").removeClass('hidden');
				}
				else if($payment_method == 'rocket'){
					$("#payment_rocket").removeClass('hidden');
					$("#payment_cash_in").addClass('hidden');
					$("#payment_bkash").addClass('hidden');
					$("#transaction_id").removeClass('hidden');
				}
		})
	</script>
@endsection