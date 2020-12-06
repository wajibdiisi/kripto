<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(){

    }
    public function create_transaction(Request $request){
        
        $data = Transaction::latest()->first();
        return Transaction::create([
            'sender' => $request->get('sender'),
            'receiver' => $request->get('receiver'),
            'amount' => $request->get('amount'),
            'email' => $request->get('email'),
            'transaction_id' => $data->transaction_id + 1
          ]); 
    }

    public function get_transaction(){
        $data = Transaction::orderBy('transaction_id','desc')->get()->toJson();
        return $data;
    }
    public function get_singletransaction($transaction_id){
    
        $data = Transaction::where('transaction_id','=',(int)$transaction_id)->first()->toJson();
        return $data;
    }
    
}
