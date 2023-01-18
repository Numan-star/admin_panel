<?php
defined('BASEPATH') or exit('No direct script access allowed');

class welcome extends CI_Controller
{

	public $login = false;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('main_model');
		$this->load->model('user_modal');
	}

	public function signIn()
	{
		if ($this->input->post('signIn')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == false) {
				$this->load->view('dashboard/login');
			} else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$result = $this->main_model->forLogin($username);
				$num = $result->num_rows();
				$row = $result->row_array();
				if ($num == 1) {
					if (password_verify($password, $row['password'])) {
						$this->session->set_userdata('username', $username);
						$this->session->set_userdata('imgpath', $row['imgpath']);
						$this->session->set_userdata('id', $row['id']);
						$this->session->set_userdata('loggedin', $this->login = true);
						redirect(base_url() . 'welcome');
					} else {
						$this->session->set_flashdata('failure', 'Wrong Password!');
						$this->load->view('dashboard/login');
					}
				} else {
					$this->session->set_flashdata('failure', 'Wrong Username!');
					$this->load->view('dashboard/login');
				}
			}
		} else {
			$this->load->view('dashboard/login');
		}
	}

	public function signUp()
	{
		if ($this->input->post('signUp')) {
			$this->form_validation->set_rules('username', 'UserName', 'trim|required|is_unique[signup.username]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
			$this->form_validation->set_rules('date', 'Date', 'required');
			// $this->form_validation->set_rules('userfile', 'Userfile', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tnt.email]');
			if ($this->form_validation->run() == false) {
				$this->load->view('dashboard/signUp');
			} else {
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png';
				// $config['max_size']             = 100;
				// $config['max_width']            = 1024;
				// $config['max_height']           = 768;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('userfile')) {
					$this->session->set_flashdata('failure', $this->upload->display_errors());
					$this->load->view('dashboard/signUp');
				} else {
					$upload_data = $this->upload->data();
					$password = $this->input->post('password');
					$data['username'] = trim($this->input->post('username'));
					$data['email'] = trim($this->input->post('email'));
					$data['dateofbirth'] = trim($this->input->post('date'));
					$data['password'] = password_hash($password, PASSWORD_DEFAULT);
					$data['imgpath'] = 	$upload_data['file_name'];
					$response = $this->main_model->signUprecords($data);
					$this->session->set_flashdata('success', 'Your account is created now you can login!');
					redirect(base_url() . 'welcome/signUp');
				}
			}
		} else {
			$this->load->view('dashboard/signUp');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('loggedin');
		redirect(base_url() . 'welcome/signIn');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['loggedin'] = $this->session->userdata('loggedin');
		$data['imgpath'] = $this->session->userdata('imgpath');
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/section');
		$this->load->view('dashboard/footer');
	}

	public function insert()
	{

		if ($this->input->post('save')) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required', array(
				'required' => 'Name is required'
			));
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tnt.email]', array(
				'required' => 'Email is required',
				'valid_email' => 'Email is not valid',
				'is_unique' => 'Email already exist choice another email'
			));
			$this->form_validation->set_rules('phoneNumber', 'PhoneNumber', 'trim|required|min_length[10]|max_length[11]', array(
				'required' => 'PhoneNumber is required'
			));

			if ($this->form_validation->run() == false) {
				$this->load->library('pagination');
				$config['base_url'] = base_url() . 'welcome/insert';
				$config['total_rows'] = $this->user_modal->totalrows();
				$config['per_page'] = 6;
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = 'Start';
				$config['first_tag_open'] = '<li class="page-link">';
				$config['first_tag_close'] = '</li>';
				$config['last_link'] = 'End';
				$config['last_tag_open'] = '<li class="page-link">';
				$config['last_tag_close'] = '</li>';
				$config['next_tag_open'] = '<li class="page-link">';
				$config['next_tag_close'] = '</li>';
				$config['prev_tag_open'] = '<li class="page-link">';
				$config['prev_tag_close'] = '</li>';
				$config['num_tag_open'] = '<li class="page-link">';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="page-item"><a class="page-link bg-dark">';
				$config['cur_tag_close'] = '</a></li>';

				$this->pagination->initialize($config);
				$users = $this->user_modal->all($config['per_page'], $this->uri->segment(3));
				$data = array();
				$data['users'] = $users;
				$data['username'] = $this->session->userdata('username');
				$data['loggedin'] = $this->session->userdata('loggedin');
				$data['imgpath'] = $this->session->userdata('imgpath');
				$this->load->view('dashboard/header', $data);
				$this->load->view('dashboard/main', $data);
				$this->load->view('dashboard/footer');
			} else {
				$formArray  = array();
				$formArray['pname'] = $this->input->post('name');
				$formArray['email'] = $this->input->post('email');
				$formArray['phoneNumber'] = $this->input->post('phoneNumber');
				$this->user_modal->create($formArray);
				$this->session->set_flashdata('success', 'Record added successfully!');
				redirect(base_url() . 'welcome/insert');
			}
		} else {
			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'welcome/insert';
			$config['total_rows'] = $this->user_modal->totalrows();
			$config['per_page'] = 6;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = 'Start';
			$config['first_tag_open'] = '<li class="page-link">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'End';
			$config['last_tag_open'] = '<li class="page-link">';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="page-link">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-link">';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li class="page-link">';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-link bg-info"><a>';
			$config['cur_tag_close'] = '</a></li>';


			$this->pagination->initialize($config);
			$users = $this->user_modal->all($config['per_page'], $this->uri->segment(3));
			$data = array();
			$data['users'] = $users;
			$data['username'] = $this->session->userdata('username');
			$data['loggedin'] = $this->session->userdata('loggedin');
			$data['imgpath'] = $this->session->userdata('imgpath');
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/main', $data);
			$this->load->view('dashboard/footer');
		}
	}

	public function edit($userId)
	{

		if ($this->input->post('update')) {

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phoneNumber', 'PhoneNumber', 'required');
			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'welcome/edit/' . $userId;
			$config['total_rows'] = $this->user_modal->totalrows();
			$config['per_page'] = 4;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = 'Start';
			$config['first_tag_open'] = '<li class="page-link">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'End';
			$config['last_tag_open'] = '<li class="page-link">';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="page-link">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-link">';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li class="page-link">';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item"><a class="page-link bg-dark">';
			$config['cur_tag_close'] = '</a></li>';

			$this->pagination->initialize($config);
			$data = array();
			$users = $this->user_modal->all($config['per_page'], $this->uri->segment(4));
			$user = $this->user_modal->getUser($userId);
			$data['users'] = $users;
			$data['user'] = $user;
			if ($this->form_validation->run() == false) {
				$data['username'] = $this->session->userdata('username');
				$data['loggedin'] = $this->session->userdata('loggedin');
				$data['imgpath'] = $this->session->userdata('imgpath');
				$this->load->view('dashboard/header', $data);
				$this->load->view('dashboard/edit', $data);
				$this->load->view('dashboard/footer');
			} else {
				$formArray  = array();
				$formArray['pname'] = $this->input->post('name');
				$formArray['email'] = $this->input->post('email');
				$formArray['phoneNumber'] = $this->input->post('phoneNumber');
				$this->user_modal->updateUser($userId, $formArray);
				$this->session->set_flashdata('success', 'Record updated successfully!');
				redirect(base_url() . 'welcome/insert');
			}
		} else {
			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'welcome/edit/' . $userId;
			$config['total_rows'] = $this->user_modal->totalrows();
			$config['per_page'] = 8;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = 'Start';
			$config['first_tag_open'] = '<li class="page-link">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'End';
			$config['last_tag_open'] = '<li class="page-link">';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="page-link">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-link">';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li class="page-link">';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item"><a class="page-link bg-dark">';
			$config['cur_tag_close'] = '</a></li>';

			$this->pagination->initialize($config);
			$data = array();
			$users = $this->user_modal->all($config['per_page'], $this->uri->segment(4));
			$user = $this->user_modal->getUser($userId);
			$data['users'] = $users;
			$data['user'] = $user;
			$data['username'] = $this->session->userdata('username');
			$data['loggedin'] = $this->session->userdata('loggedin');
			$data['imgpath'] = $this->session->userdata('imgpath');
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/edit', $data);
			$this->load->view('dashboard/footer');
		}
	}

	public function show($userId)
	{

		$user = $this->user_modal->getUser($userId);
		$data['user'] = $user;
		$data['username'] = $this->session->userdata('username');
		$data['loggedin'] = $this->session->userdata('loggedin');
		$data['imgpath'] = $this->session->userdata('imgpath');
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/modal', $data);
		$this->load->view('dashboard/footer');
	}

	public function delete($userId)
	{
		$this->user_modal->deleteUser($userId);
		$this->session->set_flashdata('failure', 'Record deleted successfully!');
		redirect(base_url() . 'welcome/insert');
	}

	public function calender()
	{
		$data = array(
			'year' => $this->uri->segment(3),
			'month' => $this->uri->segment(4)
		);

		// Creating template for table
		$prefs['template'] = '
        {div_open}<div>{/div_open}
            {table_open}<table cellpadding="1" cellspacing="3">{/table_open}
            
            {heading_row_start}<tr>{/heading_row_start}
            
            {heading_previous_cell}<th class="prev_sign"><a href="{previous_url}">&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th class="next_sign"><a href="{next_url}">&gt;</a></th>{/heading_next_cell}
            
            {heading_row_end}</tr>{/heading_row_end}
            
            //Deciding where to week row start
            {week_row_start}<tr class="week_name" >{/week_row_start}
            //Deciding  week day cell and  week days
            {week_day_cell}<td >{week_day}</td>{/week_day_cell}
            //week row end
            {week_row_end}</tr>{/week_row_end}
            
            {cal_row_start}<tr>{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}
            
            {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
            {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
            
            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
            
            {cal_cell_blank}&nbsp;{/cal_cell_blank}
            
            {cal_cell_end}</td>{/cal_cell_end}
            {cal_row_end}</tr>{/cal_row_end}
            
            {table_close}</table>{/table_close}
            {div_close}</div>{/div_close}
            ';

		$prefs['day_type'] = 'short';
		$prefs['show_next_prev'] = TRUE;
		$prefs['show_other_days'] = TRUE;
		$prefs['next_prev_url'] = 'http://localhost/admin_panel/Welcome/calender';

		$this->load->library('calendar', $prefs);
		$data['username'] = $this->session->userdata('username');
		$data['loggedin'] = $this->session->userdata('loggedin');
		$data['imgpath'] = $this->session->userdata('imgpath');
		$this->load->view('dashboard/header', $data);
		$this->load->view('calender_show');
		$this->load->view('dashboard/footer');
	}

	public function email()
	{

		// if ($this->input->post('email')) {
		// 	// Load PHPMailer library
		// 	$this->load->library('phpmailer_lib');

		// 	// PHPMailer object
		// 	$mail = $this->phpmailer_lib->load();

		// 	// SMTP configuration
		// 	$mail->isSMTP();
		// 	$mail->Host     = 'smtp.gmail.com';
		// 	$mail->SMTPAuth = true;
		// 	$mail->Username = '5125.2019.gct@gmail.com';
		// 	$mail->Password = 'numan786$';
		// 	$mail->SMTPSecure = 'tls';
		// 	$mail->Port     = 587;

		// 	$mail->setFrom('5125.2019.gct@gmail.com', 'CodexWorld');
		// 	$mail->addReplyTo('mn416292@gmail.com', 'CodexWorld');

		// 	// Add a recipient
		// 	$mail->addAddress('5125.2019.gct@gmail.com');

		// 	// Add cc or bcc 
		// 	// $mail->addCC('cc@example.com');
		// 	// $mail->addBCC('bcc@example.com');

		// 	// Email subject
		// 	$mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';

		// 	// Set email format to HTML
		// 	$mail->isHTML(true);

		// 	// Email body content
		// 	$mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
		// <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
		// 	$mail->Body = $mailContent;

		// 	// Send email
		// 	if (!$mail->send()) {
		// 		echo 'Message could not be sent.';
		// 		echo 'Mailer Error: ' . $mail->ErrorInfo;
		// 	} else {
		// 		echo 'Message has been sent';
		// 	}
		// } else {
		// 	$data['username'] = $this->session->userdata('username');
		// 	$data['loggedin'] = $this->session->userdata('loggedin');
		// 	$data['imgpath'] = $this->session->userdata('imgpath');
		// 	$this->load->view('dashboard/header', $data);
		// 	$this->load->view('email');
		// 	$this->load->view('dashboard/footer');
		// }


		if ($this->input->post('email')) {
			$this->form_validation->set_rules('to', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('subject', 'Subject', 'required|min_length[10]|max_length[20]');
			$this->form_validation->set_rules('message', 'Message', 'required');
			if ($this->form_validation->run() == false) {
				$data['username'] = $this->session->userdata('username');
				$data['loggedin'] = $this->session->userdata('loggedin');
				$data['imgpath'] = $this->session->userdata('imgpath');
				$this->load->view('dashboard/header', $data);
				$this->load->view('email');
				$this->load->view('dashboard/footer');
			} else {
				$to = $this->input->post('to');
				$subject = $this->input->post('subject');
				$message = $this->input->post('message');
				$this->load->library('email');


				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_timeout' => 30,
					'smtp_port' => 465,
					'smtp_user' => '5125.2019.gct@gmail.com',
					'smtp_pass' => 'numan786$',
					'charset' => 'utf-8',
					'mailtype' => 'html',
					'newline' => "\r\n"
				);

				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->set_crlf("\r\n");
				$this->email->to($to);
				$this->email->from("5125.2019.gct@gmail.com", "Numan");
				$this->email->subject($subject);
				$this->email->message($message);

				if ($this->email->send()) {
					$this->session->set_flashdata('success', 'Email Sent successfully!');
					redirect(base_url() . 'welcome/email');
				} else {
					$this->session->set_flashdata('failure', 'Email Not Sent!');
					redirect(base_url() . 'welcome/email');
					// print_r($this->email->print_debugger());
				}
			}
		} else {
			$data['username'] = $this->session->userdata('username');
			$data['loggedin'] = $this->session->userdata('loggedin');
			$data['imgpath'] = $this->session->userdata('imgpath');
			$this->load->view('dashboard/header', $data);
			$this->load->view('email');
			$this->load->view('dashboard/footer');
		}
	}

	public function changepass()
	{
		if ($this->input->post('changepass')) {

			$this->form_validation->set_rules('oldpass', 'Old Password', 'required');
			$this->form_validation->set_rules('newpass', 'New Password', 'required');
			$this->form_validation->set_rules('confpass', 'Confirm Password', 'required|matches[newpass]');

			if ($this->form_validation->run() == false) {
				$data['username'] = $this->session->userdata('username');
				$data['loggedin'] = $this->session->userdata('loggedin');
				$data['imgpath'] = $this->session->userdata('imgpath');
				$this->load->view('dashboard/header', $data);
				$data['id'] = $this->session->userdata('id');
				$this->load->view('change_password', $data);
				$this->load->view('dashboard/footer');
			} else {
				$id = $this->input->post('id');
				$confpass = $this->input->post('confpass');
				$oldpass = $this->input->post('oldpass');
				$newpass = $this->input->post('newpass');
				$new = password_hash($newpass, PASSWORD_DEFAULT);
				$row = $this->main_model->getSignupUser($id);

				if (password_verify($oldpass, $row['password'])) {
					$this->main_model->updatepass($new, $row['id']);
					$this->session->set_flashdata('success', 'Password updated successfully!');
					redirect(base_url() . 'welcome/changepass');
					// $confpass = "";
					// $oldpass = "";
					// $newpass = "";

					// $data['username'] = $this->session->userdata('username');
					// $data['loggedin'] = $this->session->userdata('loggedin');
					// $data['imgpath'] = $this->session->userdata('imgpath');
					// $this->load->view('dashboard/header', $data);
					// $data['id'] = $this->session->userdata('id');
					// $this->load->view('change_password', $data);
					// $this->load->view('dashboard/footer');
				} else {
					$this->session->set_flashdata('failure', 'Old Password not match');
					redirect(base_url() . 'welcome/changepass');

					// $data['username'] = $this->session->userdata('username');
					// $data['loggedin'] = $this->session->userdata('loggedin');
					// $data['imgpath'] = $this->session->userdata('imgpath');
					// $this->load->view('dashboard/header', $data);
					// $data['id'] = $this->session->userdata('id');
					// $this->load->view('change_password', $data);
					// $this->load->view('dashboard/footer');
				}
			}
		} else {
			$data['username'] = $this->session->userdata('username');
			$data['loggedin'] = $this->session->userdata('loggedin');
			$data['imgpath'] = $this->session->userdata('imgpath');
			$this->load->view('dashboard/header', $data);
			$data['id'] = $this->session->userdata('id');
			$this->load->view('change_password', $data);
			$this->load->view('dashboard/footer');
		}
	}

	public function convert()
	{

		if ($this->input->post('convert')) {
			$amount = $this->input->post('amount');
			$cur1 = $this->input->post('cur1');
			$cur2 = $this->input->post('cur2');
			if ($cur1 == "USD" and $cur2 == "INR") {
				$data['username'] = $this->session->userdata('username');
				$data['loggedin'] = $this->session->userdata('loggedin');
				$data['imgpath'] = $this->session->userdata('imgpath');
				$this->load->view('dashboard/header', $data);
				$this->result = $amount * 81.56 . " " . $cur2;
				$data['amount'] = $this->result;
				$this->load->view('currency', $data);
				$this->load->view('dashboard/footer');
			}
			if ($cur1 == "AUD" and $cur2 == "INR") {
				$data['username'] = $this->session->userdata('username');
				$data['loggedin'] = $this->session->userdata('loggedin');
				$data['imgpath'] = $this->session->userdata('imgpath');
				$this->load->view('dashboard/header', $data);
				$this->result = $amount * 55.18 . " " . $cur2;
				$data['amount'] = $this->result;
				$this->load->view('currency', $data);
				$this->load->view('dashboard/footer');
			}
			if ($cur1 == "AUD" and $cur2 == "PAK") {
				$data['username'] = $this->session->userdata('username');
				$data['loggedin'] = $this->session->userdata('loggedin');
				$data['imgpath'] = $this->session->userdata('imgpath');
				$this->load->view('dashboard/header', $data);
				$this->result = $amount * 151.85 . " " . $cur2;
				$data['amount'] = $this->result;
				$this->load->view('currency', $data);
				$this->load->view('dashboard/footer');
			}
			if ($cur1 == "USD" and $cur2 == "PAK") {
				$data['username'] = $this->session->userdata('username');
				$data['loggedin'] = $this->session->userdata('loggedin');
				$data['imgpath'] = $this->session->userdata('imgpath');
				$this->load->view('dashboard/header', $data);
				$this->result = $amount * 224.34 . " " . $cur2;
				$data['amount'] = $this->result;
				$this->load->view('currency', $data);
				$this->load->view('dashboard/footer');
			}
		} else {
			$data['username'] = $this->session->userdata('username');
			$data['loggedin'] = $this->session->userdata('loggedin');
			$data['imgpath'] = $this->session->userdata('imgpath');
			$this->load->view('dashboard/header', $data);
			$data['amount'] = "";
			$this->load->view('currency', $data);
			$this->load->view('dashboard/footer');
		}
	}
}
