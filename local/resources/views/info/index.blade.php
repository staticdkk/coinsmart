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
			<li class="breadcrumb-item active" aria-current="page">info</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
            <a class="btn btn-primary" href="{{ url('coin') }}" title="Exchange">Add Coin</a>
        </div>
        <div class="col-md-6 mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Coin</th>
                        <th scope="col">Address Wallet</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Bank</th>
                        <th scope="col">Account number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coin as $row)
                    <tr>
                        <th scope="row">{{ $row->id }}</th>
                        <td>{{ $row->coin }}</td>
                        <td>{{ $row->address_wallet }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->bank }}</td>
                        <td>{{ $row->account_number }}</td>
                        <td><a href="{{ url('coin/'.$row->id) }}" title="Check">Update</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
</div>
@endsection


@section('js')
<script type="text/javascript" src="{{asset('public/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/select2search.js')}}"></script>
@endsection