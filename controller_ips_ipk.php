//////sks_total/////
public function getskstotal($nim)
{
		$query = $this->db->query("select SUM(sksmktrkrs) as skstotal from rtrkrs where nimhstrkrs = '".$nim."'");
		foreach($query->result() as $value){
			$sks = $value->skstotal;
		}
		return $sks;    
}

//////ipk/////

public function getIpk($nim,$smt_terakhir)
	{
		$query = $this->db->query("select round(SUM((tbl_bobot.bobot * tbl_mk.jum_sks))/ SUM(tbl_mk.jum_sks), 2) as IPK 
		FROM tbl_nilai LEFT JOIN (tbl_mk,tbl_bobot) ON tbl_nilai.kd_mk=tbl_mk.kd_mk
		and tbl_bobot.nilai = tbl_nilai.grade
 		WHERE tbl_nilai.nim='".$nim."' AND tbl_nilai.semester_ditempuh='".$smt_terakhir."' AND tbl_nilai.grade NOT IN('T')");
 		$ipk=0.0;
		foreach($query->result() as $value){
			$ipk = $value->IPK;
		}
		return $ipk;
	}


///////IPS SEMESTER /////
public function import_simak()
	{
///
	$this->load->library('Uuid');	
///
	$this->load->model('rtrkrs/rtrkrs_model','skd');		
	$list = $this->skd->get_rtrkrs_to_rtrakm();
	$this->load->model('rtrakm/rtrakm_model','skw');	
	
	foreach ($list as $skl) {
	    
	$data = array(
//============================================================================================//
    	'kdpsttrakm' => $skl->kdpsttrkrs,	
        	'kdptitrakm' => $skl->kdptitrkrs,		
    	'thsmstrakm' => $skl->thsmstrkrs,	
    	'nimhstrakm' => trim($skl->nimhstrkrs),
    	'sksemtrakm' => $skl->skssem,    	
    	'nlipstrakm' => $skl->bobotsem,    	 
    	'skstttrakm' => $this->getskstotal(trim($skl->nimhstrkrs)),    	     	
//============================================================================================//	
	);
	
	$insert = $this->skw->replace($data);
	}
	
	echo json_encode(array("status" => TRUE));
	}
///
