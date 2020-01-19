<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model{

    public function top_questions(){
        $q = $this->db->query("SELECT
        questions.question_id,
        questions.question,
        questions.tags,
        questions.created_at,
        questions.total_views,
        users.fname,
        users.lname
    FROM
        questions
         inner join users ON users.user_id = questions.user_id
    GROUP BY
        questions.question_id
    ORDER BY
        questions.question_id
    DESC LIMIT 25");
        return $q->result();
    }

    public function questions_list($limit, $offset=null){
        if($offset){
            $offset = ",".$offset;
        }
        $q = $this->db->query("SELECT
        questions.question_id,
        questions.question,
        questions.tags,
        questions.created_at,
        questions.total_views,
        users.fname,
        users.lname
    FROM
        questions
         inner join users ON users.user_id = questions.user_id
    GROUP BY
        questions.question_id
    ORDER BY
        questions.question_id
    DESC LIMIT $limit $offset");
        return $q->result();
    }

    public function get_answers_count($question_id){
        $q = $this->db->where(['question_id'=>$question_id])
        ->get('answers');
        return $q->num_rows();
    }

    public function get_question($question_id){
        $q = $this->db->where(['question_id'=>$question_id])
        ->get('questions');
        return $q->result();
    }

    public function num_rows(){
        $q = $this->db->select()
        ->from('questions')
        ->get();
        return $q->num_rows();
    }

    public function get_answers($question_id){
        $q = $this->db->query("select 
        answer_id, answer, users.fname, users.lname, users.user_id, question_id, likes, dislikes, files 
        FROM users, answers where users.user_id = answers.user_id and answers.question_id = $question_id");
        return $q->result();
    }

    public function count_answers($question_id){
        $q = $this->db->where(['question_id'=>$question_id])
        ->from('answers')
        ->get();
        return $q->num_rows();
    }

    public function delete_question($question_id){
        return $this->db->delete('questions', ['question_id'=>$question_id]);
    }

    public function update_views($question_id, $ip){
        if(!$this->find_client_ip($question_id, $ip)){
            $this->add_client_ip($question_id, $ip);
            $this->db->set('total_views', 'total_views+1', FALSE);
            $this->db->where(['question_id'=>$question_id]);
            return $this->db->update('questions');
        }
    }

    public function add_client_ip($question_id, $ip){
        return $this->db->insert('client_ip', ['question_id'=>$question_id, 'ip_address '=>$ip]);
    }

    public function find_client_ip($question_id, $ip){
        $q = $this->db->where(['question_id'=>$question_id, 'ip_address '=>$ip])
        ->get('client_ip');
        return $q->num_rows();
    }
}
?>