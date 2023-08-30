@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <form style="width: 400px">
        <div class="mb-3 form-control">
            <label for="withdrawAmount" class="form-label">Amount</label>
            <input type="number" step="any" class="form-control" name="amount" id="withdrawAmount">
        </div>
        <input type="hidden" name="bank_account_id" value={{$id}} id="bankAccountId">
        <input type="hidden" name="type" id="type" value="withdraw">
        <button type="submit" class="btn btn-primary w-100" id="btn-withdraw">Withdraw</button>
    </form>
</div>
@endsection
  