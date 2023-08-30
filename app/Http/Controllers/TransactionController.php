<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\BankAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $user = Auth::user()->id;
        $transactions = Transaction::whereHas('bank_account', function($accountsQuery) use ($user) {
            $accountsQuery->where('user_id', '=', $user);
        })->latest()->get();
        return view('transactions.all', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        if($request->type == "deposit"){
            $transaction = Transaction::create([
                'transaction_no' => Str::random(9),
                'bank_account_id' => $request->bank_account_id,
                'amount' => $request->amount,
                'type' => "deposit"
            ]);
    
            $prev_current_balance = BankAccount::where('id', "=", $request->bank_account_id)->value('current_balance');
            $new_current_balance = $prev_current_balance + $request->amount;
            $bank_account = BankAccount::where('id', $request->bank_account_id)
                         ->update(['current_balance'=> $new_current_balance]);
        }
        else if($request->type == "withdraw"){
            $weekday = Carbon::now()->dayOfWeek;
            $transaction = Transaction::create([
                'transaction_no' => Str::random(9),
                'bank_account_id' => $request->bank_account_id,
                'amount' => $request->amount,
                'type' => "withdraw"
            ]);
                
            $prev_current_balance = BankAccount::where('id', "=", $request->bank_account_id)->value('current_balance');
            $last_transaction = Transaction::where('bank_account_id', "=", $request->bank_account_id)->orderBy('id', 'desc')->limit(1)->value('created_at');
     
            if($weekday != 5){
                if(Auth::user()->type=="individual"){
                    $cal1 = $request->amount - ($request->amount * 0.00015);
                    $new_current_balance = $prev_current_balance - $cal1;
                }
                else{
                    $cal1 = $request->amount - ($request->amount * 0.00025);
                    $new_current_balance = $prev_current_balance - $cal1;
                } 
            }
            else{
                if($request->amount > 1000){
                    $remaining = $request->amount - 1000;
                    $cal2 = $remaining - ($remaining * 0.00015);
                    $new_current_balance = $prev_current_balance - $cal2;
                    if($request->amount > 5000){
                        $remaining = $request->amount - 5000;
                        $cal3 = $remaining - ($remaining * 0.00015);
                        $new_current_balance = $prev_current_balance - $cal3;
                    }
                }
                else{
                    $new_current_balance = $prev_current_balance - $request->amount;
                }   
            }
            
            $bank_account = BankAccount::where('id', $request->bank_account_id)
                            ->update(['current_balance'=> $new_current_balance]);
    
    
            return response()->json([
                'status' => 'success',
                'message' => 'withdrawn successfully',
                'transaction' => $transaction,
            ]);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function deposit_view(Request $request, $id){
        return view ('transactions.deposit', compact('id'));
    }

    public function withdraw_view($id){
        return view ('transactions.withdraw', compact('id'));
    }

}
