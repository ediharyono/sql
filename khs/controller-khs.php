	public function khs()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
			$d['judul'] = "Kartu Hasil Studi - Sistem Informasi Akademik Online";
				
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['menu'] = $this->load->view('mahasiswa/menu', '', true);
			$bc['bio'] = $this->load->view('mahasiswa/bio', $bc, true);
			$bc['khs'] = $this->web_app_model->getNilai($bc['nim']);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('mahasiswa/bg_nilai',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
