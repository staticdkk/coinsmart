@extends('layouts.layout')

@section('content')

<meta http-equiv="refresh" content="90">
<div class="container mt-2">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Transaction</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-md-6 mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mediator</th>
                        <th scope="col">B</th>
                        <th scope="col">Coin</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exchange as $row)
                    <tr>
                        <th scope="row">{{ $row->codeexchange }}</th>
                        <td>{{ $row->mediator }}</td>
                        <td>{{ $row->userb }}</td>
                        <td>{{ $row->coin }}</td>
                        <td>{!! $row->step >=5 ? "<span class='badge badge-success'>Success</span>":"<span class='badge badge-warning'>Pending</span>" !!}</td>
                        <td><a href="{{ url('exchange/'.$row->codeexchange) }}" title="Check">Check</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
