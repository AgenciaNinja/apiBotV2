<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generic_model extends CI_Model
{
    public function setDb($database = 'default')
    {
        $this->db = $this->load->database($database, TRUE);
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return $this->db->error();
        }
    }

    public function countBy($table = false, $wheres = false, $wheresIn = false)
    {
        $this->db->save_queries = false;
        if (is_array($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where($key, $where);
            }
        }

        if (is_array($wheresIn)) {
            foreach ($wheresIn as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }

        $rows = $this->db->count_all_results($table);
        return $rows > 0 ? $rows : 0;
    }

    public function getOneBy($table, $cond = false)
    {
        $this->db->save_queries = false;
        return ((!$cond) || (!is_array($cond))) ? false : $this->db->get_where($table, $cond)->row();
    }

    public function getMultipleBy($table, $select  = "*", $wheres = false, $wheresIn = false, $joins = false, $limit = false, $orderBy = false, $direction = 'DESC')
    {
        $this->db->save_queries = false;
        if (is_array($select)) {
            foreach ($select as $s) {
                $this->db->select($s);
            }
        } else {
            $this->db->select($select);
        }

        $this->db->from($table);

        if (is_array($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where($key, $where);
            }
        }

        if (is_array($joins)) {
            foreach ($joins as $join) {
                if (isset($join[2])) {
                    $this->db->join($join[0], $join[1], $join[2]);
                } else {
                    $this->db->join($join[0], $join[1]);
                }
            }
        }

        if (($limit !== false) && ($limit > 0)) {
            $this->db->limit($limit);
        }

        if ($orderBy !== false) {
            $this->db->order_by($orderBy, $direction);
        }

        $data = $this->db->get()->result();
        return $data ? $data : false;
    }

    public function update($table, $id, $data, $editables)
    {
        $this->db->save_queries = false;
        $updateStatus = false;
        foreach ($data as $key => $u) {
            $u = $this->clean_input($u);
            if (in_array($key, $editables)) {
                $this->db->where("id", $id)->update(
                    $table,
                    array($key=>$u)
                );
            }
            $updateStatus = true;
        }
        return $updateStatus;
    }

    private function clean_input($u)
    {
        return $u = $this->security->xss_clean(strip_tags(trim($u)));
    }

    public function updateMultiple($table = false, $wheres = false, $wheresIn = false, $data = false)
    {
        $this->db->save_queries = false;
        if (is_array($wheres)) {
            foreach ($wheres as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (is_array($wheresIn)) {
            foreach ($wheresIn as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }

        if (is_array($data)) {
            $this->db->update($table, $data);
            return true;
        }
        return false;
    }

    public function delete($table, $where)
    {
        $this->db->where($where)->delete($table);
    }
}
