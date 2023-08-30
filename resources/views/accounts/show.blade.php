@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Account Details</h5>
              <h6 class="card-subtitle mb-2 text-muted">Current Balance: {{$bankAccount->current_balance}}</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="{{url('api/transactions/deposit', [$bankAccount])}}" class="card-link">Deposit</a>
              <a href="{{url('api/transactions/withdraw', [$bankAccount])}}" class="card-link">Withdraw</a>
            </div>
        </div>
</div>
@endsection