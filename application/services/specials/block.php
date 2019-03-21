<?php
/*
 * 专题碎片（解析语法）
 *
 * @copyright			(C) 2016 Heart
 * @author              maoxiaoqi <15501100090@163.com> <qq:3677989>
 *
 * 您可以自由使用该源码，但是在使用过程中，请保留作者信息。尊重他人劳动成果就是尊重自己
 **/
namespace services\specials;

use heart\controller;

class block extends controller {
    //需要处理的HTML
    public $html = '';

    //区块数组
    public $block = [];

    //专题ID
    public $id = '';

    //模板标签
    public $left_str = '<{';
    public $right_str = '}>';

    public function __construct( $id ) {
        $this->id = $id;

        $this->db_block = load_model( 'admin_special_block' );
    }

    /*
     * 解析block
     *
     * @param $html string html代码
     * */
    public function parse( $html ) {
        preg_match_all( '/<{(.*)}>/i', $html, $m );

        if( empty( $m[1] ) ) return $this->html = $html;
        foreach( $m[1] as $k => $v ) {
            $v= preg_replace( '/block\((.*)\)/i', "$1", $v );
            $v = str_replace( '\'', '', $v );
            $v = str_replace( '"', '', $v );

            $rs = $this->block( $v );
            $html = str_replace( $m[0][$k], $rs, $html );
        }
        $this->html = $html;
    }

    /**
     * 编译block
     * 
     * @param $html string html代码
     */

    public function compile( $html ) {
        preg_match_all( '/<{(.*)}>/i', $html, $m );

        if( empty( $m[1] ) ) return $this->html = $html;
        foreach( $m[1] as $k => $v ) {
            $v= preg_replace( '/block\((.*)\)/i', "$1", $v );
            $v = str_replace( '\'', '', $v );
            $v = str_replace( '"', '', $v );

            $infos = $this->get_block( $v );
            $html = str_replace( $m[0][$k], $infos['content'], $html );
        }
        $this->html = $html;
    }

    /*
     * 区块数据
     *
     * @param $key string 参数
     * */
    public function block( $key ) {
        $infos = $this->get_block( $key );
        if( empty( $infos ) ) return false;

        $rs = '';
        switch( $infos['type'] ) {
            case 0:
                $rs = $this->block_line( $infos );
                break;
            case 1:
                $rs = $this->block_line( $infos );
                //$rs = $infos['content'];
                break;
            case 2:
                $rs = '我是列表';
                break;
        }

        return $rs;

    }

    /*
     * 获取碎片数据
     *
     * @param $name string 碎片键值
     * @return []
     * */
    public function get_block( $name ) {
        if( empty( $name ) ) return false;

        $infos = $this->db_block->get_one( '*', [ 'name' => $name ] );
        return ( !empty($infos) ) ? $infos : [] ;
    }

    /*
     * 获取HTML
     *
     * @return string;
     * */
    public function get() {
        $html = $this->html;
        $html .= $this->block_script();
        return $html;
    }

    /*
     * 碎片行
     *
     * @param $rs string 碎片数据
     * @param $arr array 碎片相关参数
     * @return html（带着碎片框架和实体代码一起返回）
     * */
    public function block_line( $arr ) {

        $node[] = "action-special='block'";
        $node[] = "data-id='{$arr['id']}'";
        $node[] = "data-sid='{$arr['sid']}'";
        $node[] = "data-type='{$arr['type']}'";
        $node[] = "data-name='{$arr['name']}'";

        return "<div class='special_block' ".implode( ' ', $node ).">{$arr['content']}</div>";
    }
    /*
     * 碎片脚本（可视化编辑时会动态生成的脚本）
     *
     * @return string(HTML JS CSS)
     * */
    public function block_script() {

        $domain = load_config( 'domain' );
        $js = $domain.load_config( 'front_admin' )['js'];

        $editor_url = make_url( 'admin', 'special_block', 'edit' );
        $textarea_url = make_url( 'admin', 'special_block', 'edit' );
        $datalist_url = make_url( 'admin', 'special_views', 'datalist' );
        $html =<<<EOF
        
        <!--block-start-->
<style>
.special_block { cursor:pointer;background:#f9f64d; filter:alpha(Opacity=80);-moz-opacity:0.5;opacity: 0.5;z-index:100; width:100%; }
.add-block input[type="text"], .add-block input[type="password"], .add-block input[type="email"], .add-block input.text, .add-block input.email, .add-block input.password, .add-block textarea.form-control {
    font-size: 12px;
    color: #777;
    background-color: #FFF;
    vertical-align: middle;
    display: inline-block;
    padding: 3px;
    border: solid 1px #E2E2E4;
    outline: 0 none;
    border-radius: 0;
    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.07);
    -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.07);
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.07);
}
.add-block label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}
.add-block .form-group {
    margin-bottom: 15px;
}


