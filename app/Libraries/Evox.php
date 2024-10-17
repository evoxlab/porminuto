<?php

namespace App\Libraries;

use App\Models\CommissionsModel;
use App\Models\CustomerModel;
use App\Models\InvoicesModel;
use App\Models\PointsModel;
use App\Models\Invoice_detail_membershipModel;
use App\Models\PeriodModel;

class Evox
{
    protected $mivariable;

    public function __construct() {}

    //obtain available amount
    public function get_commission_by_period()
    {
        //get data session
        $id = $_SESSION['id'];
        //load model commission
        $Commissions = new CommissionsModel();
        //get current period  data
        $dataPeriod = $this->get_period();
        $beginDate = $dataPeriod->begin;
        $endDate = $dataPeriod->end;

        $result = $Commissions->commission_by_period($id, $beginDate, $endDate);
        return $result;
    }

    //compensation plan
    public function pay_directo($customer_id, $invoice_id, $point, $sponsor_id, $active, $membership_id)
    {
        $db = \Config\Database::connect();
        //load model
        $Commissions = new CommissionsModel();
        $Customer = new CustomerModel();
        //set amount
        switch ($membership_id) {
            case 2:
                //Pack 400
                $level1 = 100;
                $level2 = 60;
                break;
            case 3:
                //Pack 800
                $level1 = 250;
                $level2 = 100;
                break;
            case 4:
                //Pack 1500
                $level1 = 600;
                $level2 = 100;
                break;
            default:
                //Pack 400
                $level1 = 100;
                $level2 = 60;
                break;
        }

        //INSERT COMMISSION TABLE
        if ($active == '1') {
            $param = array(
                'customer_id' => $sponsor_id,
                'invoice_id' => $invoice_id,
                'bonus_id' => 1,
                'level' => 1,
                'arrive_id' => $customer_id,
                'date' => date("Y-m-d H:i:s"),
                'amount' => $level1,
                'active' => '1',
                'created_at' => date("Y-m-d H:i:s")
            );
            $Commissions->insertar($param);
        }
        //get sponsor level 2
        $obj_tree = $db->query("SELECT unilevels.sponsor_id,unilevels.node, customers.active FROM unilevels  JOIN customers ON unilevels.sponsor_id = customers.id WHERE customer_id = $sponsor_id")->getRow();
        //get data sponsor
        if ($obj_tree) {
            //obtain the customer's membership type
            $obj_customer_sponsor = $Customer->get_search_by_id($obj_tree->sponsor_id);

            if ($obj_customer_sponsor->active == '1') {
                //INSERT COMMISSION TABLE
                $param = array(
                    'customer_id' => $obj_tree->sponsor_id,
                    'invoice_id' => $invoice_id,
                    'bonus_id' => 1,
                    'level' => 2,
                    'arrive_id' => $customer_id,
                    'date' => date("Y-m-d H:i:s"),
                    'amount' => $level2,
                    'active' => '1',
                    'created_at' => date("Y-m-d H:i:s")
                );
                $Commissions->insertar($param);
            }
        }
    }

    public function pay_propio_consumo($customer_id, $invoice_id)
    {
        $Commissions = new CommissionsModel();
        $Customer = new CustomerModel();
        //get membership_id by customer
        $obj_customer = $Customer->get_search_by_id($customer_id);

        switch ($obj_customer->membership_id) {
                //Pack 400
            case 2:
                $amount = 5;
                break;
                //Pack 800
            case 3:
                $amount = 7;
                break;
                //Pack 1500
            case 4:
                $amount = 10;
                break;
            default:
                $amount = 0;
                break;
        }

        //obtain the quantity of products purchased
        $Invoice_detail_membershipModel = new Invoice_detail_membershipModel();

        $params = array(
            "select" => "sum(invoice_detail_membership.qty) as total",
            "join" => array(
                'memberships, invoice_detail_membership.membership_id = memberships.id'
            ),
            "where" => "invoice_id = $invoice_id"
        );
        $obj_products = $Invoice_detail_membershipModel->get_search_row($params);
        //qty total
        $qty = $obj_products->total;

        $total_amount = $qty * $amount;

        //verify active customer
        if ($obj_customer->active == '1') {
            //insert commission
            $param = array(
                'customer_id' => $customer_id,
                'invoice_id' => $invoice_id,
                'bonus_id' => 6, //propio consumo
                'arrive_id' => $customer_id,
                'date' => date("Y-m-d H:i:s"),
                'amount' => $total_amount,
                'active' => '1',
                'created_at' => date("Y-m-d H:i:s")
            );
            $Commissions->insertar($param);
        }
    }

