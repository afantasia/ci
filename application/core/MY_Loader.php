<?php
class MY_Loader extends CI_Loader{
    public function admintemplate($template_name, $vars = array(), $return = FALSE)
    {
        $param=array(
            'template_name'=>$template_name,//컨텐츠 템플릿 뷰의 경로
            'vars'=>$vars,//넘길 파라미터
            'leftmenu'=>isset($vars['leftmenu']) ? $vars['leftmenu'] : 'adminlayout/leftmenu',//레이아웃 껍데기1
            'topmenu'=>isset($vars['topmenu']) ? $vars['topmenu'] : 'adminlayout/topmenu',//레이아웃 껍데기2
            'footer'=>isset($vars['footer']) ? $vars['footer'] : 'adminlayout/footer',//레이아웃 껍데기3
            'ResourceTop'=>isset($vars['loadResource']['top']) ? $vars['loadResource']['top'] :array(),//레이아웃껍데기4
            'ResourceBottom'=>isset($vars['loadResource']['bottom'])? $vars['loadResource']['bottom'] : array(),//레이아웃껍데기5
        );
        $this->view('adminlayout/body', $param);
    }
    //JS 로드
    public function loadJs($src){
        if(is_file(".".$src)){
            return '<script src="'.$src.'"></script>';
        }

    }
    //CSS로드
    public function LoadCss($src){
        if(is_file(".".$src)){
            return '<link href="'.$src.'" rel="stylesheet">';
        }
    }
    public function appTemplate($template_name, $vars = array(), $return = FALSE){
        $param=array(
            'template_name'=>$template_name,//컨텐츠 템플릿 뷰의 경로
            'vars'=>$vars,//넘길 파라미터
            'head'=>isset($vars['head']) ? $vars['head'] : 'applayout/head',//레이아웃 껍데기1
            'foot'=>isset($vars['foot']) ? $vars['foot'] : 'applayout/foot',//레이아웃 껍데기2
            'ResourceTop'=>isset($vars['loadResource']['top']) ? $vars['loadResource']['top'] :array(),//레이아웃껍데기4
            'ResourceBottom'=>isset($vars['loadResource']['bottom'])? $vars['loadResource']['bottom'] : array(),//레이아웃껍데기5
        );
        $this->view('applayout/body', $param);

    }
}

?>