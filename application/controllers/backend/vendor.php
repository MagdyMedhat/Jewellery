<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends CI_Controller
{

    var $data = array();

    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $login_url = base_url() . "backend/login";
        $role = $this->session->userdata("role");
        if($role != 2)
        {
            die("You need to <a href='$login_url'>login</a> to view this page !!");
        }

        $dashboard_url = base_url() . "backend/vendor";
        $this->data["breadcrumb"] = <<<EOD
		<li><a href="$dashboard_url" title="Home"><span id="bc-home"></span></a></li>
EOD;
    }

    public function index()
    {
        $this->data["users_count"] = $this->db->count_all_results("profiles");
        $this->data["deals_count"] = $this->db->count_all_results("deals");
        
        $username = $this->session->userdata('username');
        
        $sql = "SELECT id FROM vendors WHERE  username = '$username'";
        $result = $this->mylib->sqlGetSingleRow($sql);
        $sql = "SELECT COUNT(id) as count FROM coupons WHERE vendors_id = $result[id]";
        $result = $this->mylib->sqlGetSingleRow($sql);
        
        $this->data["coupons_count"] = $result['count'];
        $this->data["dashboard"] = "class='current'";

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/vendor/sidebar", $this->data);
        $this->parser->parse("backend/vendor/home", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function list_copouns($error = "")
    {
        if($error != "")
        {
            $this->data["error"] = <<<EOD
			<div class="alert error no-margin top">This coupon is already used.</div>
EOD;
        }
        else
        {
            $this->data["error"] = "";
        }

        $this->data["copouns"] = "class='current'";
        $list_copouns_url = base_url() . "backend/vendor/list_copouns";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_copouns_url" title="Copouns">Copouns</a></li>
EOD;

        $sql = "SELECT *, purchase.id as copoun_id FROM purchase JOIN profiles ON purchase.profile_id = profiles.id ORDER BY purchase.id DESC";
        $temp_copouns = $this->db->query($sql)->result_array();
        
        $this->data["list_copouns"] = array();
        foreach($temp_copouns as $copoun)
        {
            if($copoun['status'] == 'purchased')
                array_push($this->data["list_copouns"], $copoun);
        }
        
        foreach($this->data["list_copouns"] as &$record)
        {
            $time = $this->mylib->setTimeFormat($record['time']);
            $date = $this->mylib->setDateFormat($record['date']);
            
            $record['date'] = $time . " " . $date;
        }

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/vendor/sidebar", $this->data);
        $this->parser->parse("backend/vendor/copouns", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function deliver_coupon($coupon_id, $error = "")
    {
        if($error != "")
        {
            $this->data["error"] = <<<EOD
			<div class="alert error no-margin top">The coupon you are trying to redeem is not a correct one.</div>
EOD;
        }
        else
        {
            $this->data["error"] = "";
        }
        $this->data["copouns"] = "class='current'";

        $list_coupons_url = base_url() . "backend/vendor/list_copouns";
        $deliver_coupon_url = base_url() . "backend/vendor/deliver_coupon/$coupon_id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_coupons_url" title="Coupons">Coupons</a></li>
		<li class="no-hover"><a href="$deliver_coupon_url" title="Deliver Coupon">Deliver Coupon</a></li>
EOD;
        $this->data["id"] = $coupon_id;

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/vendor/sidebar", $this->data);
        $this->parser->parse("backend/vendor/deliver", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function deliver_coupon_done($coupon_id)
    {
        $coupon = $this->input->post('coupon');
        $sql = "SELECT * FROM purchase WHERE id = $coupon_id AND copoun = '$coupon'";
        $result = $this->mylib->sqlGetSingleRow($sql);
        
        if(!$result)
             redirect("backend/vendor/deliver_coupon/$coupon_id/error");
        else
        {
            $this->db->where('copoun',$coupon);
            $data['status'] = 'delivered';
            $this->db->update('purchase', $data);
            redirect("backend/vendor/list_copouns");
        }
    }
    
    public function deliver($error = null)
    {
        $this->data['error'] = $error;
        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/vendor/sidebar", $this->data);
        $this->load->view("backend/vendor/deliver");
        $this->parser->parse("backend/footer", $this->data);
    }
    
    

}

/* End of file vendor.php */
/* Location: ./application/controllers/backend/vendor.php */