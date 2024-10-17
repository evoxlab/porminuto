<?php
namespace App\Models;
use CodeIgniter\Model;

class InvoicesModel extends Model{
    
    protected $table      = 'invoices';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id', 
                                'customer_id', 
                                'membership_id', 
                                'qty', 
                                'amount', 
                                'address', 
                                'phone', 
                                'details',  
                                'store_id',  
                                'period_id',  
                                'temporal_membership',  
                                'payment',  
                                'sub_total',  
                                'payment_options',  
                                'payment_options_id',
                                'transaction_id',  
                                'igv',  
                                'total',  
                                'points',  
                                'delivery',  
                                'delivery_destino',  
                                'img', 
                                'date', 
                                'cash', 
                                'yape', 
                                'card', 
                                'active'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    //begin model exteds

    public function get_search_row($data)
    {
        $builder = $this->db->table($this->table);
        if (isset($data["select"]) && $data["select"] != "") $builder->select($data["select"]);
        if (isset($data["where"]) && $data["where"] != "") $builder->where($data["where"]);
        if (isset($data["order"]) && $data["order"] != "") $builder->orderBy($data["order"]);
        if (isset($data["group"]) && $data["group"] != "") $builder->groupBy($data["group"]);
        if (isset($data["join"])) {
            if (count($data["join"]) > 0) {
                foreach ($data["join"] as $rowJoin) {
                    $split = explode(",", $rowJoin);
                    $builder->join($split[0], $split[1]);
                }
            }
        }
        $query = $builder->get();
        return $query->getRow();
    }