.add-block textarea.form-control {
    height: auto;
}
.block-tools{
    position:fixed;
    right:0;
    top:0;
    width:50px;
    height:100%;
    color:#fff;
    z-index: 2147483610;
    border:0
}

</style>

<iframe style="width:0;height:0" id="frame" name="frame"></iframe>



<script src="{$js}jquery.min.js"></script>
<script src="{$js}bluebird.js"></script>
<link rel="stylesheet" href="{$js}dialog/ui-dialog.css" />
<script src="{$js}dialog/dialog-plus.js"></script>

<script src="{$js}base.js"></script>
<script src="{$js}special.js"></script>


<div class="mast" style="border: 1px solid #0060ff;
    background: rgba(0,96,255,0.35);
    position: absolute;
    pointer-events: none;
    box-sizing: border-box;
    z-index: 2147483610;
    cursor: pointer;"></div>
 <div class="body-mast" style="z-index:10;background-color:rgba(255,255,255,0.5);position: absolute;top:0px;bottom:0;left:0;right:0;display: none"></div>
 <iframe class="block-tools" src="/resource/admin/html/blocktools.html">

 </iframe>

 
<script>

//let el = document.getElementsByTagName('*');
// 
//let elObj = {};
// 
//for(var i=0; i<el.length;i++){
//    $(el[i]).attr('link-source','elem' + i)
//    if(!elObj[el[i].tagName.toLowerCase()] ){
// 		elObj[el[i].tagName.toLowerCase()] = 1;
//	}else{
//		elObj[el[i].tagName.toLowerCase()] ++;
//	}
//}
// 
//console.log(elObj)





jQuery(document).ready( function () {
    jQuery(document).ready( function () {
        window.special.init( {
            'editor_url': '{$editor_url}',
            'textarea_url': '{$textarea_url}',
            'datalist_url': '{$datalist_url}',
        } );
    } );
} );
var locked = true;

var isAddBlock = getParam('isAddBlock');
if(isAddBlock){
    $(document).on('mouseover mouseout','div',function (e) { 
        if(e.type == "mouseover" ){
               var elemW = $(e.target).width();
                var elemH = $(e.target).height();
               // var elemTop = $(e.target).offset().top - $(window).scrollTop() ;
                //var elemLeft =  $(e.target).offset().left - $(window).scrollLeft();
                var elemTop = $(e.target).offset().top;
                var elemLeft =  $(e.target).offset().left;
                var div = $('.mast');
                div.width(elemW);
                div.height(elemH);
               div.css('position','absolute');
               div.css('top',elemTop);
               div.css('left',elemLeft);

        }
        
       $(e.target).on('click',function(event){
           var that = this;
           event.preventDefault();
           event.stopPropagation();
           $(this).off('click');
           var html = $(this).prop("outerHTML");
           $('.body-mast').show();
            $('.mast').hide();
            if(locked){
                locked = false;
            dialog({
                content:'<div class="form-group"><label class="control-label">碎片名称：</label><input type="text" require name="block_name"  /></div><div class="form-group"><label class="control-label">碎片内容：</label><textarea class="form-control" style="width:98%" rows="20" name="block_content">' + html + '</textarea></div>',
                title:'添加碎片',
                okValue:'保存',
                cancelValue:'取消',
                skin:'add-block',
                ok:function(){
                    var intro = {};
                    intro['name']=$('input[name=block_name]').val();
                    intro['content']=$('textarea[name=block_content]').val();
                    intro['type']= 1;
                    intro['sid']= getParam('id');
                    
                    if(intro['name'] == ''){
                        alert('碎片名称不能为空')
                        return false;
                    }
                    $.ajax({
                        type:'post',
                        url:'http://localhost:9011/admin/special_block/add',
                        data:{
                            infos:intro,
                            dosubmit:1,
                            new_content:intro['content'],
                            source:'ajax'
                        },
                        dataType:"json",
                        success:function(data){
                            if(!data.code){
                                var blocks = $('.special_block');
                                for(var i=0;i<blocks.length;i++){
                                    $(blocks[i]).prop("outerHTML","<{block('" + $(blocks[i]).attr('data-name') + "')}>")
                                }
                                //把当前的元素替换成block
                                $(that).prop("outerHTML","<{block('" + intro['name'] + "')}>")
                                var allhtml = $('html').html();
                                //console.log(allhtml);
                                var test=document.getElementsByTagName('html')[0].innerHTML; 
                               // console.log(test);
                                var pos = allhtml.indexOf('<!--block-start-->');
                                var xmlHtml = allhtml.substring(0,pos) + '</body></html>';
                                
                                saveTpl(intro['name'],$(that).attr('lark-source')).then(function(data){
                                    var res = JSON.parse(data);
                                    if(!res.code){
                                        alert('添加成功');
                                    }
                                    window.location.reload();
                                }); 
                            }
                             
                        }
                    })
                },
                cancel:function(){
                    window.location.reload();
                },
                width:500,
                heihgt:300,
                padding:10,
                node:'dialog2'
            }).showModal(); 
            }

       })
       

    }); 

}

