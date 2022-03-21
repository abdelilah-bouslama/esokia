<?php
class Todo_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_todo()
    {
        $query = $this->db->get('todo');
        return $query->result_array();
    }

    public function get_todo($id = 0)
    {
        $query = $this->db->get_where('todo', array('id' => (int)$id));
        return $query->row_array();
    }

    public function set_todo($data)
    {
        if ($data['id']) {
            $this->db->where('id', (int)$data['id']);
            return $this->db->update('todo', $data);
        }

        return $this->db->insert('todo', $data);
    }

    public function delete_all_completed()
    {
        $this->db->where('completed', 1);
        return $this->db->delete('todo');
    }

}