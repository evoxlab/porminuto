<?php

namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\UnilevelsModel;
use App\Models\CommissionsModel;
use App\Models\InvoicesModel;
use App\Controllers\B_perfil;
use App\Controllers\B_carrera;

use Fluent\ShoppingCart\Facades\Cart;


class B_network extends BaseController
{   
    public function index()
    {
        //get count product shopping cart
        $cart_count = Cart::count();
        //get data session
        $id = $_SESSION['id'];
        $Unilevel =new UnilevelsModel();
        $Customer =new CustomerModel();
        //set var
        $obj_total_direct = 0;
        //the dates are being put, so as not to give errors
        $period = period();
        $Unilevel = new UnilevelsModel();
        //get partner level 2
        $obj_customer_n2 = $Unilevel->get_partners_by_level($id, $period['first_month_day'], $period['last_month_day']); 

        //total referred
        $obj_total_direct = count($obj_customer_n2);

        //get data customer
        $obj_customer = $Customer->get_data_customer_perfil($id);

        $params = array(
            "select" => "*",
            "join" => array('countries, `customers`.`country_id` = `countries`.`id`',
                            'unilevels, `unilevels`.`customer_id` = `customers`.`id`',
                            'ranges, `customers`.`range_id` = `ranges`.`id`'),
            "where" => "`customers`.`active` = '1' AND `unilevels`.`sponsor_id` = $id and countries.id_idioma = 7",
            "order" => "`unilevels`.`id` ASC"
        );
        $total_active = $Customer->total_records($params);
        //get data total
        $Commissions = new CommissionsModel();
        $obj_commission_total = $Commissions->get_total_commission($id);
        //set var total & available
        $obj_earn_total = $obj_commission_total->total_comissions;
        $obj_earn_disponible = $obj_commission_total->total_disponible;
        //set title
        $title = lang('Global.equipo');
        //send data
        $data = array(
            'title' => $title,
            'obj_earn_total' => $obj_earn_total,
            'obj_earn_disponible' => $obj_earn_disponible,
            'obj_customer' => $obj_customer,
            'total_active' => $total_active,
            'obj_total_direct' => $obj_total_direct,
            'obj_customer_n2' => $obj_customer_n2,
            'cart_count' => $cart_count
        );
        return view('backoffice_new/referred', $data);
    }

    public function unilevel()
    {
        //get count product shopping cart
        $cart_count = Cart::count();
        //get data session
        $id = $_SESSION['id'];
        //GET DATA URL
        $url = explode("/",uri_string());
        if(isset($url[2])){
            $customer_id = decrypt($url[2]);
        }else{
            $customer_id = $_SESSION['id'];
        } 
        //set var
        $direct_3 = null;
        $direct_4 = null;
        $obj_customer_n2 = null;
        $obj_customer_n3 = null;
        $obj_customer_n4 = null;
        //get period 
        $period  = fortnightly_period();
        //unilevel
        $Unilevel = new UnilevelsModel();
        $obj_customer = $Unilevel->get_data_by_customer($customer_id, $period['first_month_day'], $period['last_month_day']); 
        //set var point personal
        $point_personal = $obj_customer->point_personal;
        //get partner level 2
        $obj_customer_n2 = $Unilevel->get_partners_by_level($customer_id, $period['first_month_day'], $period['last_month_day']); 
        
        //total referred
        $obj_total_direct = count($obj_customer_n2);
        //get partner level 3
        if(count($obj_customer_n2) > 0){
            $customer_id_n2 = "";
                foreach ($obj_customer_n2 as $key => $value) {
                       $customer_id_n2 .= $value->customer_id2.",";
                }
                //DELETE LAST CARACTER ON STRING
                $customer_id_n2 = substr ($customer_id_n2, 0, strlen($customer_id_n2) - 1);
                if(!is_null($customer_id_n2) && $customer_id_n2 != ""){
                    //get data level 3
                    $obj_customer_n3 = $Unilevel->get_partners_in_level($customer_id_n2, $period['first_month_day'], $period['last_month_day']); 
                    $direct_3 = count($obj_customer_n3);
                    //GET CUSTOMER BY PARENTS_ID 4 LEVEL
                    if(count($obj_customer_n3) > 0){
                        $customer_id_n3 = "";
                        foreach ($obj_customer_n3 as $key => $value) {
                            $customer_id_n3 .= $value->customer_id2.",";
                        }
                        //DELETE LAST CARACTER ON STRING
                        $customer_id_n3 = substr ($customer_id_n3, 0, strlen($customer_id_n3) - 1);
                        //get data level 4
                        $obj_customer_n4 = $Unilevel->get_partners_in_level($customer_id_n3, $period['first_month_day'], $period['last_month_day']); 
                        $direct_4 = count($obj_customer_n4);
                    }
                }
           }
        //GET TOTAL REFERRED
        $obj_total_referidos = $Unilevel->get_total_partners($customer_id); 
        //get data total
        $Commissions = new CommissionsModel();
        $obj_commission_total = $Commissions->get_total_commission($id);
        //set var total & available
        $obj_earn_total = $obj_commission_total->total_comissions;
        $obj_earn_disponible = $obj_commission_total->total_disponible;
        //set title
        $title = UNILEVEL;
        //sen data
        $data = array(
            'title' => $title,
            'obj_earn_total' => $obj_earn_total,
            'obj_earn_disponible' => $obj_earn_disponible,
            'obj_total_referidos' => $obj_total_referidos,
            'obj_total_direct' => $obj_total_direct,
            'point_personal' => $point_personal,
            'direct_3' => $direct_3,
            'direct_4' => $direct_4,
            'obj_customer_n2' => $obj_customer_n2,
            'obj_customer_n3' => $obj_customer_n3,
            'obj_customer_n4' => $obj_customer_n4,
            'obj_customer' => $obj_customer,
            'cart_count' => $cart_count
        );
        return view('backoffice_new/unilevel', $data);
    }

    public function up(){
        //ACTIVE CUSTOMER NORMALY
        if ($this->request->isAJAX()) {
            //var
            $sponsor_id = null;
            //get data mehotd post
            $res = service('request')->getPost();
            $id = $res['id'];
            //query
            $Unilevels = new UnilevelsModel();
            $obj_unilevel = $Unilevels->get_sponsor_id_by_customer_id($id);
            if($obj_unilevel){
                $sponsor_id = $obj_unilevel->sponsor_id;
            }
            //verify
            if(!is_null($sponsor_id) && $sponsor_id != 0){
                $sponsor_id = encrypt($sponsor_id);
                $data['status'] = true;
                $data['url'] = site_url()."backoffice_new/unilevel/$sponsor_id";
            }else{
                $data['status'] = false;
            }
            echo json_encode($data); 
            exit();
        }
    }
}
