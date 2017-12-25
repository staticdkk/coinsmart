@extends('layouts.layout')

@section('content')

<meta http-equiv="refresh" content="90">
<div class="container mt-2">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="exchange" title="Exchange">Create Exchange</a>
        </div>
        <div class="col-md-12 mt-2">
            <div class="jumbotron">
                <h1 class="display-6">Welcome COINSMART</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <p class="lead">
            </p>
        </div>

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header bg-">
                    <h5 class="text-center"> Transaction </h5>
                </div>
                <div class="card-block row">
                    @foreach ($exchange as $row)
                    <div class="alert {{ $row->step >= 5 ? 'alert-success':'alert-warning' }} col-md-12" role="alert">
                        <strong>{{ $row->usera }}</strong> vs  <strong>{{ $row->userb }}</strong> <strong>{{ $row->step >= 5 ? " giao dịch thành công!!":"đang giao dich!!"}}</strong> 
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
        
    </div>
</div>
</div>
@endsection
