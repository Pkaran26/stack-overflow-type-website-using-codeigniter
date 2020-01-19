<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller {
	public function index(){
		$this->load->model('question_model');
		$top_questions = $this->question_model->top_questions();
		$this->load->view('questions/question', compact('top_questions'));
	}

	public function questionlist(){
		$this->load->model('question_model');
		$this->load->library('pagination');
		$config=[
			'base_url'=>base_url('questions/questionlist'),
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
		$this->load->view('questions/questionlist', compact('questions'));
	}

	public function viewquestion($question_id){
		$this->load->model('question_model');
		$question = $this->question_model->get_question($question_id);
		$answers = $this->question_model->get_answers($question_id);
		$count_answers = $this->question_model->count_answers($question_id);
		$this->question_model->update_views($question_id, $this->get_client_ip());
		$this->load->view('questions/viewquestion', compact('question', 'answers', 'count_answers'));
	}

	public function ans_count($question_id){
		$this->load->model('question_model');
		echo $this->question_model->get_answers_count($question_id);
	}

	protected function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	
}
