<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
        
    var $userid   = '';
        var $username = '';
        var $password    = '';
	var $role = array("not_valid" => 0, "admin" => 1, "vendor" => 2, "user" => 3);
        var $data = array();
        
	public function index($error = "")
	{
		$this->data["error"] = "";
		if($error != "")
		{
			$this->data["error"] = "| username or password is incorrect !!";
		}
		$this->parser->parse('backend/login',$this->data);
	}
        
        function auth($username, $password)
	{
		$this->db->where("username", $username);
		$this->db->where("password", $password);
		if($this->db->count_all_results("admins") > 0)
		{
			return $this->role["admin"];
		}
		else {
			$this->db->where("username", $username);
			$this->db->where("password", $password);
			if($this->db->count_all_results("vendors") > 0)
			{
				return $this->role["vendor"];
			}
			else {
				$this->db->where("username", $username);
				$this->db->where("password", $password);
				if($this->db->count_all_results("profiles") > 0)
				{
					return $this->role["user"];
				}
				else {
					return $this->role["not_valid"];
				}
			}
		}
	}
	
	public function do_login()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		
		switch ($this->auth($username, $password)) {
			case '2': //vendor
				$this->session->set_userdata("role","2");
				$this->session->set_userdata("username",$username);
				redirect("backend/vendor");
				break;
			case '1': //admin
				$this->session->set_userdata("role","1");
				$this->session->set_userdata("username",$username);
				redirect("backend/admin");
				break;
			default: //error in login
				$this->session->set_userdata("role","0");
				redirect("backend/login/index/error");
				break;
		}
		echo $this->session->userdata("role");
	}
	
	public function logout()
	{
		$this->session->set_userdata("role","0");
		$this->session->set_userdata("username", "");
		redirect("backend/login/");
	}
}

/* End of file login.php */
/* Location: ./application/controllers/backend/login.php */