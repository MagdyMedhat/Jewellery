<?php

/*
 * @Description : Dbmodel the main model to access saudi database.
 * @Author      : Magdy Medhat
 * @Date        : 15/10/2011
 */

class Dbmodel extends CI_Model
{
    function Dbmodel()
    {
        parent::__construct();
        //support arabic in Database: set default collation to: utf8_unicode_ci
        //last inserted id: $this->db->insert_id()
        //check affected rows: $this->db->affected_rows()
        //count all records in a table: $this->db->count_all();
    }
    
    function deal_get($deal_id)
    {
        $sql = "SELECT * FROM deals WHERE id = $deal_id";
        $result = $this->mylib->sqlGetSingleRow($sql);
        return $result;
    }
    
    function favourites_insert($deal_id, $user_id)
    {
        $sql = "INSERT INTO favourites VALUES (0, '$user_id', '$deal_id')";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
    function purchase_insert($data)
    {
        $this->db->insert('purchase', $data);
        return $this->db->affected_rows();
    }
    
    function transactions_get($id)
    {
        $sql = "SELECT * FROM purchase where profile_id = $id ORDER BY id DESC";
        $result = $this->mylib->sqlGetMultipleRows($sql);
        return $result;
    }
    
    function favourites_remove($deal_id)
    {
        $sql = "DELETE FROM favourites WHERE deal_id = $deal_id";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
    function favourites_get($user_id)
    {
        $sql = "SELECT * FROM deals JOIN favourites on deals.id = favourites.deal_id WHERE favourites.profile_id = $userid";
        $result = $this->mylib->sqlGetMultipleRows($sql);
        return $result;
    }
    
    function favourites_clear($user_id)
    {
        $sql = "DELETE FROM favourites WHERE profile_id = $user_id";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
    function settings_get($name)
    {
        $sql = "SELECT * FROM settings WHERE name = '$name'";
        $result = $this->mylib->sqlGetSingleRow($sql);
        
        if ($result)
            return $result['value'];
        else
            return $result;
    }
    
    function profile_update($data, $profile_id)
    {
        if ($data['password'] == '12345')
            unset($data['password']);
        else
            $data['password'] = sha1($data['password']);
        
        $this->db->where('id',$profile_id);
        $this->db->update('profiles', $data);
        
        return $this->db->affected_rows();
    }
    
    function profile_get($user_id)
    {
        $sql = "SELECT * FROM profiles WHERE id = $user_id";
        $result = $this->mylib->sqlGetSingleRow($sql);
        
        if($result)
            $result['password'] = '12345';
        
        return $result;
    }
    
    function username_exists($username)
    {
        $username = strtolower($username);
        $sql = "SELECT * FROM profiles WHERE username = '$username'";
        $result = $this->mylib->sqlGetSingleRow($sql);
        return $result;
    }
    
    function email_exists($email)
    {
        $email = strtolower($email);
        $sql = "SELECT * FROM profiles WHERE email = '$email'";
        $result = $this->mylib->sqlGetSingleRow($sql);       
        return $result;
    }
    
    function verify_access($username, $password)
    {
        $username = strtolower($username);
        $password = sha1($password);
        $sql = "SELECT * FROM profiles WHERE username = '$username' AND password = '$password'";
        $result = $this->mylib->sqlGetSingleRow($sql);
        return $result;
    }
    
    function user_insert($data)
    {
        $data['username'] = strtolower($data['username']);
        $data['password'] = sha1($data['password']);
        $data['email'] = strtolower($data['email']);
        
        $this->db->insert('profiles', $data);
        return $this->db->affected_rows();
    }
    
    function deal_get_all()
    {
        $sql = "SELECT * FROM categories";
        $categories = $this->mylib->sqlGetMultipleRows($sql);
        
        if ($categories)
        {
            $result;
            foreach($categories as $category)
            {
                $sql = "SELECT * FROM deals WHERE categories_id = $category[id]";
                $deals = $this->mylib->sqlGetMultipleRows($sql);
                
                if ($deals)
                    $result[$category['title']] = $deals;
            }
            return $result;
        }
        else
            return false;
    }
}

?>