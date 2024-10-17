<?php

namespace App\Controllers;

use App\Models\CommissionsModel;
use App\Models\CustomerModel;
use App\Models\RangesModel;
use App\Models\CalificationModel;
use App\Controllers\B_carrera;
use App\Libraries\Evox;
use Fluent\ShoppingCart\Facades\Cart;

class B_home extends BaseController
{
    public function index()
    {

        //call library Evox
        $evox = new Evox();

        $Commissions = new CommissionsModel();
        //get count product shopping cart
        $cart_count = Cart::count();
        //get data session
        $id = $_SESSION['id'];
        //get fortnightly period
        
        //get current period
        $dataPeriod = $evox->get_period();

        //get data point ranges
        $point = 0;
        $percent = 0;
        //get data customer
        $Customer = new CustomerModel();
        //get all row
        $obj_customer = $Customer->get_all_data($id);
        $total_team_active = $obj_customer->total_team_active;

        //call Evox Library , get data Commissions by period
        $result = $evox->get_commission_by_period();
        //set varibale
        $total_comissions = $result->total_comissions;
        $total_disponible = $result->total_disponible;
        $total_periodo = $result->total_periodo;
        $code_period = $result->code_period;
        
        //get commision
        $obj_commissions = $Commissions->get_commissions_limit_30($id, $dataPeriod->begin, $dataPeriod->end);
        $obj_commissions_matching = $Commissions->get_commissions_limit_30_matching($id , $dataPeriod->begin, $dataPeriod->end);
        //get range_id and next range
        $Ranges = new RangesModel();
        $obj_ranges = $Ranges->get_range_next($id);
        //get the full rating for the period
        
        //to obtain group points for the period    
        $info = $evox->get_point_current_period($id);
        $point =  $info['point'];

        $next_range_point = $obj_ranges->next_range_point?$obj_ranges->next_range_point:0;
        if($next_range_point){
            $percent = ($point / $next_range_point) * 100;
            if ($percent > 100) {
                $percent = 100;
            }
        }else{
            $percent = 100;
        }
        
        //get percent
        //set var team active range
        $title = "Panel";
        //set data view
        $data = array(
            'obj_customer' => $obj_customer,
            'obj_ranges' => $obj_ranges,
            'dataPeriod' => $dataPeriod,
            'total_comissions' => $total_comissions,
            'total_disponible' => $total_disponible,
            'total_periodo' => $total_periodo,
            'obj_commissions' => $obj_commissions,
            'code_period' => $code_period,
            'obj_commissions_matching' => $obj_commissions_matching,
            'point' => $point,
            'total_team_active' => $total_team_active,
            'percent' => $percent,
            'title' => $title,
            'cart_count' => $cart_count
        );
        return view('backoffice_new/home', $data);
    }

    public function logout()
    {
        $session = session();
        //$session->sess_destroy();
        $ses_data = [
            'id' => '',
            'name' => '',
            'email' => '',
            'isLoggedIn' => FALSE
        ];
        $session->set($ses_data);
        return redirect()->to('/iniciar-sesion');
    }
}
