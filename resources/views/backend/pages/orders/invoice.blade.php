<!DOCTYPE html>
<html>
<head>
	<title>Invoice.{{ $order->id }}</title>
	<link rel="stylesheet" href="{{asset('css/admin/demo/style.css')}}">
	<link rel="stylesheet" href="{{asset('css/admin/shared/style.css')}}">
	<style>
		.content-wrapper{
			background: #fff;
		}

		.invoice-header {
	    background: #b8d2d240;
	    padding: 10px 20px 10px 20px;
	    border-bottom: 1px solid gray;
		}

		.invoice-right-top h3 {
	    padding-right: 20px;
	    margin-top: 20px;
	    color: #f56906;
	    font-size: 45px!Important;
	    font-family: auto;
		}

		.invoice-left-top {
	    border-left: 3px solid #ea8238;
	    padding-left: 20px;
	    padding-top: 20px;
		}

		thead {
    	background: #f7af12;
    	color: #fff;
		}

		.thanks h4 {
	    color: #f5c865;
	    font-size: 25px;
	    font-weight: normal;
	    font-family: serif;
	    margin-top: 20px;
		}

		.authority h5 {
	    margin-top: -10px;
	    color: black;
		}

		.site-address p {
	    line-height: 5px;
	    font-weight: 400;
		}
	</style>
</head>
<body>
	<div class="content-wrapper">
	<div class="invoice-header">
		<div class="float-left site-logo">
		<img src="{{ asset('images/favicon.png') }}" alt="">
		</div>
		<div class="float-right site-address">
		<h4>Lara Ecommerce</h4>
		<p>17/KA, Shamoly, Dhaka-1207</p>
		<p>Phone No:<a href="">880-32412365</a></p>
		<p>Email:<a href="mailto:user@gmail.com">user@gmail.com</a></p>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="invoice-description">
		<div class="invoice-left-top float-left">
			<h6>Invoice to</h6>
			<h3>{{ $order->name }}</h3>
			<div class="address">
				<p>
					<strong>Address:</strong>
					{{ $order->shipping_address }}
				</p>
				<p>Phone:{{ $order->phone_no }}</p>
				<p>Email:<a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
			</div>
		</div>
		<div class="invoice-right-top float-right">
			<h3>Invoice #{{ $order->id }}</h3>
			<p>
				{{ $order->created_at }}
			</p>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="">
		<h3>Products</h3>
		@if($order->carts->count() > 0)
		<table class="table table-bordered table-stripe">
			<thead>
				<tr>
					<th>No.</th>
					<th>Product Title</th>
					<th>Product Quantity</th>
					<th>Unit Price</th>
					<th>Sub Total Price</th>
				</tr>
			</thead>
			<tbody>
				@php
					$total_price = 0;
				@endphp
				@foreach($order->carts as $cart)
				<tr>
					<td>
					{{ $loop->index + 1 }}
					</td>
					<td>
					<a href="{{ route('products.show', $cart->product->slug)}}">{{ $cart->product->title }}</a>
					</td>
					<td>
					{{$cart->product_quantity}}
					</td>
					<td>
						{{ $cart->product->price }} Taka
					</td>
					<td>
						@php
							$total_price += $cart->product->price * $cart->product_quantity;
						@endphp
						{{ $cart->product->price * $cart->product_quantity }} Taka
					</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="3"></td>
					<td>Discount:</td>
					<td colspan="2"> 
						<strong>{{ $order->custom_discount }} Taka </strong>
					</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td>Shipping Cost:</td>
					<td colspan="2"> 
						<strong>{{ $order->shipping_charge }} Taka </strong>
					</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td>Total Amount:</td>
					<td colspan="2"> 
						<strong>{{ $total_price + $order->shipping_charge - $order->custom_discount }} Taka </strong>
					</td>
				</tr>
			</tbody>
		</table>
		@endif
		<div class="thanks mt-3">
			<h4>Thank you for your business!!</h4>
		</div>
		<div class="authority float-right mt-5">
			<p>.....................................</p>
			<h5>Authority Signature</h5>
		</div>
		<div class="clearfix"></div>
	</div>
	</div>
</body>
</html>