<?php

namespace App\Controllers;

use App\Models\InvoicesModel;
use App\Models\CommissionsModel;
use App\Models\MembershipsModel;
use App\Models\CustomerModel;
use App\Models\UnilevelsModel;
use App\Models\Range_customerModel;
use App\Models\CalificationModel;
use App\Models\PeriodModel;
use App\Controllers\D_activaciones;


class Crone extends BaseController
{

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        $session = \Config\Services::session();
        $language = \Config\Services::language();
        $language->setLocale($session->lang);
        helper('global');
    }

    //reconsumo inactivos   
    public function index()
    {
        $Customer = new CustomerModel();
        //get invoices yesterday 15th
        $obj_customer = $Customer->get_customer_active_all();
        //update table customer active = '0'
        foreach ($obj_customer as $key => $value) {
            //update customer
            $param = array(
                'range_id' => '1',
                '3x3' => '1',
                'active' => '0'
            );
            $Customer->update($value->id, $param);
        }
        echo "<script>alert('Reconsumo con éxito')</script>";
        die();
    }

    // bono auto    
    public function bono_auto()
    {
        $Customer = new CustomerModel();
        $RangeCustomer = new Range_customerModel();
        $Commissions = new CommissionsModel();
        //get firts and last day month before
        $year = date("Y");
        $month = date("m", strtotime("-1 month"));
        $first_month_day = first_month_day($month,$year);
        $last_month_day = last_month_day($month,$year);
        
        $Period = new PeriodModel();
        $period = $Period->get_last();
        $period_id = $period->id;
        
        // get customers by period
        $obj_range_customer = $RangeCustomer->get_all_data_by_period($first_month_day, $last_month_day);
        
        foreach ($obj_range_customer as $key => $value) {
            if ($value->active == 1) {
                $customer_id = $value->customer_id;
                $range = intval($value->max_range);
                $membership_id = intval($value->membership_id);
                //insert range customer by period
                $params_range = array(
                    'customer_id' => $customer_id,
                    'range_id' => $range,
                    'date' => date('Y-m-d'),
                    'period_id' => $period_id
                );

                $RangeCustomer->insert($params_range);

                $amount = 0;

                //range platino
                if ($range == 5 && $membership_id >= 4) $amount = 500;
                //range esmeralda
                if ($range == 6 && $membership_id >= 4) $amount = 750;
                //range diamante
                if ($range == 7 && $membership_id >= 4) $amount = 1000;
                //range diamante blanco
                if ($range == 8 && $membership_id >= 4) $amount = 1500;

                if ($amount != 0) {
                    $params_commission = array(
                        'customer_id' => $customer_id,
                        'level' => $key,
                        'invoice_id' => NULL,
                        'bonus_id' => 11,
                        'arrive_id' => $customer_id,
                        'date' => date("Y-m-d H:i:s"),
                        'amount' => $amount,
                        'active' => '1',
                        'created_at' => date("Y-m-d H:i:s")
                    );
        
                    $Commissions->insertar($params_commission);
                }

            }
        }

        echo "<script>alert('Bono Auto con éxito')</script>";
        die();
    }

    public function update_period() {
        //Do the beginning of each period from the 1st to the 16th of each month
        $Period = new PeriodModel();
        $year = date("y");
        $month = date("m");
        $day = date("d");

        switch ($month) {
            case "1":
                if($day == "1"){
                    $period = "01";
                    $begin = "$year-01-01";
                    $end = "$year-01-15";
                }else{
                    $period = "02";
                    $begin = "$year-01-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "2":
                if($day == "1"){
                    $period = "03";
                    $begin = "$year-02-01";
                    $end = "$year-02-15";
                }else{
                    $period = "04";
                    $begin = "$year-02-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "3":
                if($day == "1"){
                    $period = "05";
                    $begin = "$year-03-01";
                    $end = "$year-03-15";
                }else{
                    $period = "06";
                    $begin = "$year-03-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "4":
                if($day == "1"){
                    $period = "07";
                    $begin = "$year-04-01";
                    $end = "$year-04-15";
                }else{
                    $period = "08";
                    $begin = "$year-04-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "5":
                if($day == "1"){
                    $period = "09";
                    $begin = "$year-05-01";
                    $end = "$year-05-15";
                }else{
                    $period = "10";
                    $begin = "$year-05-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "6":
                if($day == "1"){
                    $period = "11";
                    $begin = "$year-06-01";
                    $end = "$year-06-15";
                }else{
                    $period = "12";
                    $begin = "$year-06-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "7":
                if($day == "1"){
                    $period = "13";
                    $begin = "$year-07-01";
                    $end = "$year-07-15";
                }else{
                    $period = "14";
                    $begin = "$year-07-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "8":
                if($day == "1"){
                    $period = "15";
                    $begin = "$year-08-01";
                    $end = "$year-08-15";
                }else{
                    $period = "16";
                    $begin = "$year-08-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "9":
                if($day == "1"){
                    $period = "17";
                    $begin = "$year-09-01";
                    $end = "$year-09-15";
                }else{
                    $period = "18";
                    $begin = "$year-09-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "10":
                if($day == "1"){
                    $period = "19";
                    $begin = "$year-10-01";
                    $end = "$year-10-15";
                }else{
                    $period = "20";
                    $begin = "$year-10-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "11":
                if($day == "1"){
                    $period = "21";
                    $begin = "$year-11-01";
                    $end = "$year-11-15";
                }else{
                    $period = "22";
                    $begin = "$year-11-16";
                    $end = last_month_day_actual();
                }    
                break;
            case "12":
                if($day == "1"){
                    $period = "23";
                    $begin = "$year-12-01";
                    $end = "$year-12-15";
                }else{
                    $period = "24";
                    $begin = "$year-12-16";
                    $end = last_month_day_actual();
                }    
                break;
        }
        //set code
        $code = $year."".$period;
        $obj_periodo = $Period->get_all_by_code($code);
        if($obj_periodo == 0){
            //enter new record in period table
            $param = array(
                'code' => $code,
                'begin' => $begin,
                'end' => $end,
                'created_at' => date("Y-m-d")
            ); 
            $Period->insertar($param);
        }
        echo "<script>alert('Periodo Actualizado')</script>";
        
    }

    public function sitemap()
    {
        $date = date("Y-m-d");
        //get products active
        $Memberships = new MembershipsModel();
        $obj_memberships = $Memberships->get_all_membership();
        $codigo = '<?xml version="1.0" encoding="UTF-8"?>
		<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
			xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
			';
        $codigo .= '<url>';
        $codigo .= '<loc>' . site_url() . '</loc>';
        $codigo .= '<lastmod>' . $date . 'T19:18:39+00:00</lastmod>';
        $codigo .= '<changefreq>weekly</changefreq>
				<priority>1.00</priority>';
        $codigo .= '</url>';
        $codigo .= '<url>';
        $codigo .= '<loc>' . site_url() . 'nosotros' . '</loc>';
        $codigo .= '<lastmod>' . $date . 'T19:18:39+00:00</lastmod>';
        $codigo .= '<changefreq>weekly</changefreq>
				<priority>0.80</priority>';
        $codigo .= '</url>';
        $codigo .= '<url>';
        $codigo .= '<loc>' . site_url() . 'productos' . '</loc>';
        $codigo .= '<lastmod>' . $date . 'T19:18:39+00:00</lastmod>';
        $codigo .= '<changefreq>weekly</changefreq>
				<priority>0.80</priority>';
        $codigo .= '</url>';
        foreach ($obj_memberships as $value) {
            $codigo .= '<url>';
            $codigo .= '<loc>' . site_url() . 'productos/' . $value->slug . '</loc>';
            $codigo .= '<lastmod>' . $date . 'T19:18:39+00:00</lastmod>';
            $codigo .= '<changefreq>weekly</changefreq>
                    <priority>0.60</priority>';
            $codigo .= '</url>';
        }
        $codigo .= '<url>';
        $codigo .= '<loc>' . site_url() . 'contacto' . '</loc>';
        $codigo .= '<lastmod>' . $date . 'T19:18:39+00:00</lastmod>';
        $codigo .= '<changefreq>weekly</changefreq>
				<priority>0.60</priority>';
        $codigo .= '</url>';
        $codigo .= '<url>';
        $codigo .= '<loc>' . site_url() . 'iniciar-sesion' . '</loc>';
        $codigo .= '<lastmod>' . $date . 'T19:18:39+00:00</lastmod>';
        $codigo .= '<changefreq>weekly</changefreq>
				<priority>0.50</priority>';
        $codigo .= '</url>';
        $codigo .= '<url>';
        $codigo .= '<loc>' . site_url() . 'preguntas-frecuentes' . '</loc>';
        $codigo .= '<lastmod>' . $date . 'T19:18:39+00:00</lastmod>';
        $codigo .= '<changefreq>weekly</changefreq>
				<priority>0.40</priority>';
        $codigo .= '</url>';
        $codigo .= '<url>';
        $codigo .= '<loc>' . site_url() . 'terminos-y-condiciones' . '</loc>';
        $codigo .= '<changefreq>weekly</changefreq>
				<priority>0.40</priority>';
        $codigo .= '</url>';
        $codigo .= '<url>';
        $codigo .= '<loc>' . site_url() . 'politica-de-privacidad' . '</loc>';
        $codigo .= '<changefreq>weekly</changefreq>
				<priority>0.40</priority>';
        $codigo .= '</url>';
        $codigo .= '</urlset>';
        $path = "sitemap.xml";
        $modo = "w+";

        if ($fp = fopen($path, $modo)) {
            fwrite($fp, $codigo);
            echo "<script>alert('SiteMap con Exito')</script>";
        } else {
            echo "<script>alert('Error')</script>";
        }
    }
}