//保存模板 name 碎片名称 id 页面元素lark-source值
function saveTpl(name,id){
    return new Promise(function(resolve, reject){
         getPageInfo().then(function(data){
            var res = JSON.parse(data);
            var page_tpl = res.page_tpl;
            var page_node = res.page_node;
            var content = res.content;
            var rex = /([\s\S]*)(<body[^>]*>)([\s\S]*)(<\/body>)([\s\S]*)/;
            //正则分离body代码
            var rexcon = rex.exec(content);
            //通过iframe进行替换
            var iframe = window.frames['frame'];
            iframe.document.body.innerHTML = rexcon[3];
            //查找碎片元素同时进行替换
            $(iframe.document.body).find("[lark-source="+id +"]").prop("outerHTML","<{block('" + name + "')}>");
            //拼接替换后的HTML
            var html = rexcon[1] + rexcon[2] + escape2Html(iframe.document.body.innerHTML) + rexcon[4] + rexcon[5];
            $.ajax({
                type:'post',
                url:'http://localhost:9011/admin/special_tpl/view',
                data:{
                    dosubmit:1,
                    'page_tpl':page_tpl,
                    page_node:page_node,
                    newcontent:html,
                    source:'ajax'
                },
                dataType:"json",
                success:function(data){
                    resolve(data);
                }
            })  
        })
    })


}

//获取模板信息
function getPageInfo(){
    return new Promise(function(resolve, reject){
        var id = getParam('id');
        var page_url = getParam('page_url');
        $.ajax({
            type:'post',
            url:'http://localhost:9011/admin/special_tpl/getViewData',
            data:{id:id,page_url:page_url},
            success:function(data){
                resolve(data);
            }
        })
    })
}

function codeEdit(){
    dialog_tpl('http://localhost:9011/admin/special_tpl/view?id=93','源码编辑','editcode',1200,800)
}

function html2Escape(sHtml) {
 return sHtml.replace(/[<>&"]/g,function(c){return {'<':'&lt;','>':'&gt;','&':'&amp;','"':'&quot;'}[c];});
}

function escape2Html(str) {
    var arrEntities={'lt':'<','gt':'>','nbsp':' ','amp':'&','quot':'"'};
    return str.replace(/&(lt|gt|nbsp|amp|quot);/ig,function(all,t){return arrEntities[t];});
   }

/** 
 * 获取指定的URL参数值 
 * URL:http://www.quwan.com/index?name=tyler 
 * 参数：paramName URL参数 
 * 调用方法:getParam("name") 
 * 返回值:tyler 
 */ 
function getParam(paramName) { 
    paramValue = "", isFound = !1; 
    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) { 
        arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&"), i = 0; 
        while (i < arrSource.length && !isFound) arrSource[i].indexOf("=") > 0 && arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase() && (paramValue = arrSource[i].split("=")[1], isFound = !0), i++ 
    } 
    return paramValue == "" && (paramValue = null), paramValue 
} 

</script>

EOF;

        return $html;

    }

}

