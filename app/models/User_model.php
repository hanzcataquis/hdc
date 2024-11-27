<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {

	public function read() {
        return $this->db->table('hddc_users')->get_all();
    }

    public function create($last_name, $first_name, $gender, $email, $address) {
        $bind = array(
            'hddc_last_name' => $last_name,
            'hddc_first_name' => $first_name,
            'hddc_email' => $email,
            'hddc_gender' => $gender,
            'hddc_address' => $address
        );
        
        return $this->db->table('hddc_users')->insert($bind);
        
    }

    public function update($id, $last_name, $first_name, $gender, $email, $address) {
        $bind = array(
            'hddc_last_name' => $last_name,
            'hddc_first_name' => $first_name,
            'hddc_email' => $email,
            'hddc_gender' => $gender,
            'hddc_address' => $address
        );

        return $this->db->table('hddc_users')->where('id', $id)->update($bind);
    }

    public function singleUser($id) {
        return $this->db->table('hddc_users')->where('id', $id)->get();
    }
    public function delete($id) {
        return $this->db->table('hddc_users')->where('id', $id)->delete();
    }

}
?>