    public function search($data)
    {
        $builder = $this->db->table($this->table);
        if (isset($data["select"]) && $data["select"] != "") $builder->select($data["select"]);
        if (isset($data["where"]) && $data["where"] != "") $builder->where($data["where"]);
        if (isset($data["order"]) && $data["order"] != "") $builder->orderBy($data["order"]);
        if (isset($data["group"]) && $data["group"] != "") $builder->groupBy($data["group"]);
        if (isset($data["join"])) {
            if (count($data["join"]) > 0) {
                foreach ($data["join"] as $rowJoin) {
                    $split = explode(",", $rowJoin);
                    $builder->join($split[0], $split[1]);
                }
            }
        }
        if (isset($data["limit"]) && $data["limit"] != "") $builder->limit($data["limit"]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function total_records($data)
    {
        $builder = $this->db->table($this->table);
        if (isset($data["select"]) && $data["select"] != "") $builder->select($data["select"]);
        if (isset($data["where"]) && $data["where"] != "") $builder->where($data["where"]);
        if (isset($data["order"]) && $data["order"] != "") $builder->orderBy($data["order"]);
        if (isset($data["group"]) && $data["group"] != "") $builder->groupBy($data["group"]);
        if (isset($data["join"])) {
            if (count($data["join"]) > 0) {
                foreach ($data["join"] as $rowJoin) {
                    $split = explode(",", $rowJoin);
                    $builder->join($split[0], $split[1]);
                }
            }
        }
        $query = $builder->get();
        return $query->getNumRows();
    }

    public function search_data($data, $inicio, $num_reg)
    {
        $builder = $this->db->table($this->table);
        if (isset($data["select"]) && $data["select"] != "") $builder->select($data["select"]);
        if (isset($data["where"]) && $data["where"] != "") $builder->where($data["where"]);
        if (isset($data["order"]) && $data["order"] != "") $builder->orderBy($data["order"]);
        if (isset($data["group"]) && $data["group"] != "") $builder->groupBy($data["group"]);
        if (isset($data["join"])) {
            if (count($data["join"]) > 0) {
                foreach ($data["join"] as $rowJoin) {
                    $split = explode(",", $rowJoin);
                    $builder->join($split[0], $split[1]);
                }
            }
        }
        $query = $builder->get($num_reg, $inicio);
        return $query->getResult();
    }

    public function searchDataRows($data, $inicio, $num_reg)
    {
        $builder = $this->db->table($this->table);
        if (isset($data["select"]) && $data["select"] != "") {
            $builder->select($data["select"]);
        }

        if (isset($data["where"]) && $data["where"] != "") {
            $builder->where($data["where"]);
        }

        if (isset($data["order"]) && $data["order"] != "") {
            $builder->orderBy($data["order"]);
        }

        if (isset($data["group"]) && $data["group"] != "") {
            $builder->groupBy($data["group"]);
        }

        if (isset($data["join"])) {
            if (count($data["join"]) > 0) {
                foreach ($data["join"] as $rowJoin) {
                    $split = explode(",", $rowJoin);
                    $builder->join($split[0], $split[1]);
                }
            }
        }

        return $builder->get($num_reg, $inicio)->getRow();
    }
    // end extend model  



    public function get_all(){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`, `invoices`.`amount`, `invoices`.`img`,`invoices`.`days`, `customers`.`id` AS customer_id, `customers`.`username`, `customers`.`name`, `customers`.`lastname`, `invoices`.`active` 
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }

    public function get_by_id($id){
        $obj_result =  $this->db->query("SELECT * FROM (`invoices`) WHERE id = $id");
        return $obj_result->getRow();
    }

    public function get_invoices_by_id_membership_id($id){
        $obj_result =  $this->db->query("SELECT invoices.id,invoices.date,invoices.amount,invoices.qty,invoices.created_at, invoices.active
                                        FROM invoices 
                                        WHERE customer_id = $id 
                                        ORDER BY invoices.id DESC");
        return $obj_result->getResult();
    }

    public function get_sum_shop($id, $date_begin, $date_end){
        $obj_result =  $this->db->query("SELECT SUM(invoices.amount) AS total, SUM(invoices.points) AS points
                                        FROM invoices 
                                        WHERE invoices.date >= '$date_begin' AND invoices.date <= '$date_end' and invoices.active = '2' AND customer_id = $id");
        return $obj_result->getRow();
    }

    
    public function get_customers_bought($yesterday, $today){
        $obj_result =  $this->db->query("SELECT customer_id FROM invoices 
                                        JOIN customers ON customers.id = invoices.customer_id
                                        WHERE invoices.date >= '$yesterday' AND invoices.active = '2'");
        return $obj_result->getResult();
    }
    
    public function get_monthly_shopping_points($customer_id, $first_day, $last_day){
        $obj_result =  $this->db->query("SELECT SUM(points) as amount,
                                        (SELECT COUNT(*) FROM unilevels JOIN customers ON unilevels.customer_id = customers.id WHERE unilevels.sponsor_id = $customer_id AND customers.active = '1') total_referred 
                                        FROM invoices
                                        WHERE customer_id = $customer_id AND invoices.date >= '$first_day 00:00:00' AND  invoices.date <= '$last_day 23:59:59' AND invoices.active = '2'");
        return $obj_result->getRow();
    }

    public function get_invoice_pending(){
        $obj_result =  $this->db->query("SELECT invoices.id,invoices.customer_id,invoices.date,invoices.date_pay,invoices.earn,memberships.price, memberships.name, invoices.active, invoices.earn, invoices.days 
                                        FROM invoices JOIN memberships ON invoices.membership_id = memberships.id
                                        WHERE invoices.active = '1'
                                        ORDER BY invoices.id DESC");
        return $obj_result->getResult();
    }

    public function invoices_by_id($id, $invoice_id){
        $obj_result =  $this->db->query("SELECT invoices.id,invoices.date,invoices.amount,invoices.points, invoices.payment,invoices.sub_total,invoices.igv,invoices.total,invoices.qty,invoices.created_at, store.id as store_id, store.name as store_name, invoices.active, invoices.temporal_membership 
                                        FROM invoices 
                                        JOIN store ON invoices.store_id = store.id
                                        WHERE customer_id = $id AND invoices.id = $invoice_id");
        return $obj_result->getRow();
    }

    public function invoices_id($invoice_id){
        $obj_result =  $this->db->query("SELECT invoices.id,invoices.date,invoices.amount,invoices.points, invoices.payment,invoices.sub_total,invoices.igv,invoices.total,invoices.qty,invoices.created_at, store.id as store_id, store.name as store_name, invoices.active, invoices.temporal_membership 
                                        FROM invoices 
                                        JOIN store ON invoices.store_id = store.id
                                        WHERE invoices.id = $invoice_id");
        return $obj_result->getRow();
    }
    
    public function get_total_amount_pending(){
        $obj_result =  $this->db->query("SELECT sum(amount) as total from invoices where delivery = '1'");
        return $obj_result->getRow();
    }    

    public function get_data_pay_tienda(){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`, `store`.`name` as store_name, `invoices`.`amount`,`invoices`.`qty`, `invoices`.`payment`, `invoices`.`delivery`, `invoices`.`phone`, `invoices`.`details`,`invoices`.`address`,`invoices`.`img`, `period`.`code`,`period`.`begin`,`period`.`end`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        JOIN `period` ON `invoices`.`period_id` = `period`.`id` 
                                        WHERE invoices.active = '1' and invoices.payment = '3'
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }    

    public function get_data_kit_by_customer_pending(){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, invoices.delivery, invoices.payment ,`invoices`.`date`,`invoices`.`amount`,`invoices`.`qty`, `invoices`.`phone`, `invoices`.`details`,`invoices`.`address`,`invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        WHERE invoices.delivery = '1' 
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }
        
    public function get_data_pay_tienda_2(){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`, `store`.`name` as store_name, `invoices`.`amount`,`invoices`.`qty`, `invoices`.`payment`, `invoices`.`delivery`,`period`.`code`,`period`.`begin`,`period`.`end`, `invoices`.`phone`, `invoices`.`details`,`invoices`.`address`,`invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        JOIN `period` ON `invoices`.`period_id` = `period`.`id` 
                                        WHERE invoices.active = '2' and invoices.payment = '3'
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }    

    public function get_data_pay_tienda_id($id){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`,`invoices`.`points`,`invoices`.`payment_options`,`invoices`.`sub_total`, `invoices`.`amount`, `invoices`.`igv`, `invoices`.`temporal_membership`, `period`.`code`,`period`.`begin`,`period`.`end`, `store`.`name` as store_name, `store`.`id` as store_id, `invoices`.`amount`,`invoices`.`qty`, `invoices`.`payment`, `invoices`.`delivery`, `invoices`.`phone`, `invoices`.`details`,`invoices`.`address`,`invoices`.`cash`,`invoices`.`yape`,`invoices`.`card`,`invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `customers`.`phone`, `invoices`.`active`, `invoices`.`membership_id`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        JOIN `period` ON `invoices`.`period_id` = `period`.`id` 
                                        WHERE `invoices`.`id` = $id
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getRow();
    }    

    public function get_data_kit_by_customer_completed(){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`,`invoices`.`amount`, `store`.`name` as store_name, `invoices`.`qty`, `invoices`.`payment`, `invoices`.`delivery` , `invoices`.`phone`, `invoices`.`details`,`invoices`.`address`, `invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active` 
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        WHERE invoices.delivery = '0' 
                                        ORDER BY `invoices`.`id` DESC
                                        LIMIT 100");
        return $obj_result->getResult();
    }    

    public function get_data_customer_kit($id){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`, `invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`lastname`, `memberships`.`price`, `memberships`.`id` AS kit_id, `invoices`.`active` 
                                        FROM (`invoices`) 
                                        JOIN `memberships` ON `invoices`.`membership_id` = `memberships`.`id` 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        WHERE `invoices`.`id` = $id");
        return $obj_result->getResult();
    }    

    
    public function get_all_sales_today($today){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`, `invoices`.points,  `store`.`name` as store_name, `invoices`.`amount`,`invoices`.`qty`, `invoices`.`payment`, `invoices`.`delivery`, `invoices`.`phone`, `invoices`.`details`, `period`.`code`,`period`.`begin`,`period`.`end`,`invoices`.`address`,`invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        JOIN `period` ON `invoices`.`period_id` = `period`.`id` 
                                        WHERE `invoices`.date >= '$today' AND invoices.active = '2'
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }    

    public function get_all_sales(){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`, `invoices`.points,  `store`.`name` as store_name, `invoices`.`amount`,`invoices`.`qty`, `invoices`.`payment`, `invoices`.`delivery`, `invoices`.`phone`, `invoices`.`details`, `period`.`code`,`period`.`begin`,`period`.`end`,`invoices`.`address`,`invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        JOIN `period` ON `invoices`.`period_id` = `period`.`id` 
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }    

    public function get_sales_pending_delivery(){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`,`invoices`.`delivery`, `invoices`.`date`, `store`.`name` as store_name, `invoices`.`amount`,`invoices`.`qty`, `invoices`.`payment`, `invoices`.`delivery`, `invoices`.`phone`, `invoices`.`details`,`invoices`.`address`,`invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        WHERE invoices.delivery = '1' AND invoices.active = '2'
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }  
    
    public function get_all_sales_today_where($where){
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`points`, `invoices`.`date`, `store`.`name` as store_name, `invoices`.`amount`,`invoices`.`qty`, `invoices`.`payment`, `invoices`.`delivery`, `invoices`.`phone`, `invoices`.`details`,`period`.`code`,`period`.`begin`,`period`.`end`,`invoices`.`address`,`invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        JOIN `period` ON `invoices`.`period_id` = `period`.`id` 
                                        WHERE $where
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }

    public function get_data_by_export($where){     
        $obj_result =  $this->db->query("SELECT `invoices`.`id`, `invoices`.`date`, `store`.`name` as store_name, `invoices`.`amount`,`invoices`.`qty`, `invoices`.`payment`, `invoices`.`payment_options`, `invoices`.`delivery`, `invoices`.`phone`, `invoices`.`details`,`period`.`code`,`period`.`begin`,`period`.`end`,`invoices`.`address`,`invoices`.`img`, `customers`.`id` as customer_id, `customers`.`username`, `customers`.`name`, `customers`.`email`,`customers`.`lastname`, `invoices`.`active`
                                        FROM (`invoices`) 
                                        JOIN `customers` ON `invoices`.`customer_id` = `customers`.`id` 
                                        JOIN `store` ON `invoices`.`store_id` = `store`.`id` 
                                        JOIN `period` ON `invoices`.`period_id` = `period`.`id` 
                                        WHERE $where
                                        ORDER BY `invoices`.`id` DESC");
        return $obj_result->getResult();
    }    

    public function insertar($data){
        $obj_comments = $this->db->table($this->table);
        $obj_comments->insert($data);
        return $this->db->insertId();
    }

    public function eliminar($id){
        return $this->db->query("DELETE FROM $this->table WHERE id = $id");
    }
}