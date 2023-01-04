<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Transaction::get();
        // return view('admin.pages.transaction.list', [
        //     'data' => $data,
        // ]);
        $data = Transaction::get();
        return view('admin.pages.transaction.list', ['data' => $data]);
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
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $products = [1, 2, 3, 4, 5, 6];
        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'id' => Uuid::uuid4()->toString(),
                'customer' => 'sulthan',
                'total_amount' => 10000
            ]);

            $transactiondetails = [];
            foreach ($products as $key => $value) {
                $transactiondetails[] = [
                    'id' => Uuid::uuid4()->toString(),
                    'transaction_id' => $transaction->id,
                    'product_id' => $value,
                    'quantity' => 1000,
                    'amount' => 1000,
                    'created_at' => Carbon::now()
                ];
            }
            if ($transactiondetails) {
                TransactionDetail::insert($transactiondetails);
            }
            DB::commit();
            return "ok";
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
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
        // $data = $transaction->load(['details']);
        // return view('admin.pages.transaction.detail', compact('data'));
        // $data = DB::table('transactions')
        //     ->join('transaction_details', 'transactions.id', '=',  'transaction_details.transactions_id')
        //     ->select('transactions.*', 'transaction_details.*')
        //     ->get();
        // return view('admin.pages.transaction.detail', compact('data'));
        // return view('admin.pages.transaction.detail', [
        //     'transaction' => Transaction::all(),
        //     'details' => TransactionDetail::all()
        // ]);
        $id = $transaction->id;
        $data = TransactionDetail::where('transaction_id', $id)->with('product')->get();
        return view('admin.pages.transaction.detail', [
            'data' => $data,
            'transaction' => $transaction
        ]);
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
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
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
}