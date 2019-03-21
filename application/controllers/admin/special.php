<?php
/*
 * 专题管理
 *
 * @copyright			(C) 2016 Heart
 * @author              maoxiaoqi <15501100090@163.com> <qq:3677989>  qiancheng <1969662705@qq.com>
 *
 * 您可以自由使用该源码，但是在使用过程中，请保留作者信息。尊重他人劳动成果就是尊重自己
 */
namespace controllers\admin;

//后台基类
use services\admin_base;

//专题 视图区块
use services\specials\block;

//form工具
use heart\utils\form;

//解压缩
use heart\utils\unzip;

//专题服务部分
use services\specials\special as services_special;

class special extends admin_base{

    //db
    public $db = [];

    public function __construct() {
        parent::__construct();

        $this->domain = load_config( 'domain' );

        $this->db = load_model( 'admin_special' );


        //专题模型
        $this->db_model = load_model( 'admin_special_model' );

        //special源代码目录，保存解压后上传的文件
        $this->special_path = ROOT_PATH.'resource/special_origin/';

        //专题显示目录
        $this->special_show_path = ROOT_PATH.'special/';

        //上传目录
        $this->upload_path = ROOT_PATH.'resource/upload/';

        //域目录
        $this->domain_upload_path = "/resource/upload/";

        //services special
        $this->_special = new services_special();
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

//        $s->make_xml( $this->special_path, '' );
//        $s = new unzip();
//        $s->unzip( ROOT_PATH.'yangguangchuchuang.zip',$this->special_path );
    }

