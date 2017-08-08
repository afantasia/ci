<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * 컨트롤러에서 모델을 호출해서 가져옵니다.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');

		//debug용 함수입니다 해당 컨트롤러 클래스내에서 debug=inno로 잡게되면나올수있게 처리해두었습니다.
		if ($this->input->get('debug') == 'inno') {
			$this->output->enable_profiler();
		}

		$config['upload_path']  = './data';  // 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		$config['allowed_types']  = 'gif|jpg|png';  // git,jpg,png 파일만 업로드를 허용한다.
		$config['max_size']   = '0';     // 허용되는 파일의 최대 사이즈
		$config['max_width']   = '0';     // 이미지인 경우 허용되는 최대 폭
		$config['max_height']   = '0';     // 이미지인 경우 허용되는 최대 높이
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
	}
	/**
	 * 더미로직입니다
	 */
	public function index(){
		//밸리데이션 체크폼입니다.
		$loadResource=array(
			'top'=>array(
				$this->load->loadJs("/resource/mobile/js/vue.min.js"),
				$this->load->loadCss("/resource/admin/vendors/dropzone/dist/min/dropzone.min.css")
			),
			'bottom'=>array(
				//$this->load->loadJs("/resource/admin/vendors/dropzone/dist/min/dropzone.min.js")
			),
		);
		$return=array('loadResource'=>$loadResource,'pageTitle'=>'API등록폼');
		$this->load->admintemplate('api/file',$return);
	}
	/**
	 * 파일 업로드 프로세스 로직
	 * /file/upload
	 */
	public function upload(){

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			$return=['code'=>'0001','msg'=>'뭔가 된건가','data'=>$this->upload->display_errors()];
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$return=['code'=>'0000','msg'=>'뭔가 된건가','data'=>$this->upload->data()];

		}

		echo RetJson($return);
	}
	function file_upload($upload_path , $allowed_types , $filename , $redirect)
	{
		$ci = & get_instance();

		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $allowed_types;
		// $config['max_size'] = 1024;//1mb
		// $config['max_width'] = 1024;
		// $config['max_height'] = 1024;

		$ci->load->library('upload', $config);
		$data = NULL;
		if (!$ci->upload->do_upload($filename)) {
			error_log("within the file");
//          $error = array('error' => $ci->upload->display_errors());
			error_log($ci->upload->display_errors());
			$ci->session->set_userdata('img_errors', $ci->upload->display_errors());
			//error_log(print_r($ci->upload->display_errors(),true));
			// redirect(base_url() . $redirect);
		} else {
			error_log("uploading");
			$data = array('upload_data' => $ci->upload->data());
			// do_resize($config['upload_path'] , $data['upload_data']['file_name']);
		}

		return $config['upload_path'] . $data['upload_data']['file_name'];
	}
}
