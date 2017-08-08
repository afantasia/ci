<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
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
		$this->load->model('api_model');
		$this->load->helper('url');
		//debug용 함수입니다 해당 컨트롤러 클래스내에서 debug=inno로 잡게되면나올수있게 처리해두었습니다.
		if ($this->input->get('debug') == 'inno') {
			$this->output->enable_profiler();
		}
	}

	public function index(){
		//api리스트뽑자
		$res=$this->api_model->allData();
		$data['data']=$res['data'];
		//밸리데이션 체크폼입니다.
		$loadResource=array(
			'top'=>array(
				$this->load->loadJs("/resource/mobile/js/vue.min.js"),
			),
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
				$this->load->loadJs("/resource/vendors/starrr/dist/starrr.js"),
			),
		);
		$return=array('loadResource'=>$loadResource,'data'=>$data['data'],'pageTitle'=>'API등록폼');
		$this->load->admintemplate('api/index',$return);
	}
	public function form($idx=null){
		if($idx){
			$data=$this->api_model->getData($idx);
		}else{
			$data['data']=array();
		}

		//밸리데이션 체크폼입니다.
		$loadResource=array(
			'top'=>array(
				$this->load->loadJs("/resource/mobile/js/vue.min.js"),
			),
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
				$this->load->loadJs("/resource/vendors/starrr/dist/starrr.js"),
			),
		);
		$return=array('loadResource'=>$loadResource,'data'=>$data['data'],'pageTitle'=>'API등록폼');
		$this->load->admintemplate('api/form',$return);
	}

	/**
	 * api 등록 프로세스 로직입니다.
	 * URL  : /api/regist/
	 * 파라미터는 post로 넘어갑니다.
	 */
	public function regist(){
		$params=$this->input->post();
		if(isset($params['idx'])){
			$res=$this->api_model->updateData($params);
		}else{
			$res=$this->api_model->insertData($params);
		}
		if($res){
			$return=array('code'=>'0000','msg'=>'처리완료');
		}else{
			$return=array('code'=>'0001','msg'=>'처리실패');
		}
		echo RetJson($return);

	}

}