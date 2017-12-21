<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{

    var $data = array();
    var $role = 0;

    function __construct()
    {
        parent::__construct();
        $this->role = $this->session->userdata("role");

        $this->data["dashboard"] = "";
        $this->data["admins"] = "";
        $this->data["vendors"] = "";
        $this->data["users"] = "";
        $this->data["categories"] = "";
        $this->data["cities"] = "";
        $this->data["locations"] = "";
        $this->data["copouns"] = "";
        $this->data["deals"] = "";

        $dashboard_url = base_url() . "backend/admin";
        $this->data["breadcrumb"] = <<<EOD
		<li><a href="$dashboard_url" title="Home"><span id="bc-home"></span></a></li>
EOD;
    }

    function _remap($method)
    {
        if($this->role == 1)
        {
            call_user_func_array(array(&$this, $method), array_slice($this->uri->rsegments, 2));
        }
        else
        {
            $this->load->view("backend/401");
        }
    }

    public function index()
    {
        $this->data["admins_count"] = $this->db->count_all_results("admins");
        $this->data["categories_count"] = $this->db->count_all_results("categories");
        $this->data["cities_count"] = $this->db->count_all_results("cities");
        $this->data["users_count"] = $this->db->count_all_results("profiles");
        $this->data["deals_count"] = $this->db->count_all_results("deals");
        $this->data["coupons_count"] = $this->db->count_all_results("coupons");
        $this->data["vendors_count"] = $this->db->count_all_results("vendors");

        $this->data["dashboard"] = "class='current'";

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/home", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function list_admins()
    {
        $this->data["admins"] = "class='current'";
        $list_admins_url = base_url() . "backend/admin/list_admins";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_admins_url" title="Admins">Admins</a></li>
EOD;

        $this->data["list_admins"] = $this->db->get("admins")->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/list/admins", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function list_vendors()
    {
        $this->data["vendors"] = "class='current'";
        $list_vendors_url = base_url() . "backend/admin/list_vendors";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_vendors_url" title="Vendors">Vendors</a></li>
EOD;

        $this->data["list_vendors"] = $this->db->get("vendors")->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/list/vendors", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function list_users()
    {
        $this->data["users"] = "class='current'";
        $list_users_url = base_url() . "backend/admin/list_users";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_users_url" title="Users">Users</a></li>
EOD;

        $this->data["list_users"] = $this->db->get("profiles")->result_array();

        for($i = 0; $i < count($this->data["list_users"]); $i++)
        {
            $cities = $this->db->where("id", $this->data["list_users"][$i]["cities_id"])->get("cities")->result_array();
            $this->data["list_users"][$i]["city_name"] = $cities[0]["name"];
        }

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/list/users", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function list_categories()
    {
        $this->data["categories"] = "class='current'";
        $list_categories_url = base_url() . "backend/admin/list_categories";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_categories_url" title="Categories">Categories</a></li>
EOD;

        $this->data["list_categories"] = $this->db->get("categories")->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/list/categories", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function list_cities()
    {
        $this->data["cities"] = "class='current'";
        $list_cities_url = base_url() . "backend/admin/list_cities";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_cities_url" title="Cities">Cities</a></li>
EOD;

        $this->data["list_cities"] = $this->db->get("cities")->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/list/cities", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function list_locations()
    {
        $this->data["locations"] = "class='current'";
        $list_locations_url = base_url() . "backend/admin/list_locations";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_locations_url" title="Locations">Locations</a></li>
EOD;
        $sql = "select locations.id, locations.title , vendors.title as vendor_name,
		cities.name as city_name from locations join (cities,vendors) on 
		vendors.id = locations.vendors_id and
		cities.id = locations.cities_id";
        $this->data["list_locations"] = $this->db->query($sql)->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/list/locations", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function list_deals()
    {
        $this->data["deals"] = "class='current'";
        $list_deals_url = base_url() . "backend/admin/list_deals";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_deals_url" title="Deals">Deals</a></li>
EOD;

        $this->data["list_deals"] = $this->db->get("deals")->result_array();

        for($i = 0; $i < count($this->data["list_deals"]); $i++)
        {
            $deal = $this->data["list_deals"][$i];
            $this->data["list_deals"][$i]["price_after"] = $deal["price"] - (($deal["discount"] * $deal["price"]) / 100);
            $this->data["list_deals"][$i]["discount"] .= "%";
            
            if($deal["featured"] == "1")
            {
                $this->data["list_deals"][$i]["featured_image"] = base_url() . "backend_includes/img/icons/packs/fugue/16x16/status.png";
            }
            else
            {
                $this->data["list_deals"][$i]["featured_image"] = base_url() . "backend_includes/img/icons/packs/fugue/16x16/status-busy.png";
            }
        }
        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/list/deals", $this->data);
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
        $list_copouns_url = base_url() . "backend/admin/list_copouns";
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
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/list/copouns", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function add_admin()
    {
        $this->data["admins"] = "class='current'";
        $list_admins_url = base_url() . "backend/admin/list_admins";
        $add_admin_url = base_url() . "backend/admin/add_admin";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_admins_url" title="Admins">Admins</a></li>
		<li class="no-hover"><a href="$add_admin_url" title="Add Admin">Add Admin</a></li>
EOD;



        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/add/admins", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function add_admin_done()
    {
        $this->db->insert("admins", $_POST);
        redirect("backend/admin/list_admins");
    }

    public function add_vendor()
    {
        $this->data["vendors"] = "class='current'";
        $list_vendors_url = base_url() . "backend/admin/list_vendors";
        $add_vendor_url = base_url() . "backend/admin/add_vendor";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_vendors_url" title="Vendors">Vendors</a></li>
		<li class="no-hover"><a href="$add_vendor_url" title="Add Vendor">Add Vendor</a></li>
EOD;



        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/add/vendors", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function add_vendor_done()
    {
        $_POST["secretkey"] = $this->helpers->GenerateRandomString();

        $folder = $this->helpers->GenerateRandomString(20);
        mkdir("./uploads/vendors_logos/" . $folder, 0777);
        $config['upload_path'] = './uploads/vendors_logos/' . $folder . '/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';
        $this->load->library('upload', $config);
        if($this->upload->do_upload("image"))
        {
            $image_data = $this->upload->data();
            $image = $folder . '/' . $image_data["file_name"];
            $_POST["logo"] = $image;
        }

        $this->db->insert("vendors", $_POST);
        redirect("backend/admin/list_vendors");
    }

    public function add_user()
    {
        $this->data["users"] = "class='current'";
        $this->data['cities'] = $this->db->get("cities")->result_array();
        $list_users_url = base_url() . "backend/admin/list_users";
        $add_user_url = base_url() . "backend/admin/add_user";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_users_url" title="Users">Users</a></li>
		<li class="no-hover"><a href="$add_user_url" title="Add User">Add User</a></li>
EOD;



        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/add/users", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function add_user_done()
    {
        $this->db->insert("profiles", $_POST);
        redirect("backend/admin/list_users");
    }

    public function add_category()
    {
        $this->data["categories"] = "class='current'";
        $list_categories_url = base_url() . "backend/admin/list_categories";
        $add_category_url = base_url() . "backend/admin/add_category";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_categories_url" title="Categories">Categories</a></li>
		<li class="no-hover"><a href="$add_category_url" title="Add Category">Add Category</a></li>
EOD;



        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/add/categories", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function add_category_done()
    {
        $this->db->insert("categories", $_POST);
        redirect("backend/admin/list_categories");
    }

    public function add_city()
    {
        $this->data["cities"] = "class='current'";
        $list_cities_url = base_url() . "backend/admin/list_cities";
        $add_city_url = base_url() . "backend/admin/add_city";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_cities_url" title="Cities">Cities</a></li>
		<li class="no-hover"><a href="$add_city_url" title="Add City">Add City</a></li>
EOD;



        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/add/cities", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function add_city_done()
    {
        $this->db->insert("cities", $_POST);
        redirect("backend/admin/list_cities");
    }

    public function add_location()
    {
        $this->data["locations"] = "class='current'";
        $list_locations_url = base_url() . "backend/admin/list_locations";
        $add_location_url = base_url() . "backend/admin/add_location";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_locations_url" title="Locations">Locations</a></li>
		<li class="no-hover"><a href="$add_location_url" title="Add Location">Add Location</a></li>
EOD;

        $this->data["vendors"] = $this->db->get("vendors")->result_array();
        $this->data["cities"] = $this->db->get("cities")->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/add/locations", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function add_location_done()
    {
        $this->db->insert("locations", $_POST);
        redirect("backend/admin/list_locations");
    }

    public function add_deal()
    {
        $this->data["deals"] = "class='current'";
        $list_deals_url = base_url() . "backend/admin/list_deals";
        $add_deal_url = base_url() . "backend/admin/add_deal";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_deals_url" title="Deals">Deals</a></li>
		<li class="no-hover"><a href="$add_deal_url" title="Add Deal">Add Deal</a></li>
EOD;

        $this->data["vendors"] = $this->db->get("vendors")->result_array();
        $this->data["categories"] = $this->db->get("categories")->result_array();
        $this->data["locations"] = $this->db->query("select locations.id, locations.title, cities.name
		from locations join cities on cities.id = locations.cities_id")->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/add/deals", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function add_deal_done()
    {
        $folder = $this->helpers->GenerateRandomString(20);
        mkdir("./uploads/deals_logos/" . $folder, 0777);
        $config['upload_path'] = './uploads/deals_logos/' . $folder . '/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';
        $this->load->library('upload', $config);

        if($this->upload->do_upload("image"))
        {
            $image_data = $this->upload->data();
            $image = $folder . '/' . $image_data["file_name"];
            $_POST["image"] = $image;
        }
        else
        {
            $_POST["image"] = "no-image.gif";
        }
        
        //echo $config['upload_path'] . $image_data["file_name"];
        //$this->mylib->resizeImage($config['upload_path'] . $image_data["file_name"], '580', '300');

        //create thumbinal
        $thumbnail = 'thumb_' . $image_data["file_name"];
        copy($config['upload_path'] . $image_data["file_name"], $config['upload_path'] . $thumbnail);
        $this->mylib->resizeImage($config['upload_path'] . $thumbnail, '161', '100');
        
        //create tile
        $thumbnail = 'tile_' . $image_data["file_name"];
        copy($config['upload_path'] . $image_data["file_name"], $config['upload_path'] . $thumbnail);
        $this->mylib->resizeImage($config['upload_path'] . $thumbnail, '35', '40');

        if($this->upload->do_upload("image2"))
        {
            $image_data = $this->upload->data();
            $image = $folder . '/' . $image_data["file_name"];
            $_POST["image2"] = $image;
            //$this->mylib->resizeImage($config['upload_path'] . $image_data["file_name"], '580', '300');
        }
        else
        {
            $_POST["image2"] = "no-image.gif";
        }
        
        //create tile
        $thumbnail = 'tile_' . $image_data["file_name"];
        copy($config['upload_path'] . $image_data["file_name"], $config['upload_path'] . $thumbnail);
        $this->mylib->resizeImage($config['upload_path'] . $thumbnail, '35', '40');

        if($this->upload->do_upload("image3"))
        {
            $image_data = $this->upload->data();
            $image = $folder . '/' . $image_data["file_name"];
            $_POST["image3"] = $image;
            //$this->mylib->resizeImage($config['upload_path'] . $image_data["file_name"], '580', '300');
        }
        else
        {
            $_POST["image3"] = "no-image.gif";
        }
        
        //create tile
        $thumbnail = 'tile_' . $image_data["file_name"];
        copy($config['upload_path'] . $image_data["file_name"], $config['upload_path'] . $thumbnail);
        $this->mylib->resizeImage($config['upload_path'] . $thumbnail, '35', '40');        


        $endParts = explode("/", $_POST["end_date"]);
        if(count($endParts) == 3)
        {
            $_POST["end_date"] = $endParts["2"] . "-" . $endParts["1"] . "-" . $endParts["0"];
        }

        //get cities_id
        $locations = $this->db->where("id", $_POST["locations_id"])->get("locations")->result_array();
        $cities = $this->db->where("id", $locations[0]["cities_id"])->get("cities")->result_array();
        $_POST["cities_id"] = $cities[0]["id"];

        $this->db->insert("deals", $_POST);
        redirect("backend/admin/list_deals");
    }

    public function edit_admin($id)
    {
        $admins = $this->db->where("id", $id)->get("admins")->result_array();
        $this->data = array_merge($this->data, $admins[0]);

        $this->data["admins"] = "class='current'";
        $list_admins_url = base_url() . "backend/admin/list_admins";
        $edit_admin_url = base_url() . "backend/admin/edit_admin/$id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_admins_url" title="Admins">Admins</a></li>
		<li class="no-hover"><a href="$edit_admin_url" title="Edit Admin">Edit Admin</a></li>
EOD;
        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/edit/admins", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function edit_admin_done($id)
    {
        $this->db->where("id", $id)->update("admins", $_POST);
        redirect("backend/admin/list_admins");
    }

    public function edit_vendor($id)
    {
        $vendors = $this->db->where("id", $id)->get("vendors")->result_array();
        $this->data = array_merge($this->data, $vendors[0]);

        $this->data["vendors"] = "class='current'";
        $list_vendors_url = base_url() . "backend/admin/list_vendors";
        $edit_vendor_url = base_url() . "backend/admin/edit_vendor/$id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_vendors_url" title="Vendors">Vendors</a></li>
		<li class="no-hover"><a href="$edit_vendor_url" title="Edit Vendor">Edit Vendor</a></li>
EOD;
        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/edit/vendors", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function edit_vendor_done($id)
    {
        $vendors = $this->db->where("id", $id)->get("vendors")->result_array();
        $dir_parts = explode("/", $vendors[0]["logo"]);
        $this->helpers->remove_dir("./uploads/vendors_logos/" + $dir_parts[0]);

        $folder = $this->helpers->GenerateRandomString(20);
        mkdir("./uploads/vendors_logos/" . $folder, 0777);
        $config['upload_path'] = './uploads/vendors_logos/' . $folder . '/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';
        $this->load->library('upload', $config);
        if($this->upload->do_upload("image"))
        {
            $image_data = $this->upload->data();
            $image = $folder . '/' . $image_data["file_name"];
            $_POST["logo"] = $image;
        }


        $this->db->where("id", $id)->update("vendors", $_POST);
        redirect("backend/admin/list_vendors");
    }

    public function edit_user($id)
    {
        $users = $this->db->where("id", $id)->get("profiles")->result_array();
        $this->data = array_merge($this->data, $users[0]);
        

        $this->data["users"] = "class='current'";
        $this->data['cities'] = $this->db->get("cities")->result_array();
        $list_users_url = base_url() . "backend/admin/list_users";
        $edit_user_url = base_url() . "backend/admin/edit_user/$id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_users_url" title="Users">Users</a></li>
		<li class="no-hover"><a href="$edit_user_url" title="Edit User">Edit User</a></li>
EOD;
        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/edit/users", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function edit_user_done($id)
    {
        $this->db->where("id", $id)->update("profiles", $_POST);
        redirect("backend/admin/list_users");
    }

    public function edit_city($id)
    {
        $cities = $this->db->where("id", $id)->get("cities")->result_array();
        $this->data = array_merge($this->data, $cities[0]);

        $this->data["cities"] = "class='current'";
        $list_cities_url = base_url() . "backend/admin/list_cities";
        $edit_city_url = base_url() . "backend/admin/edit_city/$id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_cities_url" title="Cities">Cities</a></li>
		<li class="no-hover"><a href="$edit_city_url" title="Edit City">Edit City</a></li>
EOD;
        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/edit/cities", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function edit_city_done($id)
    {
        $this->db->where("id", $id)->update("cities", $_POST);
        redirect("backend/admin/list_cities");
    }

    public function edit_location($id)
    {
        $locations = $this->db->where("id", $id)->get("locations")->result_array();
        $this->data = array_merge($this->data, $locations[0]);

        $this->data["locations"] = "class='current'";
        $list_locations_url = base_url() . "backend/admin/list_locations";
        $edit_location_url = base_url() . "backend/admin/edit_location/$id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_locations_url" title="Locations">Locations</a></li>
		<li class="no-hover"><a href="$edit_location_url" title="Edit Location">Edit Location</a></li>
EOD;

        $this->data["vendors"] = $this->db->get("vendors")->result_array();
        $this->data["cities"] = $this->db->get("cities")->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/edit/locations", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function edit_location_done($id)
    {
        $this->db->where("id", $id)->update("locations", $_POST);
        redirect("backend/admin/list_locations");
    }

    public function edit_category($id)
    {
        $categories = $this->db->where("id", $id)->get("categories")->result_array();
        $this->data = array_merge($this->data, $categories[0]);

        $this->data["categories"] = "class='current'";
        $list_categories_url = base_url() . "backend/admin/list_categories";
        $edit_category_url = base_url() . "backend/admin/edit_category/$id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_categories_url" title="Categories">Categories</a></li>
		<li class="no-hover"><a href="$edit_category_url" title="Edit Category">Edit Category</a></li>
EOD;
        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/edit/categories", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function edit_category_done($id)
    {
        $this->db->where("id", $id)->update("categories", $_POST);
        redirect("backend/admin/list_categories");
    }

    public function edit_deal($id)
    {
        $categories = $this->db->where("id", $id)->get("deals")->result_array();
        $this->data = array_merge($this->data, $categories[0]);

        $this->data["deals"] = "class='current'";
        $list_deals_url = base_url() . "backend/admin/list_deals";
        $edit_deal_url = base_url() . "backend/admin/edit_deal/$id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_deals_url" title="Deals">Deals</a></li>
		<li class="no-hover"><a href="$edit_deal_url" title="Edit Deal">Edit Deal</a></li>
EOD;

        $this->data["vendors"] = $this->db->get("vendors")->result_array();
        $this->data["categories"] = $this->db->get("categories")->result_array();
        $this->data["locations"] = $this->db->query("select locations.id, locations.title, cities.name
		from locations join cities on cities.id = locations.cities_id")->result_array();

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/edit/deals", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function edit_deal_done($id)
    {
        $folder = $this->helpers->GenerateRandomString(20);
        mkdir("./uploads/deals_logos/" . $folder, 0777);
        $config['upload_path'] = './uploads/deals_logos/' . $folder . '/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';
        $this->load->library('upload', $config);

        if($this->upload->do_upload("image"))
        {
            $image_data = $this->upload->data();
            $image = $folder . '/' . $image_data["file_name"];
            $_POST["image"] = $image;
            
            //create thumbinal of first image for the slider
            $thumbnail = 'thumb_' . $image_data["file_name"];
            copy($config['upload_path'] . $image_data["file_name"], $config['upload_path'] . $thumbnail);
            $this->mylib->resizeImage($config['upload_path'] . $thumbnail, '161', '100');

            //create tile
            $thumbnail = 'tile_' . $image_data["file_name"];
            copy($config['upload_path'] . $image_data["file_name"], $config['upload_path'] . $thumbnail);
            $this->mylib->resizeImage($config['upload_path'] . $thumbnail, '35', '40');   
        }
        

        if($this->upload->do_upload("image2"))
        {
            $image_data = $this->upload->data();
            $image = $folder . '/' . $image_data["file_name"];
            $_POST["image2"] = $image;
            //$this->mylib->resizeImage($config['upload_path'] . $image_data["file_name"], '580', '300');
            
        
        
        //create tile
        $thumbnail = 'tile_' . $image_data["file_name"];
        copy($config['upload_path'] . $image_data["file_name"], $config['upload_path'] . $thumbnail);
        $this->mylib->resizeImage($config['upload_path'] . $thumbnail, '35', '40');        
        
        }

        if($this->upload->do_upload("image3"))
        {
            $image_data = $this->upload->data();
            $image = $folder . '/' . $image_data["file_name"];
            $_POST["image3"] = $image;
            //$this->mylib->resizeImage($config['upload_path'] . $image_data["file_name"], '580', '300');
        
        
        //create tile
        $thumbnail = 'tile_' . $image_data["file_name"];
        copy($config['upload_path'] . $image_data["file_name"], $config['upload_path'] . $thumbnail);
        $this->mylib->resizeImage($config['upload_path'] . $thumbnail, '35', '40');        
        
        }
        

        //start date
        //$_POST["start_date"] = 0;


        $endParts = explode("/", $_POST["end_date"]);
        if(count($endParts) == 3)
        {
            $_POST["end_date"] = $endParts["2"] . "-" . $endParts["0"] . "-" . $endParts["1"];
        }

        //get cities_id
        $locations = $this->db->where("id", $_POST["locations_id"])->get("locations")->result_array();
        $cities = $this->db->where("id", $locations[0]["cities_id"])->get("cities")->result_array();
        $_POST["cities_id"] = $cities[0]["id"];

        $this->db->where("id", $id);
        $this->db->update("deals", $_POST);
        redirect("backend/admin/list_deals");
    }

    public function delete_admin($id)
    {
        $this->db->where("id", $id)->delete("admins");
        redirect("backend/admin/list_admins");
    }

    public function delete_vendor($id)
    {
        $vendors = $this->db->where("id", $id)->get("vendors")->result_array();
        $dir_parts = explode("/", $vendors[0]["logo"]);
        $this->helpers->remove_dir("./uploads/vendors_logos/" + $dir_parts[0]);

        $this->db->where("id", $id)->delete("vendors");
        redirect("backend/admin/list_vendors");
    }

    public function delete_user($id)
    {
        $this->db->where("id", $id)->delete("profiles");
        redirect("backend/admin/list_users");
    }

    public function delete_category($id)
    {
        $deals = $this->db->where("categories_id", $id)->get("deals")->result_array();
        if(count($deals) > 0)
        {
            if(count($this->db->where("deals_id", $deals[0]["id"])->get("coupons")->result_array()) == 0)
            {
                $this->db->where("id", $id)->delete("cities");
                $this->db->where("categories_id", $id)->delete("deals");
            }
            else
            {
                die("This category has already purchased coupons and it can't be deleted.");
            }
        }
        else
        {
            $this->db->where("id", $id)->delete("categories");
            $this->db->where("categories_id", $id)->delete("deals");
        }

        redirect("backend/admin/list_categories");
    }

    public function delete_city($id)
    {
        $deals = $this->db->where("cities_id", $id)->get("deals")->result_array();
        if(count($deals) > 0)
        {
            if(count($this->db->where("deals_id", $deals[0]["id"])->get("coupons")->result_array()) == 0)
            {
                $this->db->where("id", $id)->delete("cities");
                $this->db->where("cities_id", $id)->delete("deals");
            }
            else
            {
                die("This city has already purchased coupons and it can't be deleted.");
            }
        }
        else
        {
            $this->db->where("id", $id)->delete("cities");
            $this->db->where("cities_id", $id)->delete("deals");
        }
        redirect("backend/admin/list_cities");
    }

    public function delete_location($id)
    {
        $deals = $this->db->where("locations_id", $id)->get("deals")->result_array();
        if(count($deals) > 0)
        {
            if(count($this->db->where("deals_id", $deals[0]["id"])->get("coupons")->result_array()) == 0)
            {
                $this->db->where("id", $id)->delete("locations");
                $this->db->where("locations_id", $id)->delete("deals");
            }
            else
            {
                die("This location has already purchased coupons and it can't be deleted.");
            }
        }
        else
        {
            $this->db->where("id", $id)->delete("locations");
            $this->db->where("locations_id", $id)->delete("deals");
        }
        redirect("backend/admin/list_locations");
    }

    public function delete_deal($id)
    {
        if(count($this->db->where("deals_id", $id)->get("coupons")->result_array()) > 0)
        {
            die("This deal has already purchased coupons you can't delete it !!");
        }
        else
        {
            $this->db->where("id", $id)->delete("deals");
            redirect("backend/admin/list_deals");
        }
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

        $list_coupons_url = base_url() . "backend/admin/list_copouns";
        $deliver_coupon_url = base_url() . "backend/admin/deliver_coupon/$coupon_id";
        $this->data["breadcrumb"] .=<<<EOD
		<li class="no-hover"><a href="$list_coupons_url" title="Coupons">Coupons</a></li>
		<li class="no-hover"><a href="$deliver_coupon_url" title="Deliver Coupon">Deliver Coupon</a></li>
EOD;
        $this->data["id"] = $coupon_id;

        $this->parser->parse("backend/header", $this->data);
        $this->parser->parse("backend/admin/sidebar", $this->data);
        $this->parser->parse("backend/admin/deliver", $this->data);
        $this->parser->parse("backend/footer", $this->data);
    }

    public function deliver_coupon_done($coupon_id)
    {
        $coupon = $this->input->post('coupon');
        $sql = "SELECT * FROM purchase WHERE id = $coupon_id AND copoun = '$coupon'";
        $result = $this->mylib->sqlGetSingleRow($sql);
        
        if(!$result)
             redirect("backend/admin/deliver_coupon/$coupon_id/error");
        else
        {
            $this->db->where('copoun',$coupon);
            $data['status'] = 'delivered';
            $this->db->update('purchase', $data);
            redirect("backend/admin/list_copouns");
        }
    }

    public function change_featured($deals_id, $featured)
    {
        if($featured)
        {
            $this->db->where("id", $deals_id)->update("deals", array("featured" => 0));
        }
        else
        {
            $this->db->where("id", $deals_id)->update("deals", array("featured" => 1));
        }
        redirect("backend/admin/list_deals");
    }

    public function change_activated($deals_id, $activated)
    {
        if($activated)
        {
            $this->db->where("id", $deals_id)->update("deals", array("activated" => 0));
        }
        else
        {
            $this->db->where("id", $deals_id)->update("deals", array("activated" => 1));
        }
        redirect("backend/admin/list_deals");
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/backend/admin.php */