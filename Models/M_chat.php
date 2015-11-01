<?php
namespace Models;
use Resources;

class M_chat{

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2015-10-31 22:02:54
	**/

	function __construct(){
		$this->db = new Resources\Database;
		$this->tb_user = "users";
		$this->tb_ngetik = "typing";
		$this->tb_chat = "chats";
		$this->tb_pesan = "msgs";
		$this->tb_pesanLama = "oldMsgs";
	}

    public function semuaUser(){
    	$query = $this->db->select()->from($this->tb_user)->getAll();
    	return $query;
    }

    public function satuUser($id){
        $query = $this->db->select()->from($this->tb_user)->where('id', '=', $id)->getOne();
        return $query;
    }

    public function satuUserAcak($id){
        $query = $this->db->select()->from($this->tb_user)->where('id', '<>', $id, 'AND')->where('inchat','LIKE','N')->orderBy('RAND()')->limit(1)->getOne();
        return $query;
    }

    public function ubahUser($isi=array(),$id=array()){
        $query = $this->db->update($this->tb_user, $isi, $id);
    }

    public function buatUser(){
    	$this->db->insert($this->tb_user, array('inchat'=>'N'));
    	return $this->db->insertId();
    }

    public function keluarChat($id){
		$this->db->delete($this->tb_user, array('id' => $id));
		$this->db->delete($this->tb_chat, array('userId' => $id));
		$this->db->delete($this->tb_chat, array('randomUserId' => $id)); 
    }

    /* Query Chat */
    public function satuChat($userId){
    	$query = $this->db->select()->from($this->tb_chat)->where('userId', '=', $userId)->getOne();
    	return $query;
    }

    public function simpanChat($data=array()){
    	$query = $this->db->insert($this->tb_chat, $data);
    }

    public function ubahChat($isi=array(),$id=array()){
    	$query = $this->db->update($this->tb_chat, $isi, $id); 
    }

    /* Query Pesan */
    public function satuPesan($userId){
    	$query = $this->db->select()->from($this->tb_pesan)->where('randomUserId', '=', $userId)->orderBy('sentdate')->limit(1)->getOne();
    	return $query;
    }

    public function simpanPesan($data=array()){
    	$query = $this->db->insert($this->tb_pesan, $data);
    }

    public function hapusPesan($id){
    	$this->db->delete($this->tb_pesan, array('id' => $id));
    }

    /* Query history pesan */
    public function semuaHisPesan($userId){
    	$query = $this->db->select()->from($this->tb_pesan)->where('userId', '=', $userId, 'OR')->where('randomUserId', '=', $userId)->orderBy('sentdate')->getAll();
    	return $query;
    }

    public function simpanHisPesan($data=array()){
    	$query = $this->db->insert($this->tb_pesanLama, $data);
    }

    /* Query Ngetik */
    public function cekNgetik($id){
    	$query = $this->db->select()->from($this->tb_ngetik)->where('id', '=', $id)->getOne();
    	return $query;
    }

    public function simpanNgetik($data=array()){
    	$query = $this->db->insert($this->tb_ngetik, $data);
    }

    public function hapusNgetik($userId){
    	$this->db->delete($this->tb_ngetik, array('id' => $userId));
    }

}