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
use App\Models\Document;
use App\Models\Auction;
use Session;

class PaymentController extends Controller
{
    public function yenepay(){
        $code;
        // $documents=Document::where('code',$code);
        request()->session()->put('code',$code);

       
        $sellerCode = "SB1401";
        $useSandbox = true;
        $checkoutOptions = new CheckoutOptions($sellerCode, $useSandbox);

        
        $checkoutOptions -> setProcess(CheckoutType::Express);

         $successUrl = route('payment.success');
         $cancelUrl = route('payment.cancel');
         //$failureUrl = "YOUR_PAYMENT_FAILURE_RETURN_URL";
         $ipnUrl = route('payment.ipn');
         
         $checkoutOptions -> setSuccessUrl($successUrl);
         $checkoutOptions -> setCancelUrl($cancelUrl);
        // $checkoutOptions -> setFailureUrl($failureUrl);
         $checkoutOptions -> setIPNUrl($ipnUrl);
         $checkoutOptions -> setMerchantOrderId("SB1401");
         $checkoutOptions -> setExpiresAfter(5);
         
         
         $checkoutOrderItem = new CheckoutItem("Auction Documnent Payment", 100, 1);
         $checkoutOrderItem  -> ItemId = "111";
     
         
         $checkoutHelper = new CheckoutHelper();
         $checkoutUrl = $checkoutHelper -> getSingleCheckoutUrl($checkoutOptions, $checkoutOrderItem);

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
   
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        request()->session()->flash('success','Paymnet completed successfully!!!');
        // return redirect()->route('document.show}');
        //  $auction_code=$request->session()->get('auction_code');
                // $documents=Document::where('code',$auction_code);
              $code = session('code');
               $documents=Document::where('auction_id', $code)->get();
        return view('frontend.pages.auction_document')->with('documents',$documents);
      

    }



    /// auction fee

    public function pay_for_auction($total_price){
       
        $sellerCode = "SB1401";
        $useSandbox = true;
        $checkoutOptions = new CheckoutOptions($sellerCode, $useSandbox);

        
        $checkoutOptions -> setProcess(CheckoutType::Express);

         $successUrl = route('payment.success');
         $cancelUrl = route('payment.cancel');
         //$failureUrl = "YOUR_PAYMENT_FAILURE_RETURN_URL";
         $ipnUrl = route('payment.ipn');
         
         $checkoutOptions -> setSuccessUrl($successUrl);
         $checkoutOptions -> setCancelUrl($cancelUrl);
        // $checkoutOptions -> setFailureUrl($failureUrl);
         $checkoutOptions -> setIPNUrl($ipnUrl);
         $checkoutOptions -> setMerchantOrderId("SB1401");
         $checkoutOptions -> setExpiresAfter(5);
         
         
         $checkoutOrderItem = new CheckoutItem("Auction Documnent Payment", $total_price, 1);
         $checkoutOrderItem  -> ItemId = "111";
     
         
         $checkoutHelper = new CheckoutHelper();
         $checkoutUrl = $checkoutHelper -> getSingleCheckoutUrl($checkoutOptions, $checkoutOrderItem);

         return redirect($checkoutUrl);
    }
    // public function document_detail($code){
    //     // $code;
    //     // $documents=Document::where('code',$code);
    //     request()->session()->put('code',$code);
    //     $code = session('code');
    //     $documents=Document::where('auction_id', $code)->get();

    // }
}
