<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

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
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     * 컨트롤러에서 모델을 호출해서 가져옵니다.
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('demo_model');
        $this->load->helper('url');
        //debug용 함수입니다 해당 컨트롤러 클래스내에서 debug=inno로 잡게되면나올수있게 처리해두었습니다.
        if($this->input->get('debug')=='inno'){
            $this->output->enable_profiler();
        }
    }

    public function index(){
        $loadResource=array(
            'top'=>array($this->load->loadCss("/resource/mobile/css/bootstrap.min.css"),$this->load->loadCss("/resource/mobile/css/cosmo.bootstrap.min.css")),
            'bottom'=>array($this->load->loadJs("/resource/mobile/js/bootstrap.min.js"),),
        );
        $return=array('loadResource'=>$loadResource);
        $this->load->appTemplate('sample',$return);
    }

}
