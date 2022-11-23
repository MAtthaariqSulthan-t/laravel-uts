<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ApiController extends Controller
{
    public function list(request $request)
    {
        $limit = $request->input('limit');
        return Transaction::with(['details'])->paginate($limit);
    }

    public function detail(Request $request, $id)
    {

        return Transaction::with(['details'])->find($id);
        //return Transaction::where('id', $id)->first();
    }

    public function store(Request $request)
    {
        $params = $request->all();//data dari inputan
        $productIds = collect($params['products']);//dijadikan sakti
        $productIds = $productIds->pluck('id');
        //cara primitif menjadikan sakti
        $productIds = [];
        foreach ($params['products'] as $value){
            $productIds[] = $value['id'];
        }

        $products = Product::whereIn('id', $productIds)->get();
        $total_amount = 0;
        foreach ($params['products'] as $value){
            $product = $products->firstWhere('id', $value['id']);
            $total_amount += ($product ? $product->price : 0) * $value['qty'];
        }

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'id' => Uuid::uuid4()->toString(),
                'customer' => $params['customer_name'],
                'total_amount' => $total_amount
            ]);

            $transactiondetails = [];
            foreach($params['products'] as $key => $value) {
                $product = $products->firstWhere('id', $value['id']);
                $transactiondetails[] = [
                    'id' => Uuid::uuid4()->toString(),
                    'transaction_id' => $transaction->id,
                    'product_id' => $value['id'],
                    'quantity' => $value['qty'],
                    'amount' => $product ? $product->price : 0,
                    'created_at' => Carbon::now()
                ];
            }
            if($transactiondetails){
                TransactionDetail::insert($transactiondetails);
            }
            DB::commit();
            return $transaction;
        } catch (\Throwable $th) {
            DB::rollback();
           return $th;
        }

    }
}