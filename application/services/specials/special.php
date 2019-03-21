<?php
/*
 * 专题
 *
 * @copyright			(C) 2016 Heart
 * @author              maoxiaoqi <15501100090@163.com> <qq:3677989>  qiancheng <1969662705@qq.com>
 *
 * 您可以自由使用该源码，但是在使用过程中，请保留作者信息。尊重他人劳动成果就是尊重自己
 **/
namespace services\specials;

use heart\controller;


class special extends controller {

    public $index = 0;

    public function __construct() {
        $this->domain = load_config( 'domain' );
    }

    /*
     * 生成XML文件
     * @param $files string 路径
     * @param $data [] 数组
     * @return 生成xml and php文件
     * */
    public function make_xml( $files, $data ) {

        //当前路径
        $current_page = str_replace( ROOT_PATH, '', $files );

        if( !isset( $data['infos']['_files'] ) || !is_array( $data['infos']['_files'] ) ) return false;
        //遍历 获取html

        $page_html = '';
        foreach( $data['infos']['_files'] as $k => $v ) {
            $path = $files.$v;
            $html = file_get_contents( $path );

            $page_node = explode( '.', $v );
            $this->replace_text( $current_page, $html );

            $page_html .=<<<HTML
<page_{$page_node[0]}  page="{$v}">
    <![CDATA[
        {$html}
    ]]>
</page_{$page_node[0]}>
HTML;
        }

        //批量替换链接

        $xml =<<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<root>
    <head>
        <title>{$data['infos']['name']}</title>
        <files>{$data['infos']['files']}</files>
        <english_title>{$data['infos']['directory']}</english_title>
        <root_path>{$current_page}</root_path>
        <createtime>{$data['infos']['createtime']}</createtime>
    </head>
    <body>
        {$page_html}
    </body>
</root>
EOF;


        //$filenpath = $files.$data['infos']['directory'];
        //var_dump($files);die();
        $filename = $data['infos']['urlpath'];
        //生成XML
        write_files($files.'/'.$filename.'.xml', $xml);
        return true;
    }

    /*
     * 正则替换src href link内容,增加当前链接
     * @param $path string 当前相对目录路径
     * @param $html string html代码
     * @return void
     * */
    public function replace_text($path, &$html) {
        $html = preg_replace( '/src=[\'"](?!http|https:\/\/)(.*?)[\'"]/i', 'src="'.$this->domain.$path.'$1"', $html );

        //给每个元素加个序号，以便用于切碎片
        $html = preg_replace_callback('/<([a-zA-Z1-6]+)\s*(.*)>/i',function($matches){
            //var_dump($matches);die();
            if(!strstr($matches[2], 'lark-source')){
                return '<'.$matches[1].' lark-source="elem'.$this->getindex().'" '.$matches[2].'>';
            }

        },$html);

        //修改页面中的CSS图片地址
        $html = preg_replace( '/url\((?!http|https:\/\/)(.*?)(.*)\.(jpg|jpeg|png|gif|bmp)/i', 'url('.$this->domain.$path.'$2.$3', $html );




        $html = preg_replace( '/<link(.*?)href=[\'"](?!http|https:\/\/)(.*?)[\'"]/i', '<link$1 href="'.$this->domain.$path.'$2"', $html );
    }


    public function getindex(){
        $this->index++;
        return $this->index;
    }




}

