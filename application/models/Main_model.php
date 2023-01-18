<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model
{
    // public function getUsers()
    // {
    //     $query = $this->db->get("tnt");
    //     return $query->result_array();
    // }

    function getUsers()
    {
        $query = $this->db->get("tnt");
        return $query->result();
    }

    function saverecords($data)
    {
        $this->db->insert('tnt', $data);
        return true;
    }
    function deleterecords($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("tnt");
        return true;
    }
    function displayrecordsById($id)
    {
        $sql = "SELECT * FROM tnt WHERE id='$id'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function update_records($editpname, $editemail, $editphoneNumber, $id)
    {
        $sql = "UPDATE tnt SET pname= '$editpname', email = '$editemail', phoneNumber = '$editphoneNumber' WHERE id= $id";
        $this->db->query($sql);
        return true;
    }
    function signUprecords($data)
    {
        $this->db->insert('signUp', $data);
        return true;
    }
    function selectUsername($username)
    {
        $existSql = "SELECT * FROM signUp WHERE username= '$username'";
        $result =  $this->db->query($existSql);
        return $result->num_rows();
    }

    function forLogin($username)
    {
        $sql = "SELECT * FROM signUp WHERE username= '$username'";
        $result =  $this->db->query($sql);
        return $result;
    }

    function getSignupUser($userId)
    {
        $fetch_pass = $this->db->query("select * from signup where id='$userId'");
        return  $fetch_pass->row_array();
    }

    function updatepass($newpass, $userid)
    {
        $update_pass = $this->db->query("UPDATE signup SET `password`='$newpass'  where id='$userid'");
        return true;
    }
}
