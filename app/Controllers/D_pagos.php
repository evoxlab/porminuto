<?php

namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\PaysModel;

class D_pagos extends BaseController
{   
    public function index()
    {
        //get data session
        $session_name = $_SESSION['first_name']." ".$_SESSION['last_name'];
        //get data invoices by customer
        $Pay = new PaysModel();
        $obj_pay = $Pay->get_crud_pay();
        //send
        $data = array(
            'obj_pay' => $obj_pay,
            'session_name' => $session_name
        );
        return view('admin/pagos/list', $data);
    }
    
    public function load($id = false)
    {
        //get data session
        $session_name = $_SESSION['first_name']." ".$_SESSION['last_name'];
        //isset id
        if ($id != false){
            $Pay = new PaysModel();
            $obj_pays = $Pay->get_data_by_customer_id($id);
        }
        //send data
        $data = array(
            'obj_pays' => $obj_pays,
            'session_name' => $session_name,
        );
        return view('admin/pagos/load',$data);
    }

    public function validacion(){
        if ($this->request->isAJAX()) {
            $Pay = new PaysModel();
            //get data session
            $session = session();
            $id = $session->get('id');
            //get data post
            $res = service('request')->getPost();
            $pay_id = $res['pay_id'];
            $amount = $res['amount'];
            $descount = $res['descount'];
            $amount_total =  $res['amount_total'];
            $active =  $res['active'];
            //update table invoices
            if($pay_id != ""){
                $param = array(
                    'amount' => $amount,
                    'discount' => $descount,
                    'total' => $amount_total,
                    'active' => $active,  
                    );   
                //update table invoices
                $result = $Pay->update($pay_id, $param);
            }
            if(!is_null($result)){
                $data['status'] = true;
                $data['message'] = SAVED;
            }else{
                $data['status'] = false;
                $data['message'] = ERROR;
            }
            echo json_encode($data);   
            exit();
        }
    }
    
}
