<?php

namespace App\Controllers;

use App\Models\MembershipsModel;

class D_planes extends BaseController
{
    public function index()
    {
        //get data session
        $session_name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
        //get data bonus
        $Membership = new MembershipsModel();
        $obj_membership = $Membership->get_all_product_stock();
        //send
        $data = array(
            'obj_membership' => $obj_membership,
            'session_name' => $session_name
        );
        return view('admin/planes/list', $data);
    }

    public function load($id = false)
    {
        //get data session
        $session_name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
        $obj_membership = null;
        //verify id
        if ($id != false) {
            //get data bonus by bonus
            $Membership = new MembershipsModel();
            //get products
            $params = array(
                "select" => "*",
                "where" => "id = $id"
            );
            $obj_membership = $Membership->get_search_row($params);
        }
        //send
        $data = array(
            'obj_membership' => $obj_membership,
            'session_name' => $session_name
        );
        return view('admin/planes/load', $data);
    }

    public function validacion()
    {
        //ACTIVE CUSTOMER NORMALY
        if ($this->request->isAJAX()) {
            //manipulación de imágenes
            $image = \Config\Services::image();
            //get data session
            $Membership = new MembershipsModel();
            //get data post
            $res = service('request')->getPost();
            $name = $res['name'];
            $slug = convert_slug($name);
            $membership_id = $res['membership_id'];
            $img = $this->request->getFile('img');
            $img_temp = $res['img_temp'];
            //verify
            if ($membership_id != "") {
                //upload img
                if ($img != "") {
                    //validation
                    $validationRule = [
                        'img' => [
                            'label' => 'Image File',
                            'rules' => 'uploaded[userfile]'
                                . '|is_image[userfile]'
                                . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                                . '|max_size[userfile,100]'
                                . '|max_dims[userfile,1024,768]',
                        ],
                    ];
                    if (!$this->validate($validationRule)) {
                        $data['status'] = false;
                    }
                    if ($img->isValid() && !$img->hasMoved()) {
                        $newName = $img->getRandomName();
                        $img->move('./membresias/' . $membership_id, $newName);
                        $image = \Config\Services::image()
                            ->withFile('./membresias/' . $membership_id . "/" . $newName)
                            ->resize(1500, 1125, false, 'height')
                            ->save('./membresias/' . $membership_id . "/" . $newName);
                    }
                } else {
                    $newName = $img_temp;
                }
                //update membership
                $param = array(
                    'name' => $name,
                    'slug' => $slug,
                    'contable' => $res['contable'],
                    'public_price' => $res['public_price'],
                    'price' => $res['price'],
                    'img' => $newName,
                    'unit_cost' => $res['unit_cost'],
                    'point' => $res['point'],
                    'sale' => $res['sale'],
                    'description' => $res['description'],
                    'active' => $res['active'],
                );
                $result = $Membership->update($membership_id, $param);
            } else {
                //insert table
                $param = array(
                    'name' => $name,
                    'slug' => $slug,
                    'contable' => $res['contable'],
                    'public_price' => $res['public_price'],
                    'price' => $res['price'],
                    'unit_cost' => $res['unit_cost'],
                    'point' => $res['point'],
                    'sale' => $res['sale'],
                    'description' => $res['description'],
                    'active' => $res['active'],
                );
                $id = $Membership->insertar($param);
                //set path
                $estructura = './membresias/' . $id;
                //create file
                if (!is_dir($estructura)) {
                    mkdir($estructura, 0777, true);
                }
                //upload imagen 1
                //validation
                $validationRule = [
                    'img' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[userfile]'
                            . '|is_image[userfile]'
                            . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[userfile,100]'
                            . '|max_dims[userfile,1024,768]',
                    ],
                ];

                if (!$this->validate($validationRule)) {
                    $data['status'] = false;
                }

                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move($estructura, $newName);
                    $image = \Config\Services::image()
                        ->withFile($estructura . "/" . $newName)
                        ->resize(1500, 1125, false, 'height')
                        ->save($estructura . "/" . $newName);
                } else {
                    $newName = null;
                }
                //update table courses
                $param = array(
                    'img' => $newName,
                );
                $result = $Membership->update($id, $param);
            }
            if (!is_null($result)) {
                $data['status'] = true;
                $data['message'] = SAVED;
            } else {
                $data['status'] = false;
                $data['message'] = ERROR;
            }
            echo json_encode($data);
            exit();
        }
    }

    public function eliminar()
    {
        //ACTIVE CUSTOMER NORMALY
        if ($this->request->isAJAX()) {
            $Membership = new MembershipsModel();
            //get data post
            $res = service('request')->getPost();
            $id = $res['id'];
            //verify                     
            if ($id != null) {
                $result = $Membership->eliminar($id);
                if (!is_null($result)) {
                    $data['status'] = true;
                    $data['message'] = DELETED;
                } else {
                    $data['status'] = false;
                    $data['message'] = ERROR;
                }
            } else {
                $data['status'] = false;
            }
            echo json_encode($data);
            exit();
        }
    }
}
