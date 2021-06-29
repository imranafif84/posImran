<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;
use DateTime;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
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

    public function getCategoryProduct($id){
        $catproducts = Product::where('category_id', $id)->get();

        return response()->json($catproducts);
    }

    public function orderPayment(Request $request){
        
        $validateData = $request->validate([
            'customer_id' => 'required',
            'payment_type' => 'required',
            'pay' => 'required'
        ]);

        $data = array();

        $data['customer_id'] = $request->customer_id;
        $data['totalQuantity'] = $request->totalQuantity;
        $data['totalSubPrice'] = $request->totalSubPrice;
        $data['payment_type'] = $request->payment_type;
        $data['pay'] = $request->pay;
        $data['tax_amount'] = $request->tax_amount;
        $data['totalPrice'] = $request->totalPrice;
        $data['due'] = $request->due;
        $data['order_date'] = date('d/m/Y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($data);

        $contents = DB::table('pos')->get();

        $odata = array();

        foreach($contents as $content){
            $odata['order_id'] = $order_id;
            $odata['product_id'] = $content->product_id;
            $odata['product_quantity'] = $content->product_quantity;
            $odata['product_price'] = $content->product_price;
            $odata['sub_total'] = $content->sub_total;
            DB::table('order_details')->insert($odata);

            DB::table('products')->where('id',$content->product_id)
            ->update(['product_quantity' => DB::raw('product_quantity -' . $content->product_quantity)]);
        }

        DB::table('pos')->delete();
        return response('Completed!');

    }

    public function orderTodayList(){
        $date = date('d/m/Y');
        $orders = DB::table('orders')
        ->join('customers', 'customers.id', 'orders.customer_id')
        //->where('orders.order_date', $date)
        ->select('customers.name', 'orders.*')
        ->orderBy('orders.id', 'DESC')->get();

        return response()->json($orders);
    }

    public function orderTodayView($id){

        $orders = DB::table('orders')
        ->join('customers', 'customers.id', 'orders.customer_id')
        ->where('orders.id', $id)
        ->select('customers.name', 'customers.phone', 'customers.address', 'orders.*')
        ->orderBy('orders.id', 'DESC')->first();

        return response()->json($orders);
    }

    public function orderTodayDetail($id){

        $order_details = DB::table('order_details')
        ->join('products', 'products.id', 'order_details.product_id')
        ->where('order_details.order_id', $id)
        ->select('products.product_name', 'products.product_code', 'products.image', 'order_details.*')
        ->get();

        return response()->json($order_details);
    }

    public function orderSearch(Request $request){
        $orderdate = $request->date;
        $newdate = new DateTime($orderdate);
        $done = $newdate->format('d/m/Y');

        $orders = DB::table('orders')
        ->join('customers', 'orders.customer_id', 'customers.id')
        ->select('customers.name', 'orders.*')
        ->where('orders.order_date', $done)
        ->get();

        return response()->json($orders);
    }

    public function getTodaySales(){
        $today = date('d/m/Y');

        $todaySales = DB::table('orders')
        ->where('order_date', $today)
        ->sum('totalPrice');

        return response()->json($todaySales);
    }

    public function getTodayIncomes(){
        $today = date('d/m/Y');

        $income = DB::table('orders')
        ->where('order_date', $today)
        ->sum('pay');

        return response()->json($income);
    }

    public function getTodayDues(){
        $today = date('d/m/Y');

        $due = DB::table('orders')
        ->where('order_date', $today)
        ->sum('due');

        return response()->json($due);
    }

    public function getTodayExpenses(){
        $today = date('d/m/y');

        $expense = DB::table('expenses')
        ->where('expense_date', $today)
        ->sum('amount');

        return response()->json($expense);
    }

    public function getTodayStockout(){
        $today = date('d/m/y');

        $products = DB::table('products')
        ->where('product_quantity', '<', '1')
        ->get();

        return response()->json($products);
    }
}