    /*
     *列表
     *
     * @return tpl
     * */
    public function index() {

        $where = '';
        $lists = $this->db->select_lists( '*', $where, '10', 'id DESC');

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
            if( empty( $infos['urlpath'] ) ) $this->show_message( '请输入专题目录(英文)' );

            $urlpath = $this->db->get_one( 'id,name,directory,files', [ 'urlpath' =>$infos['urlpath']] );
            if( $urlpath ) $this->show_message( '专题目录重复.' );

            $infos['createtime'] = $infos['updatetime'] = time();



            if( is_file( $this->upload_path.$infos['zip'] ) ) {

                /*if(!is_dir($this->special_path.'/'.$infos['en_name'])) {
                    mkdir($this->special_path.'/'.$infos['en_name'], 0777, true);//创建目录保存解压内容
                }*/

                

                $_file = new unzip();
                $infos['directory'] = $_file->exzip( $this->upload_path.$infos['zip'], $this->special_path);
                $infos['files'] = is_array( $_file->html_names ) ? implode( ',', $_file->html_names ) : '' ;

                if( !$infos['directory'] ) {
                    $this->show_message( 'ZIP 解压失败' );
                }

                $special_page = $this->special_path.$infos['directory'].'/';


                /***** css文件中图片路径替换  start *****/

                $cssfilepath = $special_page.'css/';
                //判断目标目录是否是文件夹
                $file_arr = array();
                if(is_dir($cssfilepath)){
                    //打开
                    if($dh = @opendir($cssfilepath)){
                        //读取
                    
                        while(($file = readdir($dh)) !== false){

                            if($file != '.' && $file != '..'){

                                $file_arr[] = $file;
                            }

                        }
                        //关闭
                        closedir($dh);
                    }
                }
                
                if(count($file_arr)){
                    //域名路径
                    $path = str_replace( ROOT_PATH, '', $special_page );
                    foreach($file_arr as $item){
                        //判断是否存在这个文件
                        if(is_file($cssfilepath.$item)){
                            $origin_str = file_get_contents($cssfilepath.$item);
                            $update_str = str_replace('../', $this->domain.$path, $origin_str);
                            file_put_contents($cssfilepath.$item, $update_str);
                        }
                    }               
                }

                /***** css文件中图片路径替换  end *****/


                //生成XML数据模板
                $xml_data = [];
                $xml_data['infos'] = $infos;
                $xml_data['infos']['_files'] = $_file->html_names;

                //生成XML 顺带生成PHP文件
                if( !$this->_special->make_xml( $special_page, $xml_data ) ) {
                    $this->show_message( '文件创建失败.' );

                }
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
            $id = gpc( 'id', 'P' );

            if( empty( $infos['name'] ) ) $this->show_message( '请输入专题名称(中文)' );

            if( isset( $infos['cover'] ) ) $infos['cover'] = str_replace( $this->domain_upload_path, '', $infos['cover'] );

            $infos['updatetime'] = time();

            if( $this->db->update( $infos, ['id' => $id] ) ) {
                 $this->show_message( '操作成功', make_url( __M__, __C__, 'index' ) );
            } else {
                $this->show_message( '操作失败,请联系管理员.' );
            }
        }

        $id = gpc( 'id' );
        if( empty( $id ) ) $this->show_message( 'ID不能为空' );
        $infos = $this->db->get_one( '*',['id' => $id ] );

        $this->view->assign( 'infos', $infos );
        $this->view->assign('atta', form::attachment('' ,1 , 'infos[cover]', $this->domain_upload_path.$infos['cover'], ''));
        $this->view->assign('zip', form::attachment('zip' ,1 , 'infos[zip]', $infos['zip'], '', false));
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

        //专题模型
        $this->db_model->delete( [ 'sid' => $id ] );
        //删除专题
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
        $type = gpc( 'type' );
        $page_url = gpc( 'page_url' );

        if( empty( $id ) ) $this->show_message( 'ID不能为空' );

        $infos = $this->db->get_one( 'id,name,directory,urlpath,files', [ 'id' =>$id ] );
        if( empty( $infos ) ) $this->show_message( '专题不存在.' );
        if( empty( $infos['directory'] ) ) $this->show_message( '专题解析,请查看创建专题时,解压ZIP是否正确.' );
        $page_tpl = $this->special_path.$infos['directory'].'/'.$infos['urlpath'].'.xml';
        $this->view->assign( 'page_tpl', $page_tpl );
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

                $xml_path = $this->special_path.$infos['directory'].'/'.$infos['urlpath'].'.xml';
                $_xml = simplexml_load_file( $xml_path, 'SimpleXMLElement', LIBXML_NOCDATA );
                $_method = 'page_'.explode( '.', $page_url )[0];
                $html = (string)$_xml->body->{$_method};

                $block = new block( $id );
                $block->parse( $html );
                echo $block->get();
        }
    }


    /**
     * 生成专题页面
     */

    public function mark_html() {
        $id = gpc( 'id' );
        $type = gpc( 'type' );
        $page_url = gpc( 'page_url' ) ? gpc( 'page_url' ) : 'index.html' ;

        if( empty( $id ) ) $this->show_message( 'ID不能为空' );

        $infos = $this->db->get_one( 'id,name,directory,files,urlpath', [ 'id' =>$id ] );
        if( empty( $infos ) ) $this->show_message( '专题不存在.' );
        if( empty( $infos['directory'] ) ) $this->show_message( '专题解析,请查看创建专题时,解压ZIP是否正确.' );

        $this->view->assign( 'infos', $infos );
        //可视化编辑
        if( !strstr( $infos['files'], $page_url ) ) $this->show_message( '视图不存在.' );

        $xml_path = $this->special_path.$infos['directory'].'/'.$infos['urlpath'].'.xml';
        $_xml = simplexml_load_file( $xml_path, 'SimpleXMLElement', LIBXML_NOCDATA );
        $_method = 'page_'.explode( '.', $page_url )[0];
        $html = (string)$_xml->body->{$_method};

        $block = new block( $id );
        $block->compile( $html );

        
        //echo $block->get();
        if(is_file($this->special_path.$infos['directory'].'/'.$page_url)){
            //判断urlpath目录是否存在
            if (!is_dir($this->special_show_path.$infos['urlpath'])){
               $this->create_dirs($this->special_show_path.$infos['urlpath'].'/');
            }
            $origin_str = fopen($this->special_show_path.$infos['urlpath'].'/'.$page_url,"w");
            fwrite($origin_str,$block->get());
            fclose($origin_str);
        }

        $this->show_message( '页面已经发布' );
    }

    /*
     * 创建目录
     * */
    public function create_dirs($path){
        if (!is_dir($path)){
            $directory_path = "";
            $directories = explode("/",$path);
            array_pop($directories);

            foreach($directories as $directory){
                $directory_path .= $directory."/";
                if (!is_dir($directory_path)){
                    mkdir($directory_path);
                    chmod($directory_path, 0777);
                }
            }
        }
    }

    
}