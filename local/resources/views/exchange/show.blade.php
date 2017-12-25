@extends('layouts.layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/message.css')}}">
<meta name="exchange" content="{{ $exchange->id }}" />
<meta http-equiv="refresh" content="30">
@endsection

@section('content')
<div class="container mt-2">
	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Exchange</li>
			<li class="breadcrumb-item active" aria-current="page">{{ $exchange->codeexchange }}</li>
		</ol>
	</nav>

	@if (isset($step) && $step == 1 && Auth::user()->id == $exchange->intermediate_id)
	<div class="alert alert-success" role="alert">
		
		<form action="confirm" method="post" accept-charset="utf-8">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="action" value="mediator">
			<input type="hidden" name="codeexchange" value="{{ $exchange->codeexchange }}">
			<h6>Xác nhận gửi coin từ bên bán cho trung gian</h6>
			<button type="submit" class="btn btn-sm btn-success">Xác nhận</button>
		</form>
	</div>
	@endif

	@if (isset($step) && $step == 2 && Auth::user()->id == $exchange->userid_b)
	<div class="alert alert-success" role="alert">
		
		<form action="confirm" method="post" accept-charset="utf-8">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="action" value="b">
			<input type="hidden" name="codeexchange" value="{{ $exchange->codeexchange }}">
			<h6>Xác nhận nhận tiền từ bên trung gian cho bên bán</h6>
			<button type="submit" class="btn btn-sm btn-success">Xác nhận</button>
		</form>
	</div>
	@endif

	@if (isset($step) && $step == 3 && Auth::user()->id == $exchange->intermediate_id)
	<div class="alert alert-success" role="alert">
		
		<form action="confirm" method="post" accept-charset="utf-8">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="action" value="mediator">
			<input type="hidden" name="codeexchange" value="{{ $exchange->codeexchange }}">
			<h6>Xác nhận gửi tiền bên mua cho trung gian</h6>
			<button type="submit" class="btn btn-sm btn-success">Xác nhận</button>
		</form>
	</div>
	@endif
	
	@if (isset($step) && $step == 4 && Auth::user()->id == $exchange->userid_a)
	<div class="alert alert-success" role="alert">
		
		<form action="confirm" method="post" accept-charset="utf-8">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="action" value="a">
			<input type="hidden" name="codeexchange" value="{{ $exchange->codeexchange }}">
			<h6>Xác nhận nhận coin từ trung gian cho bên mua</h6>
			<button type="submit" class="btn btn-sm btn-success">Xác nhận</button>
		</form>
	</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			<div class="d-flex">
				<div class="p-2">
					<button type="button" class="btn {{ (isset($step) && $step >= 1) ? 'btn-success':'btn-warning'}} btn-sm" >
						Bước 1
					</button>
				</div>
				<div class="p-2">
					<button type="button" class="btn {{ isset($step) && $step >= 2 ? 'btn-success':'btn-warning'}} btn-sm" >
						Bước 2
					</button>
				</div>
				<div class="p-2">
					<button type="button" class="btn {{ isset($step) && $step >= 3 ? 'btn-success':'btn-warning'}} btn-sm" >
						Bước 3 
					</button>
				</div>
				<div class="p-2">
					<button type="button" class="btn {{ isset($step) && $step >= 4 ? 'btn-success':'btn-warning'}} btn-sm" >
						Bước 4
					</button>
				</div>
				<div class="p-2">
					<button type="button" class="btn {{ isset($step) && $step >= 5 ? 'btn-success':'btn-warning'}} btn-sm" >
						Bước 5
					</button>
				</div>
				@if ($step >= 5)
				<div class="p-2">
					<a href="{{ url('home') }}" class="btn btn-danger btn-sm" >
						Kết thúc
					</a>
				</div>
				@endif
			</div>
		</div>
	</div>
	
	<div class="row">

		<div class="col-md-3">
			
			<div class="card">
				<div class="card-header" sty>
					<h6 class="text-center">Trình tự</h6>
				</div>
				<div class="card-block">
					<p class="card-text"><strong>Bước 1: </strong>Khởi tạo</p>
					<p class="card-text"><strong>Bước 2: </strong>Xác nhận gửi coin từ bên bán cho trung gian</p>
					<p class="card-text"><strong>Bước 3: </strong>Xác nhận nhận tiền từ bên trung gian cho bên bán</p>
					<p class="card-text"><strong>Bước 4: </strong>Xác nhận gửi tiền bên mua cho trung gian</p>
					<p class="card-text"><strong>Bước 5: </strong>Xác nhận nhận coin từ trung gian cho bên mua</p>
					<p class="card-text"><strong>Bước 6: </strong>Kết thúc</p>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header bg-info">
					<h5 class="text-center"> Mediator ({{ $mediator->name }})</h5>
				</div>
				<div class="card-block row">
					<p class="card-text col-md-6"><strong>Address Wallet:</strong> {{ $exchange->address_wallet_mediator ? $exchange->address_wallet_mediator:"Please UPDATE!" }}</p>
					<p class="card-text col-md-6"><strong>Phone:</strong> {{ $exchange->phone_mediator ? $exchange->phone_mediator:"Please UPDATE!" }}</p>
					<p class="card-text col-md-4"><strong>Bank:</strong> {{ $exchange->bank_mediator ? $exchange->bank_mediator:"Please UPDATE!" }}</p>
					<p class="card-text col-md-8"><strong>Account number bank:</strong> {{ $exchange->account_number_mediator ? $exchange->account_number_mediator:"Please UPDATE!" }}</p>
				</div>
			</div>

			@if (( !$exchange->address_wallet_mediator|| !$exchange->phone_mediator || !$exchange->bank_mediator || !$exchange->account_number_mediator ) && Auth::user()->id == $exchange->intermediate_id)
			<div class="card">
				<div class="card-header">
					<h6 class="text-center">Update Mediator ({{ $mediator->name }})</h6>
				</div>
				<div class="card-block">
					<form class="row" method="post" action="" id="needs-validation" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="action" value="mediator">
						<div class="form-group col-md-6">
							<label class="col-form-label-sm " for="address_wallet">Address Wallet</label>
							<input type="text" class="form-control form-control-sm" id="address_wallet" name="address_wallet" placeholder="" required>
						</div>
						<div class="form-group col-md-6">
							<label class="col-form-label-sm" for="phone">Phone</label>
							<input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="" required>
						</div>

						<div class="form-group col-md-7">
							<label class="col-form-label-sm" for="account_number">Account Number Bank</label>
							<input type="text" class="form-control form-control-sm"  id="account_number" name="account_number" placeholder="" required>
						</div>
						<div class="form-group col-md-4">	
							<label class="col-form-label-sm" for="bank">Bank</label>
							<select class="custom-select d-block form-control-sm col-md-4" id="bank" name="bank" required>
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
						</div>
						<div class="form-group col-md-12">
							<input class="btn btn-sm btn-success sub" type="submit" value="Update" />
						</div>

					</form>
				</div>
			</div>
			@endif

			<div id="box-message">
				<div class="box-title">Chat</div>
				<div class="box-content">

				</div>
				<div class="box-input">
					<textarea placeholder="Type a message..." rows="2" onkeyup="sendText(event, this)"></textarea>
					<div>
						<i class="fa fa-thumbs-up thumbs" aria-hidden="true" onclick="sendIcon('fa-thumbs-up')"></i>
						<i class="fa fa-thumbs-down thumbs" aria-hidden="true" onclick="sendIcon('fa-thumbs-down')"></i>
						<i class="fa fa-smile-o" aria-hidden="true" onclick="sendIcon('fa-smile-o')"></i>
						<i class="fa fa-heart-o" aria-hidden="true" onclick="sendIcon('fa-heart')"></i>
						<label for="fileImage"><i class="fa fa-file-image-o" aria-hidden="true"></i></label>
					</div>
					<form>
						<input type="file" name="fileImage" id="fileImage" onchange="sendImage(this)" accept="image/*">  
					</form>

				</div>
			</div>

		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-header bg-info">
					<h5 class="text-center"> BUY ({{ $user_a->name }})</h5>
				</div>
				<div class="card-block">
					<p class="card-text"><strong>Coin:</strong> {{ $exchange->coin ? $exchange->coin:"Please UPDATE!" }}</p>
					<p class="card-text"><strong>Address Wallet:</strong> {{ $exchange->address_wallet_a ? $exchange->address_wallet_a:"Please UPDATE!" }}</p>
					<p class="card-text"><strong>Phone:</strong> {{ $exchange->phone_a ? $exchange->phone_a:"Please UPDATE!" }}</p>
					<p class="card-text"><strong>Bank:</strong> {{ $exchange->bank_a ? $exchange->bank_a:"Please UPDATE!" }}</p>
					<p class="card-text"><strong>Account number bank:</strong> {{ $exchange->account_number_a ? $exchange->account_number_a:"Please UPDATE!"}}</p>
				</div>
			</div>
			@if (( !$exchange->address_wallet_a || !$exchange->phone_a || !$exchange->bank_a || !$exchange->account_number_a ) && Auth::user()->id == $exchange->userid_a)
			<div class="card">
				<div class="card-header">
					<h6 class="text-center">ADD BUY ({{ $user_a->name }})</h6>
				</div>
				<div class="card-block">
					<form method="post" action="" id="needs-validation" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="action" value="auto_a">
						<input class="btn btn-sm btn-success sub" type="submit" value="Auto Update" />
					</form>
					<form method="post" action="" id="needs-validation" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="action" value="b">
						<div class="form-group">
							<label class="col-form-label-sm " for="address_wallet">Address Wallet</label>
							<input type="text" class="form-control form-control-sm" id="address_wallet" name="address_wallet" placeholder="" required>
						</div>
						<div class="form-group">
							<label class="col-form-label-sm" for="phone">Phone</label>
							<input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="" required>
						</div>
						<select class="custom-select d-block my-3 form-control-sm" name="bank" required>
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
							<label class="col-form-label-sm" for="account_number">Account Number Bank</label>
							<input type="text" class="form-control form-control-sm"  id="account_number" name="account_number" placeholder="" required>
						</div>
						<input class="btn btn-sm btn-success sub" type="submit" value="Update" />
					</form>
				</div>
			</div>
			@endif
			<div class="card">
				<div class="card-header bg-info">
					<h5 class="text-center"> SELL ({{ $user_b->name }})</h5>
				</div>
				<div class="card-block">
					<p class="card-text"><strong>Coin:</strong> {{ $exchange->coin }}</p>
					<p class="card-text"><strong>Address Wallet:</strong> {{ $exchange->address_wallet_b ? $exchange->address_wallet_b:"Please UPDATE!" }}</p>
					<p class="card-text"><strong>Phone:</strong> {{ $exchange->phone_b ? $exchange->phone_b:"Please UPDATE!" }}</p>
					<p class="card-text"><strong>Bank:</strong> {{ $exchange->bank_b ? $exchange->bank_b:"Please UPDATE!" }}</p>
					<p class="card-text"><strong>Account number bank:</strong> {{ $exchange->account_number_b ? $exchange->address_wallet_b:"Please UPDATE!" }}</p>
				</div>
			</div>
			@if (( !$exchange->address_wallet_b || !$exchange->phone_b || !$exchange->bank_b || !$exchange->account_number_b ) && Auth::user()->id == $exchange->userid_b)
			<div class="card">
				<div class="card-header">
					<h6 class="text-center">ADD SELL ({{ $user_b->name }})</h6>
				</div>
				<div class="card-block">
					<form method="post" action="" id="needs-validation" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="action" value="auto_b">
						<input class="btn btn-sm btn-success sub" type="submit" value="Auto Update" />
					</form>
					<form method="post" action="" id="needs-validation" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="action" value="b">
						<div class="form-group">
							<label class="col-form-label-sm " for="address_wallet">Address Wallet</label>
							<input type="text" class="form-control form-control-sm" id="address_wallet" name="address_wallet" placeholder="" required>
						</div>
						<div class="form-group">
							<label class="col-form-label-sm" for="phone">Phone</label>
							<input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="" required>
						</div>
						<select class="custom-select d-block my-3 form-control-sm" name="bank" required>
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
							<label class="col-form-label-sm" for="account_number">Account Number Bank</label>
							<input type="text" class="form-control form-control-sm"  id="account_number" name="account_number" placeholder="" required>
						</div>
						<input class="btn btn-sm btn-success sub" type="submit" value="Update" />
					</form>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>


@endsection


@section('js')
<script type="text/javascript" src="{{asset('public/js/bootstrap-demo.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/message.js')}}"></script>

@endsection