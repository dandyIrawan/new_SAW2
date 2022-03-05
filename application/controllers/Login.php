<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function index()
	{
		if ($this->input->post() == NULL) {
			$this->load->view('login_admin');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$cek = $this->db->query("SELECT * FROM user WHERE username='$username' and password='$password' ");
			if ($cek->num_rows() == 1) {
				foreach ($cek->result() as $row) {
					$sess_data['id_user'] = $row->id_user;
					$sess_data['nama'] = $row->nama;
					$sess_data['username'] = $row->username;
					$this->session->set_userdata($sess_data);
				}
				redirect('Administrator');
			} else {
				?>
				<script type="text/javascript">
					alert('Username dan password kamu salah !');
					window.location="<?php echo base_url('Login'); ?>";
				</script>
				<?php
			}

		}
	}

	function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		session_destroy();
		redirect('login');
	}


}
