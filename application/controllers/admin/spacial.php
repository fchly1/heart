<?php
/*
 * 专题管理
 *
 * @copyright			(C) 2016 Heart
 * @author              maoxiaoqi <15501100090@163.com> <qq:3677989>
 *
 * 您可以自由使用该源码，但是在使用过程中，请保留作者信息。尊重他人劳动成果就是尊重自己
 */
namespace controllers\admin;

use services\admin_base;
use heart\utils\form;
//解压缩
use heart\utils\unzip;

//专题服务部分
use services\spacials\spacial as services_spacial;

class spacial extends admin_base{

    //db
    public $db = [];

    public function __construct() {
        parent::__construct();

        $this->db = load_model( 'admin_spacial' );

        //spacial目录
        $this->spacial_path = ROOT_PATH.'resource/spacial/';

        //上传目录
        $this->upload_path = ROOT_PATH.'resource/upload/';

        $this->_spacial = new services_spacial();
    }

    public function test() {
//        <li><img src="images/q111.jpg"><a href="javascript:;">青春期1</a></p></li>
//            <li><img src="images/q111.jpg"><a href="javascript:;">青春期1</a></p></li>
//            <li><img src="images/q111.jpg"><a href="javascript:;">青春期1</a></p></li>
//            <li><img src="https://xx.com/images/q111.jpg"><a href="javascript:;">青春期1</a></p></li>
//            <li><img src='http://xx.com/images/q111.jpg'><a href="javascript:;">青春期1</a></p></li>
        $str =<<<EOF
            <link              href="style/yycc.css" rel="stylesheet" type="text/css" />
EOF;
        echo preg_replace( '/<link(.*?)href=[\'"](?!https|http\:\/\/)(.*?)[\'"]/i', '<link$1href="xx.com/$2"', $str );

//        $s->make_xml( $this->spacial_path, '' );
//        $s = new unzip();
//        $s->unzip( ROOT_PATH.'yangguangchuchuang.zip',$this->spacial_path );
    }

    /*
     *列表
     *
     * @return tpl
     * */
    public function index() {

        $where = '';
        $lists = $this->db->select_lists( '*', $where, '10', 'id ASC');

        $this->view->assign( 'page', $this->db->page );
        $this->view->assign( 'lists', $lists );
        $this->view->display();
    }

    /*
     * 增加
     *
     * @return tpl
     * */
    public function add() {
        if( gpc( 'dosubmit', 'P' ) ) {
            $infos = gpc( 'infos', 'P' );

            if( empty( $infos['name'] ) ) $this->show_message( '请输入专题名称(中文)' );
//            if( empty( $infos['en_name'] ) ) $this->show_message( '请输入专题名称(英文)' );

            $infos['createtime'] = $infos['updatetime'] = time();

            if( is_file( $this->upload_path.$infos['zip'] ) ) {
                $_file = new unzip();
                $infos['en_name'] = $_file->unzip( $this->upload_path.$infos['zip'], $this->spacial_path);

                if( !$infos['en_name'] ) {
                    $this->show_message( 'ZIP 解压失败' );
                }

                $spacial_page = $this->spacial_path.$infos['en_name'].'/';
                $_filesname = $spacial_page.$this->get_default_page( $infos['files'] );

                if( !is_file($_filesname ) ) $this->show_message( '默认首页不存在. <br/>'.$_filesname );

                //生成XML数据模板
                $xml_data = [];
                $xml_data['infos'] = $infos;
                $xml_data['html'] = file_get_contents( $_filesname );

                //生成XML 顺带生成PHP文件
                $this->_spacial->make_xml( $spacial_page, $xml_data );
            } else {

                $this->show_message( 'ZIP包不存在.' );
            }

            if( $this->db->insert( $infos ) ) {
                 $this->show_message( '操作成功', make_url( __M__, __C__, 'index' ) );
            } else {
                $this->show_message( '操作失败,请联系管理员.' );
            }
        }

        $this->view->assign('atta', form::attachment('' ,1 , 'infos[cover]', '', ''));
        $this->view->assign('zip', form::attachment('zip' ,1 , 'infos[zip]', '', '', false));
        $this->view->display();
    }

    /*
     * 修改
     *
     * @return tpl
     * */
    public function edit() {
        if( gpc( 'dosubmit', 'P' ) ) {
            $infos = gpc( 'infos', 'P' );
            $menuid = gpc( 'menuid', 'P' );

            if( empty( $infos['name'] ) ) $this->show_message( '请输入菜单名' );
            if( empty( $infos['model'] ) ) $this->show_message( '请输入模块名' );
            if( empty( $infos['controller'] ) ) $this->show_message( '请输入控制器名' );
            if( empty( $infos['action'] ) ) $this->show_message( '请输入方法名' );

            $infos['createtime'] = $infos['updatetime'] = time();

            if( $this->db->update( $infos, ['menuid' => $menuid] ) ) {
                 $this->show_message( '操作成功', make_url( __M__, __C__, 'index' ) );
            } else {
                $this->show_message( '操作失败,请联系管理员.' );
            }
        }

        $menuid = gpc( 'menuid' );
        if( empty( $menuid ) ) $this->show_message( 'MENU ID不能为空' );
        $infos = $this->db->get_one( '*',['menuid' => $menuid ] );

        $this->view->assign( 'infos', $infos );
        $this->view->display();
    }

    /*
     * 删除
     *
     * @return 1:0
     * */
    public function del() {
        $id = gpc( 'id' );
        if( empty( $id ) ) $this->show_message( 'ID不能为空' );

        echo ( $this->db->delete( ['id'=>$id] ) ) ? 1 : 0 ;
    }

    /*
     * 获取默认首页
     *
     * @param $files string 文件名
     * @return string
     * */
    public function get_default_page( $files = '' ) {
        return ( !empty( $files ) ) ? $files : 'index.html' ;
    }

    /*
     * 可视化编辑
     *
     * @return tpl
     * */
    public function view() {
        $id = gpc( 'id' );
        if( empty( $id ) ) $this->show_message( 'ID不能为空' );

        $infos = $this->db->get_one( 'id,name,en_name,files', [ 'id' =>$id ] );
        if( empty( $infos ) ) $this->show_message( '专题不存在.' );
        if( empty( $infos['en_name'] ) ) $this->show_message( '专题解析,请查看创建专题时,解压ZIP是否正确.' );

        $index = $this->spacial_path.$infos['en_name'] .'/'. $infos['en_name'] . '.php';
        if( !is_file( $index ) ) $this->show_message( "$index <br/>不存在,请查看创建专题时,解压ZIP是否正确." );

        include( $index );
    }
}