@extends('layouts.layout')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/dist/css/select2.min.css')}}">
<style type="text/css" media="screen">
	.select2-hidden-accessible {
		margin-bottom: 1.5rem!important;
	}	
	.sub {
		margin-top: 15px;
	}
	.select2-offscreen[required],
	.select2-offscreen[required]:focus {
	    width: auto !important;
	    height: auto !important;
	}
</style>
@endsection
@section('content')
<div class="container mt-2">
	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Coin</li>
		</ol>
	</nav>

	<div class="row">
		
		<div class="col-md-6 offset-md-3">
			<form method="post" action="exchange" id="needs-validation" novalidate>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<h5>Create transaction</h5>
				<div class="form-group">
					<label class="col-form-label" for="address_wallet">Address Wallet</label>
					<input type="text" class="form-control" id="address_wallet" name="address_wallet" placeholder="" required>
				</div>
				<div class="form-group">
					<label class="col-form-label" for="phone">Phone</label>
					<input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
				</div>
				<select class="custom-select d-block my-3" name="type" required>
					<option value="">Select BUY OR SELL</option>
					<option value="BUY">BUY</option>
					<option value="SELL">SELL</option>
				</select>
				<select class="custom-select d-block my-3" name="coin" required>
					<option value="">Select Coin</option>
					<option value="UNIX">UNIX</option>
					<option value="ETH">ETH</option>
				</select>
				<select class="custom-select d-block my-3" name="bank" required>
					<option value="">Select Bank</option>
					<option value="Vietcombank">Vietcombank</option>
					<option value="Vietinbank">Vietinbank</option>
					<option value="ABBank">ABBank</option>
					<option value="ACB">ACB</option>
					<option value="AgriBank">AgriBank</option>
					<option value="BIDV">BIDV</option>
					<option value="BacABank">BacABank</option>
					<option value="BaoVietBank">BaoVietBank</option>
					<option value="DongABank">DongABank</option>
					<option value="Eximbank">Eximbank</option>
					<option value="GPBank">GPBank</option>
					<option value="HDBank">HDBank</option>
					<option value="KienLongBank">KienLongBank</option>
					<option value="LienVietPostBank">LienVietPostBank</option>
					<option value="MBBank">MBBank</option>
					<option value="Maritime Bank">Maritime Bank</option>
					<option value="NamABank">NamABank</option>
					<option value="NVB">NCB</option>
					<option value="OCB">OCB</option>
					<option value="OceanBank">OceanBank</option>
					<option value="PGBank">PGBank</option>
					<option value="PVcomBank">PVcomBank </option>
					<option value="Public Bank Viet Nam">Public Bank Viet Nam</option>
					<option value="SCB">SCB</option>
					<option value="SHB">SHB</option>
					<option value="Sacombank">Sacombank</option>
					<option value="Seabank">Seabank</option>
					<option value="TPBank">TPBank</option>
					<option value="Techcombank">Techcombank</option>
					<option value="VIB - Internet Banking">VIB - Internet Banking</option>
					<option value="VPBank">VPBank</option>
					<option value="VRB">VRB</option>
					<option value="VietABank">VietABank</option>
				</select>
				<div class="form-group">
					<label class="col-form-label" for="account_number">Account Number Bank</label>
					<input type="text" class="form-control" id="account_number" name="account_number" placeholder="" required>
				</div>
				<select class="itemName custom-select d-block my-3 mb-4" style="width: 100%;" name="invite" required></select>
				<div style="height: 15px;"></div>
				<select class="itemMediator custom-select d-block my-3 mb-4" style="width: 100%;" name="mediator" required></select>
				<br>
				<input class="btn btn-success sub" type="submit" value="Create" />
			</form>
		</div>
	</div>
</div>
@endsection


@section('js')
<script type="text/javascript" src="{{asset('public/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/select2search.js')}}"></script>
@endsection