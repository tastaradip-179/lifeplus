@extends('layouts.app')
@section('content')
        <div class="d-flex align-items-center justify-content-center vh-100">
            <form style="width: 400px">
                <div class="mb-3 form-control">
                    <label for="initialAmount" class="form-label">Initial Balance to open the account</label>
                    <input type="number" step="any" class="form-control" id="initialAmount">
                </div>
                <button type="submit" class="btn btn-primary w-100" id="btn-create-account">Create An Account</button>
            </form>
        </div>
@endsection
