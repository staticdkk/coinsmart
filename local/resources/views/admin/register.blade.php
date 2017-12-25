@extends('layouts.layout')
@section('content')
<div class="container mt-2">
    <div class="row">
        <!-- col-6  login-->
        <div class="col-md-4 offset-md-4">
            <form method="post" action="{{ url('register')}}" id="needs-validation" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="col-form-label" for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="password">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="cpassword">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Password" required>
                </div>
                <input class="btn btn-success" type="submit" value="Register" />
            </form>
        </div>
    </div>
</div>
@endsection