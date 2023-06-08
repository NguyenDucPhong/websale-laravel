<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class CheckOutController extends Controller
{
    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index', compact('carts', 'total', 'subtotal'));
    }

    public function addOrder(Request $request){

       
            //them hoa don
            $orders = Order::create($request->all());

            //them chi tiet hoa don
            $carts = Cart::content();

            foreach($carts as $cart){
                $data = [
                    'order_id' => $orders->id,
                    'product_id' => $cart->id,
                    'qty'   => $cart->qty,
                    'amount'    => $cart->price,
                    'total' => $cart->price * $cart->qty
                ];

                OrderDetail::create($data);
            }
        if($request->payment_type == 'payment_later'){
            $total = Cart::total();
            $subtotal = Cart::subtotal();    
            $this->sendEmail($orders, $total,$subtotal);

            //xoa gio hang
            Cart::destroy();

            return "success";
        }
        if($request->payment_type == 'online_payment'){
            //Lay URL thanh toan VNP
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $orders->id, //ID cua don hang
                'vnp_OrderInfo'=>'Mo ta ve don hang' ,
                'vnp_Amount'=> Cart::total(0, '', '') * 23075   
            ]);
            //Chuyen huong toi URL lay duoc
            return redirect()->to($data_url);
        }
        else{
            return "Online payment";
        }
        
    }

    public function vnPayCheck(Request $request){
        //lay data tu URL(Do VNpay gui ve qua $vnp_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');//Ma phan hoi ket qua thanh toan
        $vnp_TxnRef = $request->get('vnp_TxnRef');//ticket_id
        $vnp_Amount = $request->get('vnp_Amount');//So tien thanh toan

        //Kiem tra ket qua giao dich tra ve tu VNpay
        if($vnp_ResponseCode != null){
            //neu thanh cong
            if($vnp_ResponseCode == 00){
                //gui mail
                $order = Order::find($vnp_TxnRef);
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendEmail($order, $total, $subtotal);

                //xoa gio hang
                Cart::destroy($order);

                //thong bao ket qua
                return "Success !!!";
            }
            else{
                //neu khong thanh cong
                //xoa don hang trong database va tra ve thong bao loi
                Order::find($vnp_TxnRef)->delete();
    
                return "ERROR"; 
            }
        }
       
    }

    private function sendEmail($order, $total, $subtotal){
        $email_to = $order->email;

        Mail::send('front.checkout.email', compact('order', 'total', 'subtotal'), function ($message) use($email_to){
            $message->from('pn463187@gmail.com', 'Phong Nguyen Duc');
            $message->to($email_to, $email_to);
            $message->subject('Order Notification');
        });
    }
}
