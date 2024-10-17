<?php

namespace App\Controllers;

use App\Models\CommissionsModel;
use App\Models\InvoicesModel;
use App\Models\CustomerModel;
use App\Models\Invoice_detail_membershipModel;
use Dompdf\Dompdf;
use Fluent\ShoppingCart\Facades\Cart;
use App\Models\MembershipsModel;

class B_finanzas extends BaseController
{
    public function index()
    {
        //get fortnightly period
        $period = period();
        //get count product shopping cart
        $cart_count = Cart::count();
        //get data session
        $id = $_SESSION['id'];
        //get data planes
        $Commissions = new CommissionsModel();
        //get data GET
        $res = service('request')->getGet();
        if (isset($res['search'])) {
            $date = explode(" - ", $res['search']);
            //convert date database
            $date_begin = formato_fecha_db($date[0]);
            $date_end = formato_fecha_db($date[1]);
            //get comission by customer date       
            $obj_commissions = $Commissions->get_commissions_limit_30($id, $date_begin, $date_end);
        } else {
            //set var
            $date_begin = $period['first_month_day'];
            $date_end = $period['last_month_day'];
            //get comission by customer        
            $obj_commissions = $Commissions->get_commissions_limit_30($id, $period['first_month_day'], $period['last_month_day']); 
        }
        //get data customer
        $Customer = new CustomerModel();
        $obj_customer = $Customer->get_data_customer($id);
        //get total comissions
        $obj_total = $Commissions->global_info($id, $date_begin, $date_end);
        //set title
        $title = HISTORY;
        //send data
        $data = array(
            'title' => $title,
            'obj_commissions' => $obj_commissions,
            'date_begin' => $date_begin,
            'date_end' => $date_end,
            'obj_total' => $obj_total,
            'fortnightly_period' => $period,
            'obj_customer' => $obj_customer,
            'cart_count' => $cart_count
        );
        return view('backoffice_new/historial', $data);
    }

    public function facturas()
    {
        //get count product shopping cart
        $cart_count = Cart::count();
        //get data session
        $id = $_SESSION['id'];
        $Invoices = new InvoicesModel();
        //get total comissions
        $obj_invoices = $Invoices->get_invoices_by_id_membership_id($id);
        //get data customer
        $Customer = new CustomerModel();
        $obj_customer = $Customer->get_data_customer_perfil($id);
        //set title
        $title = lang('Global.compras');
        //send
        $data = array(
            'title' => $title,
            'obj_customer' => $obj_customer,
            'obj_invoices' => $obj_invoices,
            'cart_count' => $cart_count
        );
        return view('backoffice_new/invoice', $data);
    }

    public function facturas_detail($invoice_id = null)
    {
        //get count product shopping cart
        $cart_count = Cart::count();
        //get data session
        $id = $_SESSION['id'];
        //get data planes
        $Invoices = new InvoicesModel();
        //get total comissions
        $obj_invoices = $Invoices->invoices_by_id($id, $invoice_id);
        
        //get product detail
        $Invoice_detail_membership = new Invoice_detail_membershipModel();
        $obj_product_detail = $Invoice_detail_membership->get_invoices_by_id($invoice_id);
        //get data customer
        $Customer = new CustomerModel();
        $obj_customer = $Customer->get_data_customer_perfil($id);
        //set title
        $title = lang('Global.compras');
        $obj_membership = null;
        $membership_id = $obj_invoices->temporal_membership;
        if (isset($membership_id)) {
            //get membership+
            $Membership = new MembershipsModel();
            //set var membership
            $obj_membership = $Membership->get_membership_by_id($membership_id);
        }
        //render
        $data = array(
            'title' => $title,
            'obj_customer' => $obj_customer,
            'obj_invoices' => $obj_invoices,
            'obj_product_detail' => $obj_product_detail,
            'cart_count' => $cart_count,
            'obj_membership' => $obj_membership
        );
        return view('backoffice_new/invoice_details', $data);
    }

    public function export_pdf($invoice_id = null)
    {
        //get data session
        $id = $_SESSION['id'];
        //get data planes
        $Invoices = new InvoicesModel();
        //get total comissions
        $obj_invoices = $Invoices->invoices_by_id($id, $invoice_id);
        //get product detail
        $Invoice_detail_membership = new Invoice_detail_membershipModel();
        $obj_product_detail = $Invoice_detail_membership->get_invoices_by_id($invoice_id);
        $dompdf = new \Dompdf\Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $dompdf->setOptions($options);

        $obj_membership = null;
        $membership_id = $obj_invoices->temporal_membership;
        if (isset($membership_id)) {
            //get membership+
            $Membership = new MembershipsModel();
            //set var membership
            $obj_membership = $Membership->get_membership_by_id($membership_id);
        }

        // get customer data
        $Customer = new CustomerModel();
        $obj_customer = $Customer->get_data_customer_perfil($id);

        //send data
        $data = [
            'obj_invoices' => $obj_invoices,
            'obj_product_detail' => $obj_product_detail,
            'obj_membership' => $obj_membership,
            'obj_customer' => $obj_customer
        ];
        $dompdf->loadHTML(
            view("backoffice_new/pdf_view", $data)
        );
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
