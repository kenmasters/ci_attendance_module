<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

    private $table = 'users';

    // set column field database for datatable orderable
    var $column_order = array('id', 'last_name');

    //set column field database for datatable searchable
    var $column_search = array('first_name', 'last_name');  

    // default order 
    var $order = array('id' => 'asc'); 

    public function __construct() {
        parent::__construct();
    }

    

    private function _get_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $emp) // loop column 
        {
			if(isset($_GET['search']['value']) && !empty($_GET['search']['value'])){
			$_GET['search']['value'] = $_GET['search']['value'];
		} else
			$_GET['search']['value'] = '';
		if($_GET['search']['value']) // if datatable send POST for search
		{
			if($i===0) // first loop
			{
				$this->db->group_start();
				$this->db->like($emp, $_GET['search']['value']);
			}
			else
			{
				$this->db->or_like($emp, $_GET['search']['value']);
			}

			if(count($this->column_search) - 1 == $i) //last loop
				$this->db->group_end(); //close bracket
		}
		$i++;
		}
		
		if (isset($_GET['order'])) { // here order processing
			$this->db->order_by($this->column_order[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
    }

    public function find($id) {
    	$query = $this->db->get_where($this->table, ['id'=>$id]);
    	if ($query) return $query->row();
    	return false;
    }

    function get_users() {
        $this->_get_query();
		if ( isset($_GET['start']) && $_GET['length'] != -1 ) {
			$_GET['start']	= intval($_GET['start']);
			$_GET['length']	= intval($_GET['length']);
		}

        $this->db->limit($_GET['length'], $_GET['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
		$query = $this->db->select("COUNT(*) as num")->get($this->table);
		$result = $query->row();
		if($result) return $result->num;
		return 0;
    }

}