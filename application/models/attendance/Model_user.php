<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

    private $table = 'users';

    private $filters = [];

    // set column field database for datatable orderable
    private $column_order = array('id', 'last_name');

    //set column field database for datatable searchable
    private $column_search = array('first_name', 'last_name');  

    // default order 
    private $order = array('id' => 'asc'); 

    public function __construct() {
        parent::__construct();
    }

    public function search($search) {
    	if (is_array($search)) {
	    	foreach ($search as $key => $value) {
	    		$this->filters[$key] = $value;
	    	}
    	}
    	return $this;
    }
    

    private function _get_query()
    {
        $this->db->from($this->table);
        
        $i = 0;
        foreach ($this->column_search as $emp) // loop column 
        {
			if(isset($this->filters['search']['value']) && !empty($this->filters['search']['value'])){
			$this->filters['search']['value'] = $this->filters['search']['value'];
		} else
			$this->filters['search']['value'] = '';
		if($this->filters['search']['value']) // if datatable send POST for search
		{
			if($i===0) // first loop
			{
				$this->db->group_start();
				$this->db->like($emp, $this->filters['search']['value']);
			}
			else
			{
				$this->db->or_like($emp, $this->filters['search']['value']);
			}

			if(count($this->column_search) - 1 == $i) //last loop
				$this->db->group_end(); //close bracket
		}
		$i++;
		}
		
		if (isset($this->filters['order'])) { // here order processing
			$this->db->order_by($this->column_order[$this->filters['order']['0']['column']], $this->filters['order']['0']['dir']);
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
		if ( isset($this->filters['start']) && $this->filters['length'] != -1 ) {
			$this->filters['start']	= intval($this->filters['start']);
			$this->filters['length']	= intval($this->filters['length']);
		}

        $this->db->limit($this->filters['length'], $this->filters['start']);
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