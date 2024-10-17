<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\RangesModel;
use App\Models\UnilevelsModel;
use Fluent\ShoppingCart\Facades\Cart;

class B_carrera extends BaseController
{   
    public function index()
    { 
        //get count product shopping cart
        $cart_count = Cart::count();
        //get data session
        $id = $_SESSION['id'];
        //get data planes
        $Ranges = new RangesModel();
        
        //get total comissions
        $point = 0;
        $info = $this->get_point_current_period($id);
        $obj_customer = $info['obj_customer'];
        $point = $info['point'];
        $obj_range = $Ranges->get_all();
        //set data ranges
        $Ranges = new RangesModel();
        $obj_ranges_now = $Ranges->get_range_next($id);
        //set date period
        //get dat 1 -31
        $day = date("j");
        $year = date("Y");
        $month = date("m");
        if($day >= '1' && $day <= '15'){
            $first_month_day = first_month_day($month,$year);
            $last_month_day = "$year-$month-15";    
        }else{
            $first_month_day = "$year-$month-16" ;
            $last_month_day = last_month_day($month,$year);    
        }
        $Unilevel = new UnilevelsModel();
        $obj_customer_n2 = $Unilevel->get_partners_by_level($id, $first_month_day, $last_month_day); 
        //total referred
        //$obj_total_direct = count($obj_customer_n2);

        //get active line
        $Customer = new CustomerModel();
        $params = array(
            "select" => "*",
            "join" => array('countries, `customers`.`country_id` = `countries`.`id`',
                            'unilevels, `unilevels`.`customer_id` = `customers`.`id`',
                            'ranges, `customers`.`range_id` = `ranges`.`id`'),
            "where" => "`customers`.`active` = '1' AND `unilevels`.`sponsor_id` = $id and countries.id_idioma = 7",
            "order" => "`unilevels`.`id` ASC"
        );
        $total_active = $Customer->total_records($params);

        //set title
        $title = lang('Global.carrera');
        //send data        
        $data = array(
            'obj_range' => $obj_range,
            'obj_ranges_now' => $obj_ranges_now,
            //'obj_total_direct' => $obj_total_direct,
            'total_active' => $total_active,
            'title' => $title,
            'point' => $point,
            'obj_customer' => $obj_customer,
            'cart_count' => $cart_count,
        );
        return view('backoffice_new/carrera', $data);
    }
     
    
    public function get_point_current_period($customer_id)
    {
        $Customer = new CustomerModel();
        //get dat 1 -31
        $day = date("j");
        $year = date("Y");
        $month = date("m");
        if($day >= '1' && $day <= '15'){
            $first_month_day = first_month_day($month,$year);
            $last_month_day = "$year-$month-15";    
        }else{
            $first_month_day = "$year-$month-16" ;
            $last_month_day = last_month_day($month,$year);    
        }
        //get data points by customer
        //points are verified every 30 days
        $obj_customer = $Customer->get_data_customer_range($customer_id, $first_month_day, $last_month_day);
        //get total point
        $point =  $obj_customer->total_point;
        //send data
        return $info = array(
                        'obj_customer' => $obj_customer,
                        'point' => $point,
                    );
    }
}
