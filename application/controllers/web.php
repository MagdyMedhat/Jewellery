<?php
/*
 * @Description : Front
 * @Author      : Magdy Medhat
 * @Date        : 13/10/2011
 */
class Web extends CI_Controller
{
    function Web()
    {
        parent::__construct();
    }

    function index()
    {
        $this->deal_open(26);
        //$this->_display('front/login');
        
    }
    
    function _verify_login()
    {
        if(!$this->session->userdata('user_id'))
            return false;
        else
            return true;
    }
    
    function _display($view, $view_data = null)
    {
        //header
        $header_data['logged'] = $this->session->userdata('user_id');
        $this->load->view('front/header', $header_data);
        
        //content
        $this->load->view($view, $view_data);
        
        //footer
        $footer_data['categories'] = $this->_deal_get_all();
        $this->load->view('front/footer', $footer_data);
    }
    
    function transactions()
    {
        $id = $this->session->userdata('user_id');
        $result = $this->dbmodel->transactions_get($id);
        
        foreach($result as &$record)
        {
            $time = $this->mylib->setTimeFormat($record['time']);
            $date = $this->mylib->setDateFormat($record['date']);
            $record['date'] = $time . " " . $date;
        }
        
        $data['transactions'] = $result;
        //header
        $header_data['logged'] = $this->session->userdata('user_id');
        $this->load->view('front/header', $header_data);
        
        //content
        $this->load->view('front/transactions', $data);
    }
    
    function _deal_get_all()
    {
        return $this->dbmodel->deal_get_all();
    }
    
    
    function deal_open($deal_id)
    {   
        $deal_id = $this->mylib->securityFilter($deal_id);
        
        $data['deal'] = $this->dbmodel->deal_get($deal_id);
        
        $this->_display('front/deal', $data);
    }
    
    function payment()
    {
        $post = $this->input->post();
        //echo "<pre>";
        //print_r($post);
        //return;

        if(!$post['payment_status'] || $post['payment_status'] != 'Completed')
        {
            $this->load->view('front/payment_failed');
            return;
        }
        
        //profile_id, item, price, copoun, status, time, date
        $data['profile_id'] = $this->session->userdata('user_id');
        $data['item'] = $post['transaction_subject'];
        $data['price'] = $post['payment_gross'];
        $data['status'] = "purchased";
        $data['time'] = $this->mylib->get_current_time();
        $data['date'] = $this->mylib->get_current_date();
        $data['copoun'] = md5($data['profile_id'] . $data['item'] . time());
        $this->dbmodel->purchase_insert($data);
    
    }
        
    function login()
    {
        //username, password
        $post = $this->input->post();

        if(!$post['submit'])
        {
            $this->_display('front/login');
            return;
        }
        unset($post['submit']);
        
        foreach($post as &$parameter)
            $parameter = $this->mylib->securityFilter($parameter);
        
        $result = $this->dbmodel->verify_access($post['username'], $post['password']);
        
        if(!$result)
        {
            $this->mylib->popUpMsg('username or password is incorrect');
            $this->_display('front/login');
            return;
        }
        
        //success
        $this->session->set_userdata('user_id',$result['id']);
        redirect('web/index');
    }
    
    function logout()
    {
        if($this->session->userdata('user_id'))
        {
            $this->session->unset_userdata('user_id');
            redirect('web/index');
        }
    }

