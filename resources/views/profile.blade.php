@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
        <h5 class="card-title">User Detail</h5>
        <h6 class="card-subtitle mb-2 text-muted">Username: {{$user->username}}</h6>
        <h6 class="card-subtitle mb-2 text-muted">Email: {{$user->email}}</h6>
        <h6 class="card-subtitle mb-2 text-muted">Type: {{$user->type}}</h6>
        </div>
    </div>
</div>
@endsection