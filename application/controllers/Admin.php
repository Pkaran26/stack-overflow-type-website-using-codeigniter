<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index(){
		if($this->session->userdata('admin_id')){
			return redirect('admin/home');
		}
		if($this->form_validation->run('add_user_login_rules')){
			$post = $this->input->post();
			$post['password'] = md5($post['password']);
			$this->load->model('admin_model');
			$admin = $this->admin_model->login($post);
			if($admin){
				$this->session->set_userdata('admin_id', $admin[0]->admin_id);
				return redirect('admin/home');
			}else{
				$this->session->set_flashdata('msg', 'try again!');
				$this->session->set_flashdata('msg_class', 'alert alert-danger');
				return redirect('admin/index');
			}
		}else{
			$this->load->view('admin/login');
		}
	}

	public function home(){
		$this->chklog();
		$this->load->model('question_model');
		$this->load->library('pagination');
		$config=[
			'base_url'=>base_url('admin/home'),
			'per_page'=>10,
			'total_rows'=> $this->question_model->num_rows(),
			'full_tag_open'=>'<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"><div class="btn-group mr-2" role="group" aria-label="First group">',
			'full_tag_close'=>"</div></div>",
			'next_tag_open'=>'<button type="button" class="btn btn-secondary">',
			'next_tag_close'=>'</button>',
			'prev_tag_open'=>'<button type="button" class="btn btn-secondary">',
			'prev_tag_close'=>'</button>',
			'num_tag_open'=>'<button type="button" class="btn btn-secondary">',
			'num_tag_close'=>'</button>',
			'cur_tag_open'=>'<button type="button" class="btn btn-secondary">',
			'cur_tag_close'=>'</button>',
		];
		$this->pagination->initialize($config);
		$questions = $this->question_model->questions_list($config['per_page'], $this->uri->segment(3));
		$this->load->view('admin/home', compact('questions'));
	}

	public function logout(){
		$this->session->unset_userdata('admin_id');
        return redirect('admin/index');
	}

	public function chklog(){
		if(!$this->session->userdata('admin_id')){
			return redirect('admin/index');
		}
	}

	public function viewquestion($question_id){
		$this->chklog();
		$this->load->model('question_model');
		$question = $this->question_model->get_question($question_id);
		$answers = $this->question_model->get_answers($question_id);
		$count_answers = $this->question_model->count_answers($question_id);
		$this->load->view('admin/viewquestion', compact('question', 'answers', 'count_answers'));
	}

	public function deletequestion($question_id){
		$this->chklog();
		$this->load->model('question_model');
		$this->question_model->delete_question($question_id);
		return redirect('admin/home');
	}

	public function deleteanswer($answer_id, $question_id= null){
		$this->chklog();
		$this->load->model('user_model');
		$this->user_model->delete_answers($answer_id);
		return redirect('admin/viewquestion/'.$question_id);
	}

	public function tags(){
		$this->load->model('admin_model');
		$tags = $this->admin_model->get_tags();
		$this->load->view('admin/tags', compact('tags'));
	}

	public function addtags($post){
		$this->load->model('admin_model');
		$tags = $this->admin_model->get_tags();
		$this->load->view('admin/tags', compact('tags'));
	}
}
