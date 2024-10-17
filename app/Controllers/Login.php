<?php

namespace App\Controllers;

use App\Models\MembershipsModel; 
use App\Models\CountriesModel;

class Login extends BaseController
{

    public function index()
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

        return view('login', $data);
    }

    public function validate_captcha()
    {
        define("SECRET_KEY", '6LequQIqAAAAAHHTMpgKlN2d2qKlZICveTw7YYb2');
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

    public function login_user()
    {
        //init session
        $session = session();
        $db = \Config\Database::connect();
        $request = \Config\Services::request();
        $username = $request->getPostGet('username');
        $password = $request->getPostGet('password');
        //set query
        $obj_customer = $db->query("select * from customers where username = '$username' or code = '$username'")->getRow();
        //verify data
        if ($obj_customer) {
            //verify pass
            $pass = $obj_customer->password;
            $pass = strval($pass);
            $password = strval($password);
            //validate pass
            $authenticatePassword = password_verify($password, $pass);
            //aunthenticate
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $obj_customer->id,
                    'name' => $obj_customer->name . " " . $obj_customer->lastname,
                    'active' => $obj_customer->active,
                    'email' => $obj_customer->email,
                    'code' => $obj_customer->code,
                    'username' => $obj_customer->username,
                    'isLoggedIn' => TRUE
                ];
                //begin session
                $session->set($ses_data);
                $data['status'] = true;
            } else {
                $session->setFlashdata('msg', WRONG_PASSWORD);
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        echo json_encode($data);
    }

    public function login_register()
    {
        $Paises = new CountriesModel();
        $Memberships = new MembershipsModel();
        //get all paises
        $obj_paises = $Paises->get_data();
        //get products footer
        $params = array(
        "select" => "*",
        "where" => "`contable` = '1' and `active` = '1'",
        "order" => "price ASC",
        "limit" => "12",
        );
        $obj_products = $Memberships->search($params);
        //send data
        $data = array(
        'obj_paises' => $obj_paises,
        'obj_products' => $obj_products
        );

        return view('login_register', $data);
    }
}
