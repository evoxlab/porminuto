<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\CountriesModel;
use App\Models\UnilevelsModel;
use App\Models\MembershipsModel;

class Registro extends BaseController
{

  public function index($username)
  {
    $Customer = new CustomerModel();
    $Paises = new CountriesModel();
    $Memberships = new MembershipsModel();
    //set var
    $obj_customer = null;
    //verify
    if ($username != false) {
      $obj_customer = $Customer->get_customer_register($username);
    }
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
      'obj_customer' => $obj_customer,
      'obj_products' => $obj_products
    );
    //render
    return view('register', $data);
  }

  public function index_register()
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
    //render
    return view('register_public', $data);
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

  public function validacion()
  {
    $session = session();
    $Customer = new CustomerModel();
    $Unilevel = new UnilevelsModel();
    //get data post
    $res = service('request')->getPost();
    $username = $res['username'];
    $email = $res['email'];
    $dni = $res['dni'];
    $address = $res['address'];
    //co-distributor
    $co_name = $res['co_name'];

    //verify username free
    $result = $this->validate_username_register($username);
    if ($result == 1) {
      $data['status'] = false;
      $data['message'] = USER_TAKEN;
    } else {
      //verify dni
      $result = $this->validate_dni_register($dni);
      //verify email 
      $result_email = $this->validate_email_register($email);
      if ($result > 0) {
        $data['status'] = false;
        $data['message'] = DNI_TAKEN;
      } elseif ($result_email > 0) {
        $data['status'] = false;
        $data['message'] = EMAIL_TAKEN;
      } else {
        //get data post
        $sponsor_id = $res['sponsor_id'] ?? 1;
        $name = $res['name'];
        $lastname = $res['lastname'];
        $email = $res['email'];
        $pass = $res['password'];
        //INSERT TABLE CUSTOMER
        $param = array(
          'name' => $name,
          'lastname' => $res['lastname'],
          'phone' => $res['phone'],
          'range_id' => 1,
          'co_name' => $co_name,
          'address' => $address,
          'username' => $username,
          'email' => $email,
          'dni' => $dni,
          'date' => date("Y-m-d"),
          'membership_id' => 1,
          'password' => password_hash($pass, PASSWORD_DEFAULT),
          'country_id' => $res['country_id'],
          'active' => '0'
        );
        $customer_id = $Customer->insertar($param);

        //update the new customer code
        $param = array(
          'code' => $customer_id,
        );
        $Customer->update($customer_id, $param);

        // get ident by sponsor
        $obj_unilevel = $Unilevel->get_ident_by_customer($sponsor_id);
        $node = $obj_unilevel->node;
        //create new ident
        $new_node = $node . ",$sponsor_id";
        //insert table unilevel
        $param_unilevel = array(
          'customer_id' => $customer_id,
          'sponsor_id' => $sponsor_id,
          'node' => $new_node,
          'active' => '1'
        );
        $unilevel_id = $Unilevel->insertar($param_unilevel);
        if (!is_null($unilevel_id)) {
          //send message
          $this->message($name, $email);
          //start session
          $ses_data = [
            'id' => $customer_id,
            'name' => $name . " " . $lastname,
            'active' => 0,
            'email' => $email,
            'username' => $username,
            'isLoggedIn' => TRUE
          ];
          $session->set($ses_data);
          //send result
          $data['status'] = true;
          $data['message'] = WELCOME;
        } else {
          $data['status'] = false;
          $data['message'] = ERROR;
        }
      }
    }
    echo json_encode($data);
    exit();
  }

  public function validate_username_register($username)
  {
    //search username
    $db = \Config\Database::connect();
    $customer = $db->query("SELECT id FROM (`customers`) WHERE username = '$username'")->getNumRows();
    return $customer;
  }

  public function validate_email_register($email)
  {
    //search email
    $db = \Config\Database::connect();
    $customer = $db->query("SELECT id FROM (`customers`) WHERE email = '$email'")->getNumRows();
    return $customer;
  }

  public function validate_dni_register($dni)
  {
    //search email
    $db = \Config\Database::connect();
    $customer = $db->query("SELECT id FROM (`customers`) WHERE dni = '$dni'")->getNumRows();
    return $customer;
  }


  public function validate_username()
  {
    //SELECT ID FROM CUSTOMER
    $res = service('request')->getPost();
    $username = $res['username'];
    //search username
    $db = \Config\Database::connect();
    $customer = $db->query("SELECT id as total_customer FROM (`customers`) WHERE username = '$username'")->getNumRows();
    if ($customer == 1) {
      $data['status'] = true;
      $data['message'] = "No esta disponible!";
    } else {
      $data['status'] = false;
      $data['message'] = "Usuario Disponible!";
    }
    echo json_encode($data);
    exit();
  }

  public function message($name, $email_customer)
  {
    $mensaje = wordwrap("<html>
        <table width='750' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#f8f6f7' style='padding:15px 75px 15px'>
        <tbody><tr>
          <td align='center'>
            <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='background-color:#fff'>
              <tbody>
              <tr>
                <td>
                  <table width='600' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tbody><tr>
                      <td width='100%' style='padding:43px 0 38px;text-align:center'>
                        <table align='center' bgcolor='#ffffff' border='0' cellpadding='0' cellspacing='0'>

                        
                          <tbody><tr style='text-align:center'>
                              <td height='26'>
                                <img border='0' style='display:inline-block' src='https://alelifeglobal.com/assets/front/img/logo/logo.png' width='90' class='CToWUd'>
                              </td>
                              </tr>
                        </tbody>
                      </table>
                    </td>
                    </tr>
                    <tr>
                      <td style='font:20px Arial;padding:0 0 15px;color:#485360;text-align:center'>
                        Felicidades $name.                                
                      </td>
                    </tr>
                    <tr>
                      <td style='color:#485360;padding:0 0 15px;font:20px Arial;padding:0 7%;text-align:center'>
                        Su registro en ALELIFE GLOBAL se ha creado correctamente.
                      </td>
                    </tr>
                    <tr>
                      <td style='color:#485360;font:600 16px Arial;letter-spacing:-1px;padding:20px 0 22px;text-align:center'>
                        <p>Gracias por ser parte de nuestra familia.</p>
                      </td>
                    </tr>
                    <tr>
                        <td style='background-color:#19b5fe;color:#ffffff;padding:3%' align='center'>
                          Acceda a su oficina virtual a través del siguiente enlace.
                          <table style='margin:1% auto'>
                            <tbody>
                            <tr>
                              <td align='center'>
                              <a href='https://alelifeglobal.com' target='_blank' style='color:white !important;'>
                              <b>www.alelifeglobal.com</b>
                              </a>
                              </td>
                            </tr>
                          </tbody>
                          </table>
                        </td>
                      </tr>
      </tbody></table>
                    .</html>", 70, "\n", true);

    //set data to send email
    $email = \Config\Services::email();
    $email->setFrom("system@alelifeglobal.com", "Bienvenido");
    $email->setTo($email_customer);
    $email->setSubject("Registration created - [Alelife Global]");
    $email->setMessage($mensaje);
    $email->send();
    return true;
  }
}
