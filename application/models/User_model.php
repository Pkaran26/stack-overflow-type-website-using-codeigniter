<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    public function login($post){
        $q = $this->db->where(['email'=>$post['email'], 'password'=>$post['password']])
        ->get('users');
        return $q->result();
    }

    public function register($post){
        return $this->db->insert('users', $post);
    }

    public function user_data($user_id){
        $q = $this->db->where(['user_id'=>$user_id])
        ->get('users');
        return $q->result();
    }

    public function get_user_top_ans($user_id){
        $q = $this->db->where(['user_id'=>$user_id])
        ->get('answers');
        return $q->result();
    }    

    public function add_question($array){
        return $this->db->insert('questions', $array);
    }

    public function delete_answers($answer_id){
        return $this->db->delete('answers', ['answer_id'=>$answer_id]);
    }

    public function add_answer($array){
        return $this->db->insert('answers', $array);
    }

    public function qlike($answer_id, $user_id){
        if(!$this->chk_like($user_id, $answer_id)){
            $this->db->insert('chk_ans_likes', ['user_id'=>$user_id, 'answer_id'=>$answer_id]);
            $this->db->set('likes', 'likes+1', FALSE);
            $this->db->where(['answer_id'=>$answer_id]);
            return $this->db->update('answers');
        }
        return 0;
    }

    public function qdislike($answer_id, $user_id){
        if(!$this->chk_like($user_id, $answer_id)){
            $this->db->insert('chk_ans_likes', ['user_id'=>$user_id, 'answer_id'=>$answer_id]);
            $this->db->set('dislikes', 'dislikes+1', FALSE);
            $this->db->where(['answer_id'=>$answer_id]);
            return $this->db->update('answers');
        }
        return 0;
    }

    public function chk_like($user_id, $answer_id){
        $q = $this->db->where(['user_id'=>$user_id, 'answer_id'=>$answer_id])
        ->get('chk_ans_likes');
        return $q->num_rows();
	}
}
?>