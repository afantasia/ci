<?php
/**
 * Created by PhpStorm.
 * User: doraemon01
 * Date: 2017-04-25
 * Time: 오후 5:27
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Coco extends CI_Controller {

        public function index(){
            $this->load->view('/Coco/header');
            $this->load->view('/Coco/little');
            $this->load->view('/Coco/footer');
            $this->load->helper('password');
        }

        public function Little($parameter)
        {
            echo "Coco 안에 Little " . $parameter . " 입니다.";
        }


}
?>