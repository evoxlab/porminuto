<?php

namespace App\Controllers;
use App\Models\InvoicesModel;
use App\Models\MembershipsModel;

class D_facturas extends BaseController
{   
    public function index()
    {
        //get data session
        $session_name = $_SESSION['first_name']." ".$_SESSION['last_name'];
        //get data invoices by customer
        $Invoices = new InvoicesModel();
        //get all of today's sales
        $obj_invoices = $Invoices->get_all_sales();
        //send
        $data = array(
            'obj_invoices' => $obj_invoices,
            'session_name' => $session_name
        );
        return view('admin/facturas/list', $data);
    }
    
    public function load($id = false)
    {
        //get data session
        $session_name = $_SESSION['first_name']." ".$_SESSION['last_name'];
        $Invoices = new InvoicesModel();
        $Membership = new MembershipsModel();
        //isset id
        if ($id != false){
            $obj_invoices = $Invoices->get_data_customer_kit($id);
        }
        //get kit
        $obj_kit = $Membership->get_all();
        //send data
        $data = array(
            'obj_invoices' => $obj_invoices,
            'obj_kit' => $obj_kit,
            'session_name' => $session_name,
        );
        return view('admin/facturas/load',$data);
    }

    public function validacion(){
        if ($this->request->isAJAX()) {
            $Invoices = new InvoicesModel();
            //get data session
            $session = session();
            $id = $session->get('id');
            //get data post
            $res = service('request')->getPost();
            $invoice_id = $res['invoice_id'];
            $active =  $res['active'];
            //update table invoices
            $param = array(
                'active' => $active
                );   
            //update table invoices
            $result = $Invoices->update($invoice_id, $param);
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

    public function eliminar()
    {
        //ACTIVE CUSTOMER NORMALY
        if ($this->request->isAJAX()) {
            $Invoices = new InvoicesModel();
            //get data post
            $res = service('request')->getPost();
            $id = $res['id'];
            //verify                     
            if ($id != null) {
                $result = $Invoices->eliminar($id);
                if (!is_null($result)) {
                    $data['status'] = true;
                    $data['message'] = DELETED;
                } else {
                    $data['status'] = false;
                    $data['message'] = ERROR;
                }
            } else {
                $data['status'] = false;
                $data['message'] = ERROR;
            }
            echo json_encode($data);
            exit();
        }
    }

}
