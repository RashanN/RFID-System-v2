<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Child;
use App\Models\Order;
use App\Models\Intime;
use App\Models\Invoice;
use App\Models\Outtime;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Playtimes;
use Illuminate\Http\Request;
use App\Models\playtimeorder;
use App\Models\Playtimesprice;
use App\Models\Productdraft;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{

    public function create()
    {
        $customers = Customer::all(); // Fetch all customers
        $products = Product::all(); // Fetch all products
        $priceranges = Playtimesprice::all();

        return view('invoice.create', compact('customers', 'products', 'priceranges'));
    }
    public function index(){

        $products = Product::all();
        $amount=1000;

        return view('invoice.show',['products' => $products,'amount'=>$amount]);
    }

    public function getProductDetails(Request $request){

        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        $products = Product::where('id', $productId)->first();


return response()->json(['quantity'=>$quantity, 'products'=>$products]);
    }

    public function getTime(Request $request){

        $rfid = $request->input('rfid');
        $childNames = $request->input('childName');
        $PriceRange = $request->input('pricerange');

        $child=Child::where('id',$childNames)->first();
        $intime = Intime::where('RFID', $rfid)->first();
        $outtime = Outtime::where('RFID', $rfid)->first();
        if ($childNames === null) {
            $child = "[]";
        }

        if ($intime && $outtime) {

            $intime1 = Carbon::parse($intime->intime);
            $outtime1 = Carbon::parse($outtime->outtime);
            $diff = $outtime1->diff($intime1);

            $playedTime = sprintf('%02d:%02d', $diff->h, $diff->i);


        } else {
            $playedTime = "Wrong data. One or both records not found.";
        }

        $defaultprice = 0;
        $amountprice = 0 ;

        if ($PriceRange === 'Kids') {
            $priceModel = Playtimesprice::where('name', 'Kids')->first();
            $defaultprice = $priceModel->price;
            $a=Playtimesprice::where('name', 'A')->value('price');
            list($hours, $minutes) = explode(':', $playedTime);

            if ($hours < 1) {
                $amountprice = $defaultprice;
            }else if($hours==1){
                $slots=ceil(($minutes) / 15);
                $amountprice=$defaultprice+(($slots-1)*$a);
            }else{
                $slots=ceil(($minutes) / 15);
                $hp=(($hours-1)*3*$a);
                $amountprice=$defaultprice+(($slots-1)*$a)+$hp;
            }




            }
        elseif ($PriceRange === 'Toddler') {
            $priceModel = Playtimesprice::where('name', 'Toddler')->first();
            $defaultprice = $priceModel->price;
            $b=Playtimesprice::where('name', 'B')->value('price');

            list($hours, $minutes) = explode(':', $playedTime);
            if ($hours < 1) {
                $amountprice = $defaultprice;
            }else if($hours==1){
                $slots=ceil(($minutes) / 15);
                $amountprice=$defaultprice+(($slots-1)*$b);
            }else{
                $slots=ceil(($minutes) / 15);
                $hp=(($hours-1)*3*$b);
                $amountprice=$defaultprice+(($slots-1)*$b)+$hp;
            }

        }
        // Intime::where('RFID', $rfid)->delete();
        // Outtime::where('RFID', $rfid)->delete(); 

        return response()->json(['child' => $child ,'intime' =>$intime , 'outtime' => $outtime ,'playedtime' => $playedTime ,'amountprice' => $amountprice]);
    }

    public function playTimeOrder(Request $request){
        $products = Product::all();
        $jsonData = json_decode($request->input('data'), true);
        $total = $request->input('total');
        $customerId = $request->input('customerId');

        $invoice = new Invoice;
        $invoice->customer_id = $customerId;
        $invoice->save();
        
        $invoiceId = $invoice->id;

        if (!empty($jsonData)) {
            foreach ($jsonData as $data) {
                $playtimeorder = new Playtimeorder; // Assuming your model name is Playtimeorder

                // Assign values to the model properties
                $playtimeorder->intime = $data['intime'];
                $playtimeorder->outtime = $data['outtime'];
                $playtimeorder->amount = $data['amount'];
                $playtimeorder->customer_id = $data['customerId'];
                if ($data['child_id'] != 'no child') {
                    $playtimeorder->child_id = $data['child_id'];
                }
                $playtimeorder->invoice_id = $invoiceId;

               // dd($playtimeorder);
                // Save the model to the database
                $playtimeorder->save();
            }
        }
        return response()->json(['products' => $products, 'total' => $total]);
        // return redirect()->route('invoice.show')->with(['products' => $products, 'total' => $total]);

    }

    public function invoiceShow(Request $request){

        $totalAmount = $request->query('totalAmount');
        $products = Product::all();

        return view('invoice.show', ['total' => $totalAmount, 'products'=>$products]);
    }

    public function invoiceGenerator(Request $request){


        $jsonData = json_decode($request->input('data'), true);
        $discount = $request->input('discount');
        $fine = $request->input('fine');
        $total = $request->input('total');
        $date = Carbon::now()->toDateString();


        $invoice_id = Invoice::orderBy('id', 'desc')->first();
        $lastInvoice = Invoice::orderBy('id', 'desc')->first();
        $lastInvoiceId = $lastInvoice->id;

        $invoice_id->discount = $discount;
        $invoice_id->fine = $fine;
        $invoice_id->total = $total;
        $invoice_id->date =$date;

        $invoice_id->save();

        if (!empty($jsonData)) {
            foreach ($jsonData as $data) {
               $order=new Order; // Assuming your model name is Playtimeorder
               $order->date =  $date;
               $order->amount=$data['totalprice'];
               $order->quantity=$data['quantity'];
               $order->product_id=$data['Product_id'];
               $order->invoice_id=$lastInvoiceId;


                // Save the model to the database
                $order->save();

                $product = Product::find($data['Product_id']); // Assuming your model name is Product
                if ($product) {
                    $product->stock_level -= $data['quantity'];
                    $product->save();
                }
            }
            $invoice = Invoice::findOrFail($lastInvoiceId); // Assuming you have an Invoice model
    
            $customerId = $invoice->customer_id;

            // Step 2: Delete all rows from the productdraft table with the retrieved customer_id
                ProductDraft::where('customer_id', $customerId)->delete();
        
        }
        return response()->json(['invoiceId'=> $lastInvoiceId]);

        }
        public function invoiceDraft(Request $request)
        {
            $jsonData = json_decode($request->input('data'), true);
            $customer = $request->input('customer');
            $date = Carbon::now()->toDateString();


            if (!empty($jsonData)) {
                foreach ($jsonData as $data) {
                 // Assuming your model name is Playtimeorder
                    $productdraft = new Productdraft;

                    // Assign values to the model properties
                    $productdraft->date = $date;
                    $productdraft->amount = $data['totalprice'];
                    $productdraft->quantity = $data['quantity'];
                    $productdraft->product_id=$data['Product_id'];
                    $productdraft->customer_id = $customer;
                    
                   
    
                   // dd($playtimeorder);
                    // Save the model to the database
                    $productdraft->save();
                }
            }
            return response()->json('successfull');
        }
        public function invoiceBill(Request $request){
            //dd($request);
            $invoiceId = $request->query('invoice');

            $invoice = Invoice::find($invoiceId);
            $products = Product::all();
            //dd($invoiceId);
            $invoiceID = $invoice->id;


            $customerName = Customer::where('id', $invoice->customer_id)->value('name');

           // $playtimeOrders = PlaytimeOrder::where('invoice_id', $invoiceID)->get();
           $playtimeOrders = PlaytimeOrder::leftJoin('child', 'playtimeorder.child_id', '=', 'child.id')
           ->where('playtimeorder.invoice_id', $invoiceID)
           ->select('playtimeorder.*', 'child.name as child_name')
           ->get();


           $purchaseItems = Order::where('invoice_id', $invoiceID)
                          ->leftJoin('product', 'order.product_id', '=', 'product.id')
                          ->select('order.*', 'product.name as product_name')
                          ->get();
                         // dd( $purchaseItems);

            //dd( $playtimeOrders);
            return view('invoice.bill', ['invoice' => $invoice, 'products' => $products, 'playtimeOrders' => $playtimeOrders,'customerName'=>  $customerName,'purchaseItems'=>$purchaseItems]);
        }
        public function index1()
        {
            $invoices = DB::table('invoice')
                    ->join('customer', 'invoice.customer_id', '=', 'customer.id')
                    ->select('invoice.*', 'customer.name as customer_name')
                    ->get();

            //dd( $invoices);
            return view('invoice.index', compact('invoices'));
        }
        public function invoicePreview( Request $request)
        {
            dd($request);
            $invoiceId = $request->query('invoice');
            dd( $invoiceId);
        }
        public function show($id)
            {
                $invoice = Invoice::findOrFail($id);
                return view('invoice.index', compact('invoice'));
            }
        public function draft()
        {
            $products = Product::all();

            return view('invoice.draft' , compact('products'));
        }
        public function getProductDraftData(Request $request)
    {
        // Get the last invoice's customer ID
        $lastInvoice = Invoice::latest()->first();
        $customerId = $lastInvoice->customer_id;

        // Fetch product draft data for the customer
        $productDraftData = ProductDraft::where('customer_id', $customerId)->get();

        return response()->json($productDraftData);
    }
    public function fetchProductDraftData()
    {
        // Fetch data from the productdraft table
        $lastInvoice = Invoice::latest()->first();
        $customerId = $lastInvoice->customer_id;

        // Fetch product draft data for the customer
        $productDraftData = ProductDraft::where('customer_id', $customerId)
            ->with('product')
            ->get();
        
        return response()->json($productDraftData);
    }
}

