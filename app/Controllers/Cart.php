<?php

namespace App\Controllers;
use App\Models\MembershipsModel;
use App\Models\CustomerModel;
use App\Models\StoreModel;
use Fluent\ShoppingCart\Facades\Cart as Cart2;

class Cart extends BaseController

{
    // public cart actions
    public function index()
    {
        $session = \Config\Services::session();
        $cart = $session->get('cart') ? array_values(unserialize($session->get('cart'))) : [];

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
            "obj_products" => $obj_products,
            "cart" => $cart
        ];

        return view('cart', $data);
    }

    public function add_cart()
    {
        $session = session();
        //get data post
        $res = service('request')->getPost();
        $id = $res['membership_id'];
        $name = $res['name'];
        $price = $res['price'];
        $img = $res['img'];
        $qty = $res['qty'];
        //set array            
        $item = array(
            'id' => $id,
            'name' => $name,
            'photo' => $img,
            'price' => $price,
            'qty' => $qty
        );

        if (!$session->has('cart')) {
            $cart = array($item);
            $session->set('cart', serialize($cart));
        } else {
            $index = $this->exists($id);
            $cart = array_values(unserialize($session->get('cart')));
            if ($index == -1) {
                array_push($cart, $item);
                $session->set('cart', serialize($cart));
            } else {
                $cart[$index]['qty']++;
                $session->set('cart', serialize($cart));
            }
        }
        //verify
        $data['status'] = true;
        echo json_encode($data);
    }

    private function exists($id)
    {
        $session = session();
        $cart = array_values(unserialize($session->get('cart')));
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                return $i;
            }
        }
        return -1;
    }

    public function remove($id)
    {
        $index = $this->exists($id);
        $cart = array_values(unserialize($this->session->userdata('cart')));
        unset($cart[$index]);
        $this->session->set_userdata('cart', serialize($cart));
        redirect('cart');
    }

    private function total()
    {
        $items = array_values(unserialize($this->session->userdata('cart')));
        $s = 0;
        foreach ($items as $item) {
            $s += $item['price'] * $item['quantity'];
        }
        return $s;
    }



    public function add_cart_public()
    {
        $session = \Config\Services::session();
        $cart = $session->get('cart') ? unserialize($session->get('cart')) : [];

        $membership_id = $this->request->getPost('membership_id');
        $qty = (int) $this->request->getPost('qty');

        if (!isset($cart[$membership_id])) {
            $cart[$membership_id] = [
                'id' => $membership_id,
                'name' => $this->request->getPost('name'),
                'price' => (float) $this->request->getPost('price'),
                'img' => $this->request->getPost('img'),
                'qty' => $qty
            ];
        } else {
            $cart[$membership_id]['qty'] += $qty;
        }

        $session->set('cart', serialize($cart));
        return $this->response->setJSON(['cart' => array_values($cart)]);
    }

    public function update_quantity()
    {
        $session = \Config\Services::session();
        $cart = $session->get('cart') ? unserialize($session->get('cart')) : [];

        $membership_id = $this->request->getPost('membership_id');
        $quantityChange = (int) $this->request->getPost('quantityChange');

        if (isset($cart[$membership_id])) {
            $cart[$membership_id]['qty'] += $quantityChange;
            if ($cart[$membership_id]['qty'] <= 0) {
                unset($cart[$membership_id]);
            }
            $session->set('cart', serialize($cart));
        }

        return $this->response->setJSON(['cart' => array_values($cart)]);
    }

    public function remove_item()
    {
        $session = \Config\Services::session();
        $cart = $session->get('cart') ? unserialize($session->get('cart')) : [];

        $membership_id = $this->request->getPost('membership_id');

        if (isset($cart[$membership_id])) {
            unset($cart[$membership_id]);
            $session->set('cart', serialize($cart));
        }

        return $this->response->setJSON(['cart' => array_values($cart)]);
    }

    public function checkout()
    {
        $session = \Config\Services::session();
        $cart = $session->get('cart') ? array_values(unserialize($session->get('cart'))) : [];

        //get contable product
        $Memberships = new MembershipsModel();
        $Customer = new CustomerModel();
        //get products footer
        $params = array(
            "select" => "*",
            "where" => "`contable` = '1' and `active` = '1'",
            "order" => "price ASC",
            "limit" => "12",
        );
        $obj_products = $Memberships->search($params);

        $id = $_SESSION['id'] ?? 0;
        $obj_customer = $Customer->get_search_by_id($id);
        //get data store
        $Store = new StoreModel();
        $obj_store = $Store->get_all();
        $cart_count = Cart2::count();
        //get data shoppint cart
        $content = Cart2::content();
        $sub_total = Cart2::subtotal();
        $total = Cart2::total();

        //send
        $data = [
            "obj_products" => $obj_products,
            "cart" => $cart,
            "obj_customer" => $obj_customer,
            "obj_store" => $obj_store,
            "cart_count" => $cart_count,
            "content" => $content,
            "sub_total" => $sub_total,
            "total" => $total,
            "id" => $id
        ];

        return view('cart_checkout', $data);
    }

    public function page_method() 
    {
        $res = service('request')->getPost();
        $store_id = $res['store_id'];
        $phone = $res['phone'];
        $address = $res['address'];
        $delivery = $res['delivery'];
        
        $session = \Config\Services::session();
        $cart = $session->get('cart') ? array_values(unserialize($session->get('cart'))) : [];

        foreach ($cart as $key => $value) {
            Cart2::add([
                'id' => $value['id'],
                'name' => $value['name'],
                'qty' => $value['qty'],
                'contable' => 0,
                'price' => $value['price'],
                'options' => [
                    'contable' => 0,
                    'details' => "",
                ]
            ]);
        }

        //get contable product
        $Memberships = new MembershipsModel();
        $Customer = new CustomerModel();
        //get products footer
        $params = array(
            "select" => "*",
            "where" => "`contable` = '1' and `active` = '1'",
            "order" => "price ASC",
            "limit" => "12",
        );
        $obj_products = $Memberships->search($params);

        $id = $_SESSION['id'] ?? 0;
        $obj_customer = $Customer->get_search_by_id($id);

        $key_public = "4Vj8eK4rloUd272L48hsrarnUA";
        $merchand_id = "508029";
        $reference_code = "TestPayUMN_" . date('YmdHis');
        $sub_total = Cart2::subtotal();
        $total = str_replace(",", "", "$sub_total");
        $igv = round((($total / 1.18) * 0.18), 2);
        $sub_total = $total - $igv;
        $currency_code = "PEN";

        $ses_data = [
            'price' => $total,
            'phone' => $phone,
            'store_id' => $store_id,
            'address' => $address,
            'delivery' => $delivery,
            'active' => 1,
            'membership_id' => $obj_customer->membership_id,
        ];
        $session->set($ses_data);

        $signature = md5($key_public .'~'. $merchand_id .'~'. $reference_code .'~'. $total .'~'. $currency_code);

        //send
        $data = [
            "obj_products" => $obj_products,
            "cart" => $cart,
            "obj_customer" => $obj_customer,
            "id" => $id,
            "key_public" => $key_public,
            "merchand_id" => $merchand_id,
            "reference_code" => $reference_code,
            "total" => $total,
            "currency_code" => $currency_code,
            "signature" => $signature,
            "igv" => $igv,
            "sub_total" => $sub_total,
            "phone" => $phone,
            "address" => $address,
            "delivery" => $delivery,
            "store_id" => $store_id
        ];

        return view('page_method', $data);
    }
}
