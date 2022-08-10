<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
use App\Models\Cart;
use App\Models\Product;
use DB;
use YenePay\Models\CheckoutOptions;
use YenePay\Models\CheckoutItem;
use YenePay\Models\CheckoutType;
use YenePay\CheckoutHelper;
use YenePay\Models\PDT;

class PaypalController extends Controller
{
    public function payment()
    {
        $cart = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->get()->toArray();
        
        $data = [];
        
        return $cart;
        $data['items'] = array_map(function ($item) use($cart) {
            $name=Product::where('id',$item['product_id'])->pluck('title');
            return [
                'name' =>$name ,
                'price' => $item['price'],
                'desc'  => 'Thank you for using paypal',
                'qty' => $item['quantity']
            ];
        }, $cart);

        $data['invoice_id'] ='ORD-'.strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;
        if(session('coupon')){
            $data['shipping_discount'] = session('coupon')['value'];
        }
        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => session()->get('id')]);

        // return session()->get('id');


        // $provider = new ExpressCheckout;
  
        // $response = $provider->setExpressCheckout($data);
    
        // return redirect($response['paypal_link']);



        // yene pay
        $sellerCode = "SB1401";
        $useSandbox = true;

        $checkoutOptions = new CheckoutOptions($sellerCode, $useSandbox);
        $checkoutOptions -> setProcess(CheckoutType::Cart);
        $successUrl = route('payment.success');
        $cancelUrl = route('payment.cancel');
       // $failureUrl = "YOUR_PAYMENT_FAILURE_RETURN_URL";
       // $ipnUrl = "YOUR_PAYMENT_COMPLETION_NOTIFICATION_URL";

        $checkoutOptions -> setSuccessUrl($successUrl);
        $checkoutOptions -> setCancelUrl($cancelUrl);
        //$checkoutOptions -> setFailureUrl($failureUrl);
        //$checkoutOptions -> setIPNUrl($ipnUrl);
        $checkoutOptions -> setMerchantOrderId($data['invoice_id']);
        //$checkoutOptions -> setExpiresAfter("NUMBER_OF_MINUTES_BEFORE_THE_ORDER_EXPIRES");


        $checkoutOrderItem = new CheckoutItem($data['name'], $data['price'], $data['qty']);
        $checkoutOrderItem  -> ItemId = $data['invoice_id'];
        $checkoutOrderItem  -> DeliveryFee = $data['shipping_discount'];
        //$checkoutOrderItem  -> Tax1 = VAT_FEE_IF_AVAILABLE;
        // $checkoutOrderItem  -> Tax2 = TOT_FEE_IF_AVAILABLE;
        // $checkoutOrderItem  -> Discount = DISCOUNT_AMOUNT_IF_AVAILABLE;
        // $checkoutOrderItem  -> HandlingFee = HANDLING_FEE_IF_AVAILABLE;

        $checkoutHelper = new CheckoutHelper();
        $checkoutUrl = $checkoutHelper -> getCartCheckoutUrl($checkoutOptions, $checkoutOrderItem);
        return redirect($checkoutUrl);

    }

    public function yenepay(){
       
        $cart = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->get()->toArray();
        $data = array();
        $data['items'] = array_map(function ($item) use($cart) {
        $name=Product::where('id',$item['product_id'])->pluck('title');
            return [
                'ItemId' =>$item['product_id'],
                'ItemName' =>json_encode($name),
                'UnitPrice' => $item['price'],
                'desc'  => 'Thank you for using paypal',
                'Quantity' => $item['quantity']
            ];
        }, $cart);
        
        $data['invoice_id'] ='ORD-'.strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['ipn_url'] = route('payment.ipn');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['UnitPrice']*$item['Quantity'];
        }
        

        $data['total'] = $total;
        if(session('coupon')){
            $data['shipping_discount'] = session('coupon')['value'];
        }
        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => session()->get('id')]);
        
        $sellerCode = "SB1401";
        $successUrl = $data['return_url']; //"YOUR_SUCCESS_URL";
        $cancelUrl = $data['cancel_url']; //"YOUR_CANCEL_URL";
        $ipnUrl = $data['ipn_url']; //"YOUR_IPN_URL";
        $useSandbox = true; // set this to false if you are on production environment

        $checkoutOptions = new CheckoutOptions($sellerCode, $useSandbox);
        $checkoutOptions -> setProcess(CheckoutType::Cart);
        $checkoutOptions -> setSuccessUrl($successUrl);
        $checkoutOptions -> setCancelUrl($cancelUrl);
        $checkoutOptions -> setIPNUrl($ipnUrl);
	    $checkoutOptions -> setTotalItemsDeliveryFee(0);

       

        $checkoutOrderItems = array();
        $checkoutOrderItems = $data['items'];
        foreach($data['items'] as $key=>$value)
        {
            $eitem = new CheckoutItem();
            $checkoutOrderItems[$key] = $eitem->getFromArray($value);
        }
    
        $checkoutHelper = new CheckoutHelper();
        $checkoutUrl = $checkoutHelper -> getCartCheckoutUrl($checkoutOptions, $checkoutOrderItems);
         return redirect($checkoutUrl);

    }
   

    public function ipn(){
            $ipnModel = new IPN();
            $ipnModel->setUseSandbox(true);

            $json_data = json_decode(file_get_contents('php://input'), true);

            if(isset($json_data["TotalAmount"]))
                $ipnModel->setTotalAmount($json_data["TotalAmount"]);
            if(isset($json_data["BuyerId"]))
                $ipnModel->setBuyerId($json_data["BuyerId"]);
            if(isset($json_data["MerchantOrderId"]))
                $ipnModel->setMerchantOrderId($json_data["MerchantOrderId"]);
            if(isset($json_data["MerchantId"]))
                $ipnModel->setMerchantId($json_data["MerchantId"]);
            if(isset($json_data["MerchantCode"]))
                $ipnModel->setMerchantCode($json_data["MerchantCode"]);
            if(isset($json_data["TransactionCode"]))
                $ipnModel->setTransactionCode($json_data["TransactionCode"]);
            if(isset($json_data["TransactionId"]))
                $ipnModel->setTransactionId($json_data["TransactionId"]);
            if(isset($json_data["Status"]))
                $ipnModel->setStatus($json_data["Status"]);
            if(isset($json_data["Currency"]))
                $ipnModel->setCurrency($json_data["Currency"]);
            if(isset($json_data["Signature"]))
                $ipnModel->setSignature($json_data["Signature"]);

            $helper = new CheckoutHelper();
            if ($helper->isIPNAuthentic($ipnModel))
            {	//This means the payment is completed
                //You can now mark the order as "Paid" or "Completed" here and start the delivery process
                echo 'Success!';
            }
            else
                echo 'Fail';
    }
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        $pdtToken = "dwJLCNz1HCH3bU";
$pdtRequestType = "PDT";
$pdtModel = new PDT($pdtToken);
$pdtModel->setUseSandbox(true);
		
