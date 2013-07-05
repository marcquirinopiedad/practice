<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Model {


	public $mRecords;
	public $rowCount;
	
	public function __construct() {
	
		parent::__construct();
		
		$this->mRecords = "";
		$this->rowCount = "";		
	}
	
	public function select($params) {
	
		$query = $this->db->query($params);
		$this->rowCount = $query->num_rows;
		$this->mRecords = $this->db->query($params)->result();
		return true;
	
	}

	public function reset() {
	
			$this->mRecords = "";
			$this->rowCount = "";
	
	}

}

