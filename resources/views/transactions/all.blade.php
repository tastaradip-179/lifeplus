@extends('layouts.app')
@section('content')
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Transaction no</th>
                <th scope="col">Bank Account Id</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @php($id=1)
              @foreach($transactions as $transaction)
              <tr>
                <th scope="row">{{$id++}}</th>
                <td>{{$transaction->transaction_no}}</td>
                <td>{{$transaction->bank_account_id}}</td>
                <td>{{$transaction->type}}</td>
                <td>{{$transaction->amount}}</td>
                <td>
                  <a href="" class="btn btn-primary">View</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
@endsection