if(isset($_GET["TransactionId"]))
	$pdtModel->setTransactionId($_GET["TransactionId"]);
if(isset($_GET["MerchantOrderId"]))
	$pdtModel->setMerchantOrderId($_GET["MerchantOrderId"]);
	

$helper = new CheckoutHelper();
$result = $helper->RequestPDT($pdtModel);

if($result['result'] == "SUCCESS"){
	$order_status = $result['Status'];
	if($order_status == 'Canceled')
	{
		
        echo "payment is cancled";
        //This means the payment is canceled. 
		//You can extract more information of the transaction from the $result array
		//You can now mark the order as "Canceled" here.
	}
}
else{
    echo "payment is cancled";
	//This means the pdt request has failed.
	//possible reasons are 
		//1. the TransactionId is not valid
		//2. the PDT_Key is incorrect
}

return $result['result'];
        
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        //
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        
  
        // if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if($result['result'] == "SUCCESS"){
            request()->session()->flash('success','You successfully pay  Thank You');
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->route('home');
        }
  
        request()->session()->flash('error','Something went wrong please try again!!!');
        return redirect()->back();
        // $pdtToken = "dwJLCNz1HCH3bU";
        // $pdtRequestType = "PDT";
        // $pdtModel = new PDT($pdtToken);
        // $pdtModel->setUseSandbox(true);
                
        // if(isset($_GET["TransactionId"]))
        //     $pdtModel->setTransactionId($_GET["TransactionId"]);
        // if(isset($_GET["MerchantOrderId"]))
        //     $pdtModel->setMerchantOrderId($_GET["MerchantOrderId"]);
            

        // $helper = new CheckoutHelper();
        // $result = $helper->RequestPDT($pdtModel);

        // if($result['result'] == "SUCCESS"){
        //     $order_status = $result['Status'];
        //     if($order_status == 'Paid')
        //     {
        //         echo "<script> alert('paid');</script>";
        //         //This means the payment is completed. 
        //         //You can extract more information of the transaction from the $result array
        //         //You can now mark the order as "Paid" or "Completed" here and start the delivery process
        //     }
        // }
        // else{
        //     //This means the pdt request has failed.
        //     //possible reasons are 
        //         //1. the TransactionId is not valid
        //         //2. the PDT_Key is incorrect
        //         echo "unpaid";
        // }

        // request()->session()->flash('success','Your product successfully placed in order');
        // return redirect()->route('home');

    }
}
