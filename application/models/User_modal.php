<?php
class User_modal extends CI_model
{
    function create($formArray)
    {
        $this->db->insert('tnt', $formArray);
    }

    function all($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        return $users =  $this->db->get('tnt')->result_array();
    }

    function totalrows()
    {
        return $users =  $this->db->get('tnt')->num_rows();
    }

    function getUser($userId)
    {
        $this->db->where('id', $userId);
        return $user = $this->db->get('tnt')->row_array();
    }

    function updateUser($userId, $formArray)
    {
        $this->db->where('id', $userId);
        $this->db->update('tnt', $formArray);
    }

    function deleteUser($userId)
    {
        $this->db->where('id', $userId);
        $this->db->delete('tnt');
    }
}
