<?php
namespace controllers\specials;

use heart\controller;

//专题 视图区块
use services\specials\block;

//专题服务部分
use services\specials\special as services_special;

class index extends controller {


   //db
   public $db = [];

   public function __construct() {
       parent::__construct();

       $this->db = load_model( 'admin_special' );


       //专题模型
       $this->db_model = load_model( 'admin_special_model' );

       //special目录
       $this->special_path = ROOT_PATH.'resource/special/';

       //上传目录
       $this->upload_path = ROOT_PATH.'resource/upload/';

       //域目录
       $this->domain_upload_path = "/resource/upload/";

       //services special
       $this->_special = new services_special();
   }


    public function index() {
        $id = gpc( 'id' );
        $type = gpc( 'type' );
        $page_url = gpc( 'page_url' ) ? gpc( 'page_url' ) : 'index.html' ;

        if( empty( $id ) ) $this->show_message( 'ID不能为空' );

        $infos = $this->db->get_one( 'id,name,directory,files', [ 'id' =>$id ] );
        if( empty( $infos ) ) $this->show_message( '专题不存在.' );
        if( empty( $infos['directory'] ) ) $this->show_message( '专题解析,请查看创建专题时,解压ZIP是否正确.' );

        $this->view->assign( 'infos', $infos );

        switch( $type ) {
            case 'select':
                //选择 视图模板
                $files_arr = explode( ',', $infos['files'] );
                $this->view->assign( 'files_arr', $files_arr );
                $this->view->display( 'special/select_view' );
                break;
            default:
                //可视化编辑
                if( !strstr( $infos['files'], $page_url ) ) $this->show_message( '视图不存在.' );

                $xml_path = $this->special_path.$infos['directory'].'/'.$infos['directory'].'.xml';
                $_xml = simplexml_load_file( $xml_path, 'SimpleXMLElement', LIBXML_NOCDATA );
                $_method = 'page_'.explode( '.', $page_url )[0];
                $html = (string)$_xml->body->{$_method};

                $block = new block( $id );
                $block->compile( $html );
                echo $block->get();
        }
    }

        /*
     * 信息提示
     *
     * @param $title string 操作标题
     * @param $url string URL
     * @return tpl
     * */
    public function show_message( $title, $url = '' ){
        if( empty( $title ) ) return false;

        $this->view->assign( 'title', $title );
        $this->view->assign( 'url', $url );
        $this->view->display( 'tips' );
    }
}