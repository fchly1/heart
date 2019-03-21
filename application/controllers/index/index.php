<?php
namespace controllers\index;

use heart\controller;


class index extends controller {

    public $currpath = '';

    //html文件名称
    public $html_names = [];

    public function __construct(){
        header("Content-type:text/html;charset=utf-8");
    }

    public function index() {
        echo '123';
    }


    /**
     * 所有文件解压保存到自定义目录
     * @param $filename 解压文件
     * @param $path string 文件路径
     *
     */
    public function zip($filename,$path){
        $this->currpath = date("Y-m-d").'/'.uniqid('spe_',true)."/";

        //$filename = "F:/work/heart-master/resource/upload/20190318/o_1d67uonbb1omcqlo31t10nbvhda.zip";
        //$path = "F:/work/heart-master/resource/".$this->currpath;

        //$path = $path.$this->currpath;
        $imgPath = $path . 'images'. '/';
        $cssPath = $path . 'css' . '/';
        $jsPath = $path . 'js' . '/';


        //先判断待解压的文件是否存在
        if(!file_exists($filename)){
            die("文件 $filename 不存在！");
        }


        if(!is_dir($path)){
            $this->create_dirs($path);
            $this->create_dirs($cssPath);
            $this->create_dirs($jsPath);
            $this->create_dirs($imgPath);
        }
        $starttime = explode(' ',microtime()); //解压开始的时间

        //将文件名和路径转成windows系统默认的gb2312编码，否则将会读取不到
        $filename = iconv("utf-8","gb2312",$filename);
        $path = iconv("utf-8","gb2312",$path);
        //打开压缩包
        $resource = zip_open($filename);
        $i = 1;
        //遍历读取压缩包里面的一个个文件
        while ($dir_resource = zip_read($resource)) {
            //如果能打开则继续
            if (zip_entry_open($resource,$dir_resource)) {

                //获取当前项目的名称,即压缩包里面当前对应的文件名
                $file_name = $path.zip_entry_name($dir_resource);

                //以最后一个“/”分割,再用字符串截取出路径部分
                $file_path = substr($file_name,0,strrpos($file_name, "/"));


                //如果路径不存在，则创建一个目录，true表示可以创建多级目录
                if(!is_dir($file_path)){
                    //mkdir($file_path,0777,true);
                }
                //如果不是目录，则写入文件
                if(!is_dir($file_name)){

                    //获取文件名
                    $fname = basename($file_name);

                    //读取这个文件
                    $file_size = zip_entry_filesize($dir_resource);
                    //最大读取6M，如果文件过大，跳过解压，继续下一个
                    if($file_size<(1024*1024*30)){
                        $file_content = zip_entry_read($dir_resource,$file_size);
                        //是不是目录
                        if(!is_dir($path.$fname)){
                            file_put_contents($path.$fname,$file_content);


                        }
                        //获取文件类型
                        $ftype = $this->getTypeList($path.$fname);
                        if(strpos($ftype,'image') !== false){
                            copy($path.$fname,$imgPath.$fname);
                            unlink($path.$fname);
                        }

                        //获取文件扩展名
                        $fext = explode(".",$fname);

                        if((strpos($ftype,'text') !== false) && (end($fext) == "css")){
                            copy($path.$fname,$cssPath.$fname);
                            unlink($path.$fname);
                        }


                        if((strpos($ftype,'text') !== false) && (end($fext) == "js")){
                            copy($path.$fname,$jsPath.$fname);
                            unlink($path.$fname);
                        }


                        //获取html 名称
                        $this->html_names( $path, $fname );
                    }else{
                        echo "<p> ".$i++." 此文件已被跳过，原因：文件过大， -> ".iconv("gb2312","utf-8",$file_name)." </p>";
                    }
                }
                //关闭当前
                zip_entry_close($dir_resource);
            }
        }
        //关闭压缩包
        zip_close($resource);

        //echo "<p>解压目录是：$this->currpath</p>";

        return $this->currpath;


    }

    /**
     * 获取文件类型
     */
    private function getTypeList ($file)
    {
        if(is_file($file)){
            $handle= finfo_open(FILEINFO_MIME_TYPE);//This function opens a magic database and returns its resource.
            $fileInfo=finfo_file($handle,$file);// Return information about a file
            finfo_close($handle);
           return $fileInfo;

        }

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

    /**
     * 获取唯一
     * @return string
     */
    function getGuid() {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));

        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }


    /*
 * 获取HTML 目录名称
 *
 * @param $root_path string 根目录
 * @param $names string 文件路径
 * */
    public function html_names( $root_path, $names ) {
        if( empty( $root_path ) || empty( $names ) ) return false;
        $filename = str_replace( $root_path, '', $names );

        //只要根目录文件
        if( !strpos( $filename, '/' ) && strpos( $filename, '.html' ) ) {
            $this->html_names[] = $filename;
        }
    }
}