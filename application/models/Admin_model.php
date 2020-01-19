<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{
    public function login($post){
        $q = $this->db->where(['email'=>$post['email'], 'password'=>$post['password']])
        ->get('admin');
        return $q->result();
    }

    public function get_tags(){
        $q = $this->db->get('tags');
        return $q->result();
    }

    public function add_tags($post){
		return $this->db->insert('tags', $post);
	}
}
?>