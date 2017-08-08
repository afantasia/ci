<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name></method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * 컨트롤러에서 모델을 호출해서 가져옵니다.
	 */
	public function __construct(){
		parent::__construct();

		$this->load->model('member_model');
		$this->load->library('encryption');
		$this->load->helper('url');
		//debug용 함수입니다 해당 컨트롤러 클래스내에서 debug=inno로 잡게되면나올수있게 처리해두었습니다.
		if($this->input->get('debug')=='inno'){
			$this->output->enable_profiler();
		}
		$this->load->library('session');
	}
	public function index(){
		redirect("/admin/member/lists/user");
	}
	/**
	 *회원 리스트입니다
	 */
	public function Lists($type='user'){
		$loadResource=array(
			'top'=>array($this->load->loadCss("/resource/admin/vendors/iCheck/skins/flat/green.css"),),
			'bottom'=>array($this->load->loadJs("/resource/admin/vendors/iCheck/skins/flat/green.css"),),
		);

		$page  = $this->input->get('page');
		$key  = $this->input->get('key');
		$keyword  = $this->input->get('keyword');
		if ($page < 1)	$page = 1;

		$page_rows = '2';
		$offset = ($page - 1) * $page_rows;

		$total_count = $this->member_model->get_list_count($key, $keyword);
		$result = $this->member_model->get_list($page_rows, $offset, $key, $keyword);
		$list = array();

		if(count($result) > 0){
			foreach ( $result as $a => $arow ){
				$list[$a] = $arow;
			}
		}else{
			$list = array();
		}

		$config['suffix']      = '&key='.$key.'&keyword='.base64_encode($keyword);
		$config['base_url']    = '/admin/member/lists/'.$type.'?';
		$config['prefix'] = "";
		$config['per_page']    = $page_rows;
		$config['total_rows']  = $total_count;
		$config['page_query_string'] = true;
		// style
		$config['full_tag_open']  = "<div id='pagination'>";
		$config['full_tag_close'] = '</div>';
		// 현재 페이지
		$config['cur_tag_open']  = "<span class='current'>";
		$config['cur_tag_close'] = '</span>';

		$CI =& get_instance();
		$CI->load->library('pagination');
		$CI->pagination->initialize($config);

		$return=array('loadResource'=>$loadResource, 'datas'=>$list, 'datas_count'=>count($result), 'paging' => $CI->pagination->create_links());
		$this->load->admintemplate('admin/member_list',$return);

	}

	/**
	 * @param null $idx
	 * 회원정보보기 리스트입니다 /admin/member/form/users.idx
	 */
	public function Form($idx=null){
		if($idx){
			$data=$this->member_model->getData($idx);
		}else{
			$data['data']=array();
		}
		//밸리데이션 체크폼입니다.
		$loadResource=array(
			'bottom'=>array(
					$this->load->loadJs("/resource/admin/vendors/validator/validator.js"),
					$this->load->loadJs("/resource/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"),
					$this->load->loadJs("/resource/admin/vendors/moment/min/moment.min.js"),
					$this->load->loadJs("/resource/admin/vendors/bootstrap-daterangepicker/daterangepicker.js"),
					$this->load->loadJs("/resource/admin/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"),/*bootstrap-wysiwyg*/
					$this->load->loadJs("/resource/admin/vendors/jquery.hotkeys/jquery.hotkeys.js"),/*bootstrap-wysiwyg*/
					$this->load->loadJs("/resource/admin/vendors/google-code-prettify/src/prettify.js"),/*bootstrap-wysiwyg*/
					$this->load->loadJs("/resource/admin/vendors/jquery.tagsinput/src/jquery.tagsinput.js"),
					$this->load->loadJs("/resource/admin/vendors/switchery/dist/switchery.min.js"),
					$this->load->loadJs("/resource/admin/vendors/select2/dist/js/select2.full.min.js"),
					$this->load->loadJs("/resource/admin/vendors/autosize/dist/autosize.min.js"),
					$this->load->loadJs("/resource/admin/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"),
					$this->load->loadJs("/resource/vendors/starrr/dist/starrr.js"),
				),
		);
		$return=array('loadResource'=>$loadResource,'data'=>$data['data'],'pageTitle'=>'회원관리폼레이아웃');
		$this->load->admintemplate('admin/form',$return);
	}

}