    function forgot_password()
    {
        //temp
        $this->_display('front/forgot_password');
        return;
        
        $post = $this->input->post();
        
        if($post['submit'])
        {
            unset($post['submit']);
            
            if($this->dbmodel->verifyUserNameAndEmail($post['username'], $post['email']))
            {
                echo "<script> alert('wrong username or email'); </script>";
                $this->load->view('forgotPassword');
                return;
            }
            
            $userId = $this->dbmodel->getUserId($post['username']);
            $newPassword = "boum_user";
            $this->dbmodel->changeUserPassword($userId, sha1($newPassword));

            $recipient_arr = array($post['email']);
            $from = "noreply@boum.zwl.com";
            $title = "[Boum] Password Recovery";
            $body = "Greetings, $post[username]<br><br>
            Your new password is: <b> $newPassword </b> <br>
            Please change it as soon as you login.<br><br>
            Thank you,<br>
            The Boum Team";

            $this->mylib->sendMail($recipient_arr, $title, $body, $from);
            echo "<script> alert('a new password was sent to your email!') </script>";
            $this->load->view('login');
            return;
        }
        else
        {
            $this->_display('front/forgot_password');
        }
    }
    function register()
    {        
        //username, password, email, name, cities_id
        $post = $this->input->post();
        unset($post['submit_x']);
        unset($post['submit_y']);

        if(!$post['submit'])
        {
            $this->_display('front/register');
            return;
        }
        unset($post['submit']);

        foreach($post as &$parameter)
            $parameter = $this->mylib->securityFilter($parameter);
        
        $errorCount = 0;
        $errorStr = "";
        if (empty($post['username']) || strlen($post['username']) <= 4)
        {
            $errorCount++;
            $errorStr .= "username is too short\\n";
        }

        if (empty($post['password']) || strlen($post['password']) <= 5)
        {
            $errorCount++;
            $errorStr .= "password is too short\\n";
        }

        if (empty($post['email']) || !$this->mylib->validateMail($post['email']))
        {
            $errorCount++;
            $errorStr .= "invalid email address\\n";
        }
            
        if($this->dbmodel->username_exists($post['username']))
        {
            $errorCount++;
            $errorStr .= "username already exists\\n";
        }

        if($this->dbmodel->email_exists($post['email']))
        {
            $errorCount++;
            $errorStr .= "email address already exists";
        }

        if($errorCount)
        {
            $this->mylib->popUpMsg($errorStr);
            $this->_display('front/register');
            return;
        }
        
        $result = $this->dbmodel->user_insert($post);
        
        if (!$result)
        {
            $this->mylib->popUpMsg('Registration: database error');
            $this->_display('front/register');
            return;
        }
        
        //success
        redirect('web/index');
    }
    
    function profile()
    {
        $this->_verify_login();
        
        //username, password, email, name, cities_id
        $post = $this->input->post();

        if(!$post['submit'])
        {
            $user_id = $this->session->userdata('user_id');
            $user_data = $this->dbmodel->profile_get($user_id);
            //$this->_display('front/profile', $user_data);
            return;
        }
        unset($post['submit']);

        foreach($post as &$parameter)
            $parameter = $this->mylib->securityFilter($parameter);
        
        $user_id = $this->session->userdata('user_id');
        $result = $this->dbmodel->profile_update($post, $user_id);
        
        if(!$result)
        {
            $this->mylib->popUpMsg('Profile: database error');
            //$this->_display('front/profile');
            return;
        }
        
        //success
        //redirect('web/profile');
    }
    
    function about()
    {
        //header
        $header_data['logged'] = $this->session->userdata('user_id');
        $this->load->view('front/header', $header_data);
        
        //content
        $this->load->view('front/about');
        return;
        
        //name, email, message
        $post = $this->input->post();

        if(!$post['submit'])
        {
            $data['about_us'] = $this->dbmodel->settings_get('about_us');
            //$this->_display('front/contact_us', $data);
            return;
        }
        unset($post['submit']);

        foreach($post as &$parameter)
            $parameter = $this->mylib->securityFilter($parameter);
        
        $contact_us_email = $this->dbmodel->settings_get('contact_us');
        $this->mylib->sendMail(array("$contact_us_email"), "Message from: $post[name]", $post['message'], $post['email']);
        
        //success
        //redirect('web/contact_us');
    }
    
    function favourites()
    {
        $this->_verify_login();
        $user_id = $this->session->userdata('user_id');
        $data['favourites'] = $this->dbmodel->favourites_get($user_id);
        //$this->_display('front/favourites', $data);
        return;
    }
    
    function favourites_delete()
    {
        $this->_verify_login();
        
        //deal_id
        $post = $this->input->post();
        
        unset($post['submit']);

        foreach($post as &$parameter)
            $parameter = $this->mylib->securityFilter($parameter);
                
        $this->dbmodel->favourites_remove($deal_id);
        
        //success
        //$this->_display('front/favourites');
    }
    
    function favourites_add()
    {
        $this->_verify_login();
        
        //deal_id
        $post = $this->input->post();
        
        unset($post['submit']);

        foreach($post as &$parameter)
            $parameter = $this->mylib->securityFilter($parameter);

        $user_id = $this->session->userdata('user_id');
        $this->dbmodel->favourites_insert($post['deal_id'], $user_id);
        
        //success
        //$this->_display('front/index');
    }    
    
    function favourites_clear()
    {
        $this->_verify_login();
        $user_id = $this->session->userdata('user_id');
        $this->dbmodel->favourites_clear($user_id);
        
        //success
        //$this->_display('front/favourites');
    }
}

?>