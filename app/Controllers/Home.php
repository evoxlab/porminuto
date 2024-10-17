<?php

namespace App\Controllers;

use App\Models\MembershipsModel;
use App\Models\CommentsModel;

class Home extends BaseController
{
    public function index()
    {
        //template
        //https://demo.themeim.com/html/braine/index.html

        //get contable product
        $Memberships = new MembershipsModel();
        //get products
        $params = array(
            "select" => "*",
            "where" => "`contable` = '1' and `active` = '1'",
            "order" => "price ASC",
            "limit" => "12",
        );
        $obj_products = $Memberships->search($params);
        //send
        $data = [
          "obj_products" => $obj_products
        ];
        //view
        return view('home', $data);
    }

    public function about()
    {
        //get contable product
        $Memberships = new MembershipsModel();
        //get products footer
        $params = array(
            "select" => "*",
            "where" => "`contable` = '1' and `active` = '1'",
            "order" => "price ASC",
            "limit" => "12",
        );
        $obj_products = $Memberships->search($params);
        //send
        $data = [
            "obj_products" => $obj_products
        ];

        return view('about', $data);
    }

    public function products()
    {   
        //get contable products
        $Memberships = new MembershipsModel();
        //Check if a search exists
        $search = $this->request->getGet('search');

        if ($search !== null) {
            $params = array(
                "select" => "*",
                "where" => "name like '%$search%' and `active` = '1' and `contable` = '1'",
                "order" => "id DESC",
            );
            $obj_products = $Memberships->search($params);
        } else {
            $params = array(
                "select" => "*",
                "where" => "`active` = '1' and `contable` = '1'",
                "order" => "id DESC",
            );
            $obj_products = $Memberships->search($params);
        }

        $data = [
            "obj_products" => $obj_products,
            "search" => $search
        ];
        //view
        return view('product', $data);
    }

    public function product_detail($slug = null)
    {
        //get data Membership
        $Memberships = new MembershipsModel();
        //get product detail
        $params = array(
            "select" => "*",
            "where" => "slug = '$slug'",
        );
        $obj_product = $Memberships->get_search_row($params);
        //get product related
        $params = array(
            "select" => "*",
            "where" => "slug <> '$slug' and active = '1' and `contable` = '1'",
        );
        $data_related_products = $Memberships->search($params);
        //send
        $data = [
            "obj_product" => $obj_product,
            "data_related_products" => $data_related_products
        ];
        //view
        return view('product_detail', $data);
    }

    public function contact()
    {
        //get contable product
        $Memberships = new MembershipsModel();
        //get products footer
        $params = array(
            "select" => "*",
            "where" => "`contable` = '1' and `active` = '1'",
            "order" => "price ASC",
            "limit" => "12",
        );
        $obj_products = $Memberships->search($params);
        //send
        $data = [
            "obj_products" => $obj_products
        ];

        return view('contact', $data);
    }

    public function validate_captcha()
    {
        define("SECRET_KEY", '6Lcq3ZspAAAAAFiqoPbo368dc_XxMz6971uKQY_C');
        $token = $_POST['token'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => SECRET_KEY, 'response' => $token)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);

        if ($arrResponse["success"] == '1' && $arrResponse["score"] >= 0.5) {
            $data = array("success" => 1, "message" => "Token reCAPTCHA válido.");
        } else {
            $data = array("success" => 0, "message" => "Error en la verificación del reCAPTCHA.");
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function send_messages()
    {
        $Comments = new CommentsModel();
        //get data post
        $obj_comments = service('request')->getPost();
        //set param
        $param = [
            "name" => $obj_comments['name'],
            "email" => $obj_comments['email'],
            "phone" => $obj_comments['phone'],
            "subject" => $obj_comments['subject'],
            "comment" => $obj_comments['comment'],
            "date" => date("Y-m-d H:i:s"),
            "active" => '1',
            "created_at" => date("Y-m-d H:i:s")
        ];
        $result = $Comments->insertar($param);
        //verify
        if (!is_null($result)) {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }
        echo json_encode($data);
    }

    public function otras()
    {
        //get contable product
        $Memberships = new MembershipsModel();
        //get products footer
        $params = array(
            "select" => "*",
            "where" => "`contable` = '1' and `active` = '1'",
            "order" => "price ASC",
            "limit" => "12",
        );
        $obj_products = $Memberships->search($params);
        //send
        $data = [
            "obj_products" => $obj_products
        ];

        return view('404', $data);
    }

    public function validate_username()
    {
        if ($this->request->isAJAX()) {
            //SELECT ID FROM CUSTOMER
            $res = service('request')->getPost();
            $username = $res['username'];
            //search username
            $db = \Config\Database::connect();
            $customer = $db->query("SELECT count(customer_id) as total_customer FROM (`customer`) WHERE username = '$username'")->getResult();
            $result = $customer[0]->total_customer;
            if ($result > 0) {
                $data['message'] = "true";
                $data['print'] = "No esta disponible! <i class='fa fa-times-circle-o' aria-hidden='true'></i>";
            } else {
                $data['message'] = "false";
                $data['print'] = "Usuario Disponible! <i class='fa fa-check-square-o' aria-hidden='true'></i>";
            }
            echo json_encode($data);
            exit();
        }
    }

    public function terminos()
    {
        return view('term');
    }

    public function policy()
    {
        return view('policy');
    }
    public function faq()
    {
        return view('faq');
    }

    public function logout()
    {
        $session = session();
        //$session->sess_destroy();
        $ses_data = [
            'id' => '',
            'name' => '',
            'email' => '',
            'username' => '',
            'isLoggedIn' => FALSE
        ];
        $session->set($ses_data);
        return redirect()->to('/');
    }

    public function adm_logout()
    {
        $session = session();
        //$session->sess_destroy();
        $ses_data = [
            'id' => '',
            'name' => '',
            'email' => '',
            'username' => '',
            'isLoggedIn' => FALSE
        ];
        $session->set($ses_data);
        return redirect()->to('/admin');
    }
}
