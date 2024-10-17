<?php

namespace App\Controllers;

use App\Models\CommissionsModel;
use App\Models\CustomerModel;
use App\Models\PaysModel;
use App\Models\Pay_commissionModel;
use App\Models\Customer_bankModel;
use Fluent\ShoppingCart\Facades\Cart;
use App\Libraries\Evox;

class B_cobros extends BaseController
{
  public function index()
  {
    //get count product shopping cart
    $cart_count = Cart::count();
    //set timezone
    date_default_timezone_set("America/Lima");
    //get data session
    $id = $_SESSION['id'];
    //get all pay
    $Pay = new PaysModel();
    $Customer = new CustomerModel();
    //set var
    $allow = 0;
    //get dat 1 -31
    $day = date("j");
    //get hour 24 h
    $hour = date("G");
    //paydays
    if ($day == '1' || $day == '2') {
      if ($hour >= 9 && $hour < 17) {
        $allow = 1;
      }
    }
    //get customer bank
    $Customer_bank = new Customer_bankModel();
    $obj_customer_bank = $Customer_bank->get_by_customer_id($id);
    //get data customer
    $obj_customer = $Customer->get_customer_by_membership_id($id);
    //ser var
    $customer_pay = $obj_customer->pay;
    //$kyc = $obj_customer->kyc;
    //call library Evox
    $evox = new Evox();
    //call Evox Library , get data Commissions by period
    $result = $evox->get_commission_by_period();
    //set var    
    $obj_earn_total = $result->total_comissions;
    $obj_earn_disponible = $result->total_disponible;
    //get all rpay
    $obj_pay = $Pay->get_search_by_id($id);
    //set title    
    $title = lang('Global.retiro');
    //send
    $data = array(
      'title' => $title,
      'hour' => $hour,
      'obj_customer_bank' => $obj_customer_bank,
      'obj_customer' => $obj_customer,
      'obj_earn_total' => $obj_earn_total,
      'obj_earn_disponible' => $obj_earn_disponible,
      'obj_pay' => $obj_pay,
      'customer_pay' => $customer_pay,
      //'kyc' => $kyc,
      'allow' => $allow,
      'obj_earn_total' => $obj_earn_total,
      'obj_earn_disponible' => $obj_earn_disponible,
      'hour' => $hour,
      'cart_count' => $cart_count
    );
    return view('backoffice_new/pay', $data);
  }

  public function send_pin()
  {
    if ($this->request->isAJAX()) {
      $Customer = new CustomerModel();
      //get data post
      $obj_data = service('request')->getPost();
      //get data session
      $customer_id = $_SESSION['id'];
      $name = $obj_data['name'];
      $email = $obj_data['email'];

      //set pin randon 6 digit
      $rand = random_int(1, 999999);
      //send message
      $this->message($name, $email, $rand);
      //update customer pin
      $param = array(
        'pin' => $rand,
      );
      $result = $Customer->update($customer_id, $param);

      if (!is_null($result)) {
        $data['status'] = true;
        $data['message'] = SEND_PIN;
      } else {
        $data['status'] = false;
        $data['message'] = ERROR;
      }
      echo json_encode($data);
      exit();
    }
  }

  public function make_pay()
  {
    if ($this->request->isAJAX()) {
      //get data session
      $id = $_SESSION['id'];
      //get data post
      $obj_data = service('request')->getPost();
      $amount = $obj_data['amount'];
      $total_disponible = $obj_data['total_disponible'];
      $pin = $obj_data['pin'];
      $bank_name = $obj_data['bank_name'];
      $number = $obj_data['number'];
      $cci = $obj_data['cci'];
      //verify Pin
      $Customer = new CustomerModel();
      $result = $Customer->get_data_customer_pin($id, $pin);
      if ($result) {
        //verify amount
        if ($amount >= 100 && $amount <= $total_disponible) {
          $Pay = new PaysModel();
          //insert table pay
          $param = array(
            'customer_id' => $id,
            'amount' => $amount,
            'discount' => 0,
            'bank' => $bank_name,
            'number' => $number,
            'cci' => $cci,
            'total' => $amount,
            'active' => '1',
            'date' => date("Y-m-d H:i:s")
          );
          $pay_id = $Pay->insertar($param);

          //get current period
          $fortnightly_period = fortnightly_period();
          $first_month_day = $fortnightly_period['first_month_day'];
          //- 1 day (that the discount be in the previous period (set date of previous period))
          $date_period = restar_dias_date_con_fecha(1, $first_month_day);
          //insert commission table
          $Commissions = new CommissionsModel();
          $param2 = array(
            'customer_id' => $id,
            'bonus_id' => 8, //withdrawal
            'amount' => -$amount,
            'date' => $date_period,
            'date_shop' => date("Y-m-d H:i:s"),
            'active' => '2',
          );
          $commissions_id = $Commissions->insertar($param2);
          //insert table pay comission
          $Pay_commission = new Pay_commissionModel();
          $param_commissions = array(
            'pay_id' => $pay_id,
            'commissions_id' => $commissions_id,
            'date' => date("Y-m-d"),
            'active' => '1'
          );
          $result = $Pay_commission->insertar($param_commissions);
          $data['status'] = true;
          $data['message'] = PAYED;
        } else {
          $data['status'] = false;
          $data['message'] = INSUFFICIENT_BALANCE;
        }
      } else {
        $data['status'] = false;
        $data['message'] = WRONG_PIN;
      }
      echo json_encode($data);
      exit();
    }
  }


  public function message($name, $email_customer, $rand)
  {
    $mensaje = wordwrap("<html>
        <table width='750' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#f8f6f7' style='padding:15px 75px 15px'>
        <tbody><tr>
          <td align='center'>
            <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='background-color:#fff'>
              <tbody>
              <tr>
                <td>
                  <table width='600' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tbody><tr>
                      <td width='100%' style='padding:43px 0 38px;text-align:center'>
                        <table align='center' bgcolor='#ffffff' border='0' cellpadding='0' cellspacing='0'>
                          <tbody><tr style='text-align:center'> 
                            <td height='26'>
                              <img border='0' style='display:inline-block' src='https://alelifeglobal.com/assets/front/img/logo/logo.png' width='90' class='CToWUd'>
                            </td>
                              </tr>
                        </tbody>
                      </table>
                    </td>
                    </tr>
                    <tr>
                      <td style='font:20px Arial;padding:0 0 11px;color:#485360;text-align:center'>
                        Hola, $name                                 
                      </td>
                    </tr>
                    <tr>
                      <td style='color:#485360;font:400 28px/28px Arial;padding:0 7%;text-align:center'>
                        $rand
                      </td>
                    </tr>
                    <tr>
                      <td style='color:#485360;font:600 16px Arial;letter-spacing:-1px;padding:30px 0 22px;text-align:center'>
                        <p>Aquí tiene su PIN de cobro</p>
                      </td>
                    </tr>
        </tbody></table>
                    .</html>", 70, "\n", true);

    //set data to send email
    $email = \Config\Services::email();
    $email->setFrom("system@alelifeglobal.com", " PIN");
    $email->setTo($email_customer);
    $email->setSubject("PIN - [ALELIFE GLOBAL]");
    $email->setMessage($mensaje);
    $email->send();
    return true;
  }
}
