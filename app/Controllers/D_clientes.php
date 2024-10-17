<?php

namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\Customer_bankModel;
use App\Models\CountriesModel;
use App\Models\RangesModel;
use App\Models\BankModel;
use App\Models\MembershipsModel;
use App\Models\UnilevelsModel;

class D_clientes extends BaseController
{   
    public function index()
    {
        //get data session
        $session_name = $_SESSION['first_name']." ".$_SESSION['last_name'];
        //get data invoices by customer
        $Customer = new CustomerModel();
        $obj_customer = $Customer->get_customer_by_kit();
        //send
        $data = array(
            'obj_customer' => $obj_customer,
            'session_name' => $session_name
        );
        return view('admin/clientes/list', $data);
    }
    
    public function load($id = false)
    {
        //get data session
        $session_name = $_SESSION['first_name']." ".$_SESSION['last_name'];
        //isset id
        $obj_sponsor = null;
        if ($id != ""){
            //get data customer
            $Customer = new CustomerModel();
            $obj_customer = $Customer->get_data_customer($id);
            //get data sponsor
            $obj_sponsor = $Customer->get_data_customer_sponsor($id);
        }
        //get paises
        $Paises = new CountriesModel();
        $obj_paises = $Paises->get_data();
        //get ranges
        $Ranges = new RangesModel();
        $obj_ranges = $Ranges->get_all_data();
        //get bank
        $Bank = new BankModel();
        $obj_bank = $Bank->get_all_active();
        //get membership
        $Memberships = new MembershipsModel();
        $obj_memberships = $Memberships->get_data_countable_adm('0');
        //send data
        $data = array(
            'obj_customer' => $obj_customer,
            'obj_sponsor' => $obj_sponsor,
            'obj_paises' => $obj_paises,
            'obj_bank' => $obj_bank,
            'obj_memberships' => $obj_memberships,
            'obj_ranges' => $obj_ranges,
            'session_name' => $session_name,
        );
        return view('admin/clientes/load',$data);
    }

    public function validacion(){
        //ACTIVE CUSTOMER NORMALY
        if ($this->request->isAJAX()) {
                //get data session
                $session = session();
                $id = $session->get('id');
                $Customer = new CustomerModel();
                $Customer_bank = new Customer_bankModel();
                //get data post
                $res = service('request')->getPost();
                $customer_id = $res['customer_id']; 
                $country = $res['country_id'];
                $unilevel_id = $res['unilevel_id'];
                $sponsor_id = $res['sponsor_id'];
                $password = $res['password'];
                $customer_bank_id = $res['customer_bank_id'];
                //update table customer
                $param = array(
                        'name' => $res['name'],
                        'lastname' => $res['lastname'],
                        'username' => $res['username'],
                        'range_id' => $res['range_id'],
                        'email' => $res['email'],
                        'membership_id' => $res['membership_id'],
                        'kyc' => $res['kyc'],
                        'dni' => $res['dni'],  
                        'pay' => $res['pay'],  
                        'phone' => $res['phone'],
                        'country_id' => $country,
                        'pay' => $res['pay'],
                        'active' => $res['active'],
                        );  
                $Customer->update($customer_id, $param);    
                //verify password blank
                if($password){
                    $param = array(
                        'password'=> password_hash($password, PASSWORD_DEFAULT)
                        );  
                    $Customer->update($customer_id, $param);    
                }
                //update bank
                if($customer_bank_id){
                    $param = array(
                        'bank_id' => $res['bank_id'],
                        'number' => $res['number'],
                        'cci' => $res['cci']
                        );  
                    $Customer_bank->update($customer_bank_id, $param);    
                }
                //update table unilevel
                $Unilevels = new UnilevelsModel();
                $param = array(
                    'sponsor_id' => $sponsor_id
                    );  
                $result = $Unilevels->update($unilevel_id, $param);    
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
            $Customer = new CustomerModel();
            //get data post
            $res = service('request')->getPost();
            $id = $res['id'];
            //verify                     
            if ($id != null) {
                $result = $Customer->eliminar($id);
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
