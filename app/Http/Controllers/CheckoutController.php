<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Config;
use Ramsey\Uuid\Uuid;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreProductRequest;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::paginate(100);
        return view('admin.pages.checkout.product', compact('data'), [
            'title' => 'List Product',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $productID = $request->input('product_id');
        $qty = (int) $request->input('qty', 1);
        $checkout = [
            'products' => [],
            'user' => [
                "name" => "",
                "address" => ""
            ],
        ];
        $data = Cache::get('checkout', $checkout);
        $temp = null;
        if (isset($data['products'][$productID])) {
            $temp =  [
                "id" => $productID,
                "qty" => $qty + $data['products'][$productID]['qty']
            ];
        } else {
            $temp =  [
                "id" => $productID,
                "qty" => $qty
            ];
        }
        $data['products'][$productID] = $temp;

        Cache::put('checkout', $data);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //DB Transaction
        $data = $request->all();
        // dd($data);
        $productIds = $data['product_id'];
        $productQty = $data['qty'];
        $productPrices = $data['price'];
        $products = Product::whereIn('id', $productIds)->get();

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'id' => Uuid::uuid4()->toString(),
                'customer' => $data['customer_name'],
                'address' => $data['address'],
                'total_amount' => $data['total_amount'],
            ]);
            $transaction_details = [];
            foreach ($productIds as $key => $value) {
                $product = $products->firstWhere('id', $value);
                $transaction_details[] = [
                    'id' => Uuid::uuid4()->toString(),
                    'transaction_id' => $transaction['id'],
                    'product_id' => $product['id'],
                    'quantity' => $productQty[$key],
                    'amount' => $productPrices[$key],
                    'created_at' => Carbon::now()
                ];
            }

            if ($transaction_details) {
                TransactionDetail::insert($transaction_details);
            }

            Cache::forget('checkout');
            $paymentUrl = $this->createInvoice($transaction);
            DB::commit();
            return $paymentUrl;
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function chart()
    {
        $data = Cache::get('checkout');
        $id = [];
        $qty = [];
        $prices = [];
        foreach ($data['products'] as $product) {
            $id[] = $product['id'];
            $qty[] = $product['qty'];
        }
        $products = Product::whereIn('id', $id)->get();
        foreach ($products as $product) {
            $prices[] = $product->price;
        }
        $totalprice = 0;
        foreach ($prices as $key => $price) {
            $totalprice += $price * $qty[$key];
        }
        return view('admin.pages.checkout.chart', compact('data'), [
            'title' => 'My Chart',
            'products' => $products,
            'totalprice' => $totalprice
        ]);
    }

    public function createInvoice($transaction)
    {

        // set konnfigrasi midtrans ngambil dari config/midrtrans.php
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // bat params untuk dikirim ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' =>  (int) $transaction->total_amount //ditetapkan harus int yang dikirim //ditetapkan harus int yang dikirim
            ],
            'customer_details' => [
                'first_name' => $transaction->customer,
                'email' => "yogaperdana78@gmail.com"
            ],
        ];

        // untuk jika berhasil dan gagal

        // Get Snap Payment Page URL
        $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;
        return $paymentUrl;
    }
}