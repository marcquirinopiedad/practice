<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends CI_Controller {
	private $_mConfig;
	public function __construct() {
	
		parent::__construct();
		$this->load->model('data','',TRUE);
		//$this->load->helper('url');
		//$this->_mConfig = array('full_tag_open' => '<div class="pagination"><ul>', 'full_tag_close' => '</ul></div>', 'first_link' => '&laquo;First', 'first_tag_open'=>'<li class="prev page">', 'first_tag_close'=>'</li>', 'last_link' => 'Last', 'next_link' => '»', 'prev_link' => '«');
	}

	public function index() {
	
		echo anchor('exam/items/','View Items') ;
		echo "<br />";
		echo anchor('exam/persons/','View Persons with Last Name Chen');
		echo "<br />";
		echo anchor('exam/orders/','View Orders');
	}
	
	public function items() {
	
	$params = "SELECT * from items";
		
		$this->data->select($params);
		$data['datas'] = $this->data->mRecords;
		$this->load->view('item_view.php', $data);
	
	}
	
	public function persons() {
		
		$params = "SELECT * from persons WHERE s_last_name = 'Chen'";
		$this->data->select($params);		
		$data['datas'] = $this->data->mRecords;
		$this->load->view('person.php', $data);
	}
	
	public function orders() {
	// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("index.php/exam/orders");
		$config['total_rows'] = $this->db->query("SELECT orders.i_item_id,persons.s_first_name,persons.s_last_name,items.s_name,orders.i_order_quantity 
		FROM orders 
		LEFT JOIN persons ON orders.i_person_id=persons.i_id 
		LEFT JOIN items ON orders.i_item_id=items.i_id 
		ORDER BY orders.i_item_id")->num_rows();
		$config['per_page'] = 2;
		$config['num_links'] = 2;
		$config['uri_segment'] = 3;
		$last = ($this->uri->segment($config['uri_segment']))?$this->uri->segment($config['uri_segment']): 0 ;
		$last_row=  (int)$config['total_rows'] / $config['per_page'];
		$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul><li class="prev page"><a href="'. base_url().'index.php/exam/orders" >First</a></li>';
		$config['full_tag_close'] = '<li class="prev page"><a href="'. base_url().'index.php/exam/orders/'.ceil($last_row) .'" >Last</a></li></ul></div><!--pagination-->';
 
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page disabled">';
		$config['first_tag_close'] = '</li>';
 
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
 
$config['next_link'] = '&rarr;';
$config['next_tag_open'] = '<li class="next page">';
$config['next_tag_close'] = '</li>';
 
$config['prev_link'] = '&larr;';
$config['prev_tag_open'] = '<li class="prev page">';
$config['prev_tag_close'] = '</li>';
 
$config['cur_tag_open'] = '<li class="active"><a href="">';
$config['cur_tag_close'] = '</a></li>';
 
$config['num_tag_open'] = '<li class="page">';
$config['num_tag_close'] = '</li>';
		//$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		
	$num = ($this->uri->segment($config['uri_segment']))?$this->uri->segment($config['uri_segment']): 0;
	$params = "SELECT orders.i_item_id,persons.s_first_name,persons.s_last_name,items.s_name,orders.i_order_quantity 
		FROM orders 
		LEFT JOIN persons ON orders.i_person_id=persons.i_id 
		LEFT JOIN items ON orders.i_item_id=items.i_id 
		ORDER BY orders.i_item_id LIMIT ".$num .",".$config['per_page']."";
		
		$this->data->select($params);	
		$data['datas'] = $this->data->mRecords;
		$this->load->view('order_view.php', $data);
	}
	
	public function search() {
		//echo "working";
		//die();
		$search = $this->input->post('search');
		$type = $this->input->post('type');
		
		//echo $search . $type;
		
		if($type == "person"){
		
		$params = "SELECT orders.i_item_id,persons.s_first_name,persons.s_last_name,items.s_name,orders.i_order_quantity 
		FROM orders 
		LEFT JOIN persons ON orders.i_person_id=persons.i_id 
		LEFT JOIN items ON orders.i_item_id=items.i_id 
		WHERE concat(persons.s_first_name,' ',persons.s_last_name) LIKE '%".$search . "%' 
		ORDER BY orders.i_item_id";
		
		$this->data->select($params);	
		$row = $this->data->rowCount;
		if($row > 0){
			$data['datas'] = $this->data->mRecords;
	
			$this->load->view('ajax_result.php', $data);
		
		}
		else{
		echo "NO RESULT";
		
		}
		
		
		}else {
		
		$params = "SELECT orders.i_item_id,persons.s_first_name,persons.s_last_name,items.s_name,orders.i_order_quantity 
		FROM orders 
		LEFT JOIN persons ON orders.i_person_id=persons.i_id 
		LEFT JOIN items ON orders.i_item_id=items.i_id 
		WHERE items.s_name LIKE '%" . $search . "%'
		ORDER BY orders.i_item_id";
		
		$this->data->select($params);	
		$row = $this->data->rowCount;
		if($row > 0){
			$data['datas'] = $this->data->mRecords;
	
			$this->load->view('ajax_result.php', $data);
		
		}
		else{
		echo "NO RESULT";
		
		}
		}
		

	
	}
}