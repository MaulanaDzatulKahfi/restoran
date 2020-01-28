<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Crud extends CI_Model
{
	public function tampil($table)
	{
		return $this->db->get($table);
	}
	public function tampiljoin($tableawal, $tablekedua,$idgabung, $idutama)
    {
        // SELECT * LEFT JOIN `user` ON `transaksi`.`id_user`=`user`.`id_user` ORDER BY `id_transaksi` DESC
        $query = $this->db->select('*')
                          ->from($tableawal)
                          ->join($tablekedua,''.$tableawal.'.'.$idgabung.'='.$tablekedua.'.'.$idgabung.'','left')
                          ->order_by($idutama, 'DESC')
                          ->get();
        return $query;
    }
	public function tampiljoin_where($tableawal, $tablekedua, $idgabung, $idutama,$idkey,$id)
    {
        $query = $this->db->select('*')
                          ->from($tableawal)
                          ->where($idkey, $id)
                          ->join($tablekedua,''.$tableawal.'.'.$idgabung.'='.$tablekedua.'.'.$idgabung.'','left')
                          ->order_by($idutama, 'DESC')
                          ->get()->result();
        return $query;
    }
}

