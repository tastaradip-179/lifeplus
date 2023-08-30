@extends('layouts.app')
@section('content')
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Account no</th>
                <th scope="col">User</th>
                <th scope="col">Current Balance</th>
                <th scope="col">Date Opened</th>
                <th scope="col">Date Closed</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @php($id=1)
              @foreach($bank_accounts as $bank_account)
              <tr>
                <th scope="row">{{$id++}}</th>
                <td>{{$bank_account->account_no}}</td>
                <td>{{$bank_account->user_id}}</td>
                <td>{{$bank_account->current_balance}}</td>
                <td>{{$bank_account->date_opened}}</td>
                <td>{{$bank_account->date_closed}}</td>
                <td>
                  @if($bank_account->account_status == 1)
                  <span class="badge bg-info">Ongoing</span>
                  @else
                  <span class="badge bg-secondary">Closed</span>
                  @endif
                </td>
                <td>
                  <a href="{{url('api/bank_accounts',[$bank_account])}}" class="btn btn-primary">View</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
@endsection
