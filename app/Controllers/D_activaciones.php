<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\InvoicesModel;
use App\Models\Invoice_detail_membershipModel;
use App\Models\CommissionsModel;
use App\Models\UnilevelsModel;
use App\Models\PointsModel;
use App\Models\MembershipsModel;


use function PHPSTORM_META\map;

class D_activaciones extends BaseController
{
    public function index()
    {
        $Invoices = new InvoicesModel();
        //get all of today's sales
        $obj_invoices = $Invoices->get_sales_pending_delivery();
        //get data session
        $session_name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
        //send
        $data = array(
            'obj_invoices' => $obj_invoices,
            'session_name' => $session_name
        );
        return view('admin/recojo/list', $data);
    }

    public function load($id = false)
    {
        //get data session
        $session_name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
        //isset id
        if ($id != "") {
            //get data invoice
            $Invoices = new InvoicesModel();
            $obj_invoices = $Invoices->get_data_pay_tienda_id($id);
            //get data invoice_detail
            $invoice_detail_membership = new Invoice_detail_membershipModel();
            $obj_invoice_detail = $invoice_detail_membership->get_invoices_by_id($id);

            $obj_membership = null;
            $membership_id = null;
            if (isset($obj_invoices->temporal_membership)) {
                $membership_id = $obj_invoices->temporal_membership;
            } elseif (isset($obj_invoices->membership_id)) {
                $membership_id = $obj_invoices->membership_id;
            }
            
            if (isset($membership_id)) {
                //get membership+
                $Membership = new MembershipsModel();
                //set var membership
                $obj_membership = $Membership->get_membership_by_id($membership_id);
            }
        }
        //send data
        $data = array(
            'obj_invoices' => $obj_invoices,
            'obj_invoice_detail' => $obj_invoice_detail,
            'session_name' => $session_name,
            'obj_membership' => $obj_membership
        );
        return view('admin/recojo/load', $data);
    }

    public function verificadas()
    {
        //get data session
        $session_name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
        $Invoices = new InvoicesModel();
        //get data invoices by customer
        $obj_invoices = $Invoices->get_data_kit_by_customer_completed();
        //send
        $data = array(
            'obj_invoices' => $obj_invoices,
            'session_name' => $session_name
        );
        return view('admin/recojo/list_verificada', $data);
    }

    public function active_delivery()
    {
        //ACTIVE CUSTOMER NORMALY
        if ($this->request->isAJAX()) {
            $Invoices = new InvoicesModel();
            $Customer = new CustomerModel();
            //get data session
            $id = $_SESSION['id'];
            //get data post
            $res = service('request')->getPost();
            $invoice_id = $res['id'];
            //calculate real point
            if ($invoice_id) {
                $param = array(
                    'delivery' => '0'
                );
                $result = $Invoices->update($invoice_id, $param);
                $data['status'] = true;
            } else {
                $data['status'] = false;
            }
            echo json_encode($data);
            exit();
        }
    }

    public function cancel()
    {
        //ACTIVE CUSTOMER NORMALY
        if ($this->request->isAJAX()) {
            $Invoices = new InvoicesModel();
            $res = service('request')->getPost();
            $invoice_id = $res['invoice_id'];
            $param = array(
                'active' => '3'
            );
            $result = $Invoices->update($invoice_id, $param);
            //validate
            if (!is_null($result)) {
                $data['status'] = true;
            } else {
                $data['status'] = false;
            }
            echo json_encode($data);
            exit();
        }
    }

    public function pay_liderazgo($customer_id, $new_range_id, $first_month_day, $last_month_day)
    {
        switch ($new_range_id) {
                //bronce
            case 2:
                $amount = 45;
                break;
                //plata
            case 3:
                $amount = 150;
                break;
                //oro
            case 4:
                $amount = 300;
                break;
                //zafiro
            case 5:
                $amount = 600;
                break;
                //rubi
            case 6:
                $amount = 1200;
                break;
                //diamante
            case 7:
                $amount = 3000;
                break;
                //doble diamante
            case 8:
                $amount = 6000;
                break;
                //triple diamante
            case 9:
                $amount = 12000;
                break;
                //diamante negro
            case 10:
                $amount = 24000;
                break;
                //diamante presidencial
            case 11:
                $amount = 36000;
                break;
            default:
                $amount = 0;
                break;
        }
        $today =  date('Y-m-d H:i:s');
        $date = date('Y-m-d', strtotime('-1 day'));
        $date = "$date 23:59:59";

        $Commissions = new CommissionsModel();
        $obj_bonus_lidership = $Commissions->get_comissions_bonus_lidership($customer_id, $first_month_day, $last_month_day);

        if($amount > 0){
            if($obj_bonus_lidership){
                if($amount > $obj_bonus_lidership->amount){
                    //delete
                    $result = $Commissions->eliminar($obj_bonus_lidership->id);
                    if($result){
                        //insert table commission
                        $param = array(
                            'customer_id' => $customer_id,
                            'bonus_id' => 7,
                            'arrive_id' => 0,
                            'amount' => $amount,
                            'date' => $date,
                            'active' => '1',
                            'created_at' => $today
                        );
                        $Commissions->insertar($param);
                    }
                }
            }else{
                //insert table commission
                $param = array(
                    'customer_id' => $customer_id,
                    'bonus_id' => 7,
                    'arrive_id' => 0,
                    'amount' => $amount,
                    'date' => $date,
                    'active' => '1',
                    'created_at' => $today
                );
                $Commissions->insertar($param);
            }
        }
    }

    public function message($customer_id)
    {
        //get data customer
        $db = \Config\Database::connect();
        $obj_customer = $db->query("SELECT name, email FROM `customers` where id = $customer_id")->getRow();
        $email_customer = $obj_customer->email;
        $name = $obj_customer->name;
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
                          <tbody>
                                <tr style='text-align:center'>
                                    <td height='26'>
                                        <img border='0' style='display:inline-block' src='https://azbel.com.es/assets/front/img/logo/logon.png' width='90' class='CToWUd'>
                                    </td>
                              </tr>
                        </tbody>
                      </table>
                    </td>
                    </tr>
                    <tr>
                      <td style='font:20px Arial;padding:0 0 11px;color:#485360;text-align:center'>
                            Felicidades, $name                                 
                      </td>
                    </tr>
                    <tr>
                      <td style='color:#485360;font:400 28px/28px Arial;padding:0 7%;text-align:center'>
                            Tu compra ha sido entregada exitosamente.
                      </td>
                    </tr>
                    <tr>
                      <td style='color:#2397d4;font:600 16px Arial;letter-spacing:-1px;padding:30px 0 22px;text-align:center'>
                        <p>Gracias por ser parte de nuestra familia.</p>
                      </td>
                    </tr>
      </tbody></table>
                    .</html>", 70, "\n", true);

        //set data to send email
        $email = \Config\Services::email();
        $email->setFrom("system@azbel.com.es", "Compra Entregada");
        $email->setTo($email_customer);
        $email->setSubject("Compra Entregada - [AZBEL]");
        $email->setMessage($mensaje);
        $email->send();
        return true;
    }
}
