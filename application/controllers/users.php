<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	private $user_id = 0;

	public function __construct(){
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}
	public function index(){
		if($this->session->userdata('user_id')){
			return redirect('users/home');
		}
		if($this->form_validation->run('add_user_login_rules')){
			$post = $this->input->post();
			$post['password'] = md5($post['password']);
			$this->load->model('user_model');
			$user = $this->user_model->login($post);
			if($user){
				$this->session->set_userdata('user_id', $user[0]->user_id);
				return redirect('users/home');
			}else{
				$this->session->set_flashdata('msg', 'try again!');
				$this->session->set_flashdata('msg_class', 'alert alert-danger');
				return redirect('users/index');
			}
		}else{
			$this->load->view('users/login');
		}
	}

	public function register(){
		if($this->form_validation->run('add_user_register_rules')){
			$post = $this->input->post();
			if($post['password'] == $post['rpassword']){
				unset($post['rpassword']);
				$post['password'] = md5($post['password']);
				$this->load->model('user_model');
				if($this->user_model->register($post)){
					$this->session->set_flashdata('msg', 'Successfully Registered');
					$this->session->set_flashdata('msg_class', 'alert alert-primary');
					return redirect('users/register');
				}else{
					$this->session->set_flashdata('msg', 'try again!');
					$this->session->set_flashdata('msg_class', 'alert alert-danger');
					return redirect('users/register');
				}
			}else{
				$this->session->set_flashdata('msg', 'password does not matched');
				$this->session->set_flashdata('msg_class', 'alert alert-danger');
				return redirect('users/register');
			}

		}else{
			$this->load->view('users/register');
		}

	}

	public function home(){
		$this->chklog();
		$this->load->model('user_model');
		$user_data = $this->user_model->user_data($this->user_id);
		$this->session->set_userdata('fullname', ucwords($user_data[0]->fname." ".$user_data[0]->lname));
		$top_answers = $this->user_model->get_user_top_ans($this->user_id);
		$this->load->view('users/home', compact('top_answers'));
	}

	public function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('fullname');
        return redirect('users/index');
	}

	public function chklog(){
		if(!$this->user_id){
			return redirect('users/index');
		}
	}

	public function addquestion(){
		$this->chklog();
		$this->load->model('user_model');
		$this->load->model('admin_model');
		if($this->form_validation->run('add_question_rules')){
			$post = $this->input->post();
			if($this->user_model->add_question($post)){
				$this->session->set_flashdata('msg', 'Question Submitted');
				$this->session->set_flashdata('msg_class', 'alert alert-success');
				return redirect('users/addquestion');
			}else{
				$this->session->set_flashdata('msg', 'Try again!');
				$this->session->set_flashdata('msg_class', 'alert alert-danger');
				return redirect('users/addquestion');
			}
		}else{
			$tags = $this->admin_model->get_tags();
			$user_data = $this->user_model->user_data($this->user_id);
			$this->load->view('users/addquestion', compact('user_data', 'tags'));
		}
	}

	public function viewquestion($question_id){
		$this->load->model('question_model');
		$this->load->model('user_model');
		if($this->form_validation->run('add_answer_rules')){
			$this->chklog();
			$post = $this->input->post();
			if($this->user_model->add_answer($post)){
				$this->session->set_flashdata('msg', 'Answer Submitted');
				$this->session->set_flashdata('msg_class', 'alert alert-success');
			}else{
				$this->session->set_flashdata('msg', 'Try again!');
				$this->session->set_flashdata('msg_class', 'alert alert-danger');
			}
			return redirect('questions/viewquestion/'.$question_id);
		}else{
			$question = $this->question_model->get_question($question_id);
			$answers = $this->question_model->get_answers($question_id);
			$this->load->view('questions/viewquestion/'.$question_id, compact('question', 'answers'));
		}
	}

	public function deleteanswer($answer_id, $question_id= null){
		$this->chklog();
		$this->load->model('user_model');
		$this->user_model->delete_answers($answer_id);
		if($question_id){
			return redirect('questions/viewquestion/'.$question_id);
		}
		return redirect('users/home');
	}

	public function like($answer_id,$question_id){
		$this->chklog();
		$this->load->model('user_model');
		$this->user_model->qlike($answer_id, $this->user_id);
		return redirect('questions/viewquestion/'.$question_id);
	}

	public function dislike($answer_id,$question_id){
		
		$this->load->model('user_model');
		$this->user_model->qdislike($answer_id, $this->user_id);
		return redirect('questions/viewquestion/'.$question_id);
	}

	public function deletequestion($question_id){
		$this->chklog();
		$this->load->model('question_model');
		$this->question_model->delete_question($question_id);
		return redirect('questions/index');
	}
}