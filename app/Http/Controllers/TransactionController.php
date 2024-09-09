<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Invoice;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Show all transactions
    public function index()
    {
        $transaction = Invoice :: all();
        return view('transactions.index', ['transaction' => $transaction]);
    }

    

   
}