    public function pay_unilevel($customer_id, $node, $invoice_id, $point)
    {
        $Customer = new CustomerModel();
        $Commissions = new CommissionsModel();
        $Customer = new CustomerModel();
        //delete first character
        $node = substr($node, 1);
        //get active users by id
        $obj_customer = $Customer->get_customer_unilevel_in_id($node);
        //set date
        $Invoices = new InvoicesModel();
        //BOUCLE ULTI 10 LEVEL
        foreach ($obj_customer as $key => $value) {
            $key += 1;
            switch ($key) {
                    //level1 embasador , repurchase 122 pts
                case 1:
                    //earn 8.75%
                    $amount = $point * 0.0875;
                    //only low purchase 122
                    if ($value->active == '1') {
                        //insert commission
                        $param = array(
                            'customer_id' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    } else {
                        //insert compression commission 
                        $param = array(
                            'customer_standby' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    }
                    break;
                case 2:
                    //earn 7.5%%
                    $amount = $point * 0.075;
                    //only low purchase 122
                    if ($value->active == '1') {
                        //insert commission
                        $param = array(
                            'customer_id' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    } else {
                        //insert compression commission 
                        $param = array(
                            'customer_standby' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    }
                    break;
                case 3:
                    //earn 10%%
                    $amount = $point * 0.1;
                    //only low purchase 122
                    if ($value->active == '1') {
                        //insert commission
                        $param = array(
                            'customer_id' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    } else {
                        //insert compression commission 
                        $param = array(
                            'customer_standby' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    }
                    break;
                case 4:
                    //earn 7.5%%
                    $amount = $point * 0.075;
                    //only low purchase 122
                    if ($value->active == '1') {
                        //insert commission
                        $param = array(
                            'customer_id' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    } else {
                        //insert compression commission 
                        $param = array(
                            'customer_standby' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    }
                    break;
                case 5:
                    //earn 2.50%%
                    $amount = $point * 0.025;
                    //only low purchase 122
                    if ($value->active == '1') {
                        //insert commission
                        $param = array(
                            'customer_id' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    } else {
                        //insert compression commission 
                        $param = array(
                            'customer_standby' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    }
                    break;
                default:
                    //earn 1% volumen de ventas
                    $amount = $point * 0.01;
                    //only low purchase 122
                    if ($value->active == '1') {
                        //insert commission
                        $param = array(
                            'customer_id' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    } else {
                        //insert compression commission 
                        $param = array(
                            'customer_standby' => $value->id,
                            'level' => $key,
                            'invoice_id' => $invoice_id,
                            'bonus_id' => 5,
                            'arrive_id' => $customer_id,
                            'date' => date("Y-m-d H:i:s"),
                            'amount' => $amount,
                            'active' => '1',
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        $Commissions->insertar($param);
                    }
                    break;
            }
        }
    }

    public function add_points_unilevel($point, $customer_id, $invoice_id, $node)
    {
        $Points = new PointsModel();
        //delete first caracter
        $node = substr($node, 1);
        $array = explode(",", $node);
        //select customers
        foreach ($array as $key => $id) {
            //insert table point binary
            if ($id != 0 || $id != "") {
                //INSERT POINTS TABLE
                $param = array(
                    'customer_id' => $id,
                    'invoice_id' => $invoice_id,
                    'departure_id' => $customer_id,
                    'points' => $point,
                    'date' => date("Y-m-d"),
                    'active' => '1'
                );
                $points_id = $Points->insertar($param);
            }
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

        if ($amount > 0) {
            if ($obj_bonus_lidership) {
                if ($amount > $obj_bonus_lidership->amount) {
                    //delete
                    $result = $Commissions->eliminar($obj_bonus_lidership->id);
                    if ($result) {
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
            } else {
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

    //all point and active user
    public function active_customer($customer_id, $point, $membership_id, $phone)
    {
        $db = \Config\Database::connect();
        //load model commission
        $Invoices = new InvoicesModel();
        $Customer = new CustomerModel();

        $obj_customer = $db->query("SELECT id, membership_id FROM customers WHERE id = $customer_id")->getRow();
        $customer_membership = $obj_customer->membership_id;

        if ($membership_id == 2 || $membership_id == 3 || $membership_id == 4) {
            if ($membership_id > $customer_membership) {
                $param = array(
                    'membership_id' => $membership_id,
                    'phone' => $phone,
                    'active' => '1',
                );
            } else {
                $param = array(
                    'phone' => $phone,
                    'active' => '1',
                );
            }
            $Customer->update($customer_id, $param);
        } else {
            //get fortnightly period
            $period = period();
            $total_points = $Invoices->get_sum_shop($customer_id, $period['first_month_day'], $period['last_month_day']);
            //set point
            $point = $total_points->points + $point;
            //550 pts for active (5 product)
            if ($point >= 550) {
                if ($membership_id) {
                    if ($membership_id > $customer_membership) {
                        $param = array(
                            'membership_id' => $membership_id,
                            'phone' => $phone,
                            'active' => '1',
                        );
                    } else {
                        $param = array(
                            'phone' => $phone,
                            'active' => '1',
                        );
                    }
                }
                $Customer->update($customer_id, $param);
            }
        }
    }

    public function unilevel_dynamic_compression($customer_id, $point)
    {
        $Commissions = new CommissionsModel;
        $Customer = new CustomerModel;
        $Invoices = new InvoicesModel;
        //get fortnightly period
        //get fortnightly period
        $period = period();
        $total_points = $Invoices->get_sum_shop($customer_id, $period['first_month_day'], $period['last_month_day']);
        //set point
        $point = $total_points->points + $point;

        //400 pts for active
        if ($point >= 550) {
            //Check if I have stagnant commissions
            $obj_comisions_standby = $Commissions->get_comissions_standby($customer_id, $period['first_month_day'], $period['last_month_day']);
            foreach ($obj_comisions_standby as $value) {
                //update comissions, original sponsor
                $param = array(
                    'customer_id' => $customer_id,
                    'customer_standby' => null
                );
                $Commissions->update($value->id, $param);
            }
        }
    }

    public function available_balance($customer_id)
    {
        //load model commission
        $Commissions = new CommissionsModel();

        //get current period  data
        $dataPeriod = $this->get_period();
        $beginDate = $dataPeriod->begin;
        $endDAte = $dataPeriod->end;

        //get past period data
        $dataPastPeriod = $this->get_past_period($dataPeriod->id);
        $beginPast = $dataPastPeriod->begin;
        $endPast = $dataPastPeriod->end;

        //get data
        $total = $Commissions->commission_by_year($customer_id,  $beginDate, $endDAte, $beginPast, $endPast);
        return $total;
    }

    //obtain available amount
    public function get_period()
    {
        //load model commission
        $Period = new PeriodModel();

        $param = array(
            'select' => '*',
            'order' => 'id DESC'
        );

        //get data
        $data = $Period->get_search_row($param);

        return $data;
    }

    public function get_past_period($id = null)
    {
        //load model commission
        $Period = new PeriodModel();

        $param = array(
            'select' => '*',
            'where' => "id < $id",
            'order' => 'id DESC',
            'limit' => '1'
        );

        //get data
        $data = $Period->get_search_row($param);

        return $data;
    }

    public function get_point_current_period($customer_id)
    {
        $Customer = new CustomerModel();
        //get dat 1 -31
        
        //get current period  data
        $dataPeriod = $this->get_period();
        $beginDate = $dataPeriod->begin;
        $endDate = $dataPeriod->end;

        //get data points by customer
        //points are verified every 30 days
        $obj_customer = $Customer->get_data_customer_range($customer_id, $beginDate, $endDate);
        //get total point
        $point =  $obj_customer->total_point;
        //send data
        return $info = array(
                        'obj_customer' => $obj_customer,
                        'point' => $point,
                    );
    }
}
