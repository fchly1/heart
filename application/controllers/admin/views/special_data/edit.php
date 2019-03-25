<?php tpl_include( 'public/header' )?>
<style type="text/css">
    .table_form td{
        padding: 10px;
    }
    .trbg{background-color: #b2d8e4;}
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        line-height: 0.8;
    }
    .opheight>option{
        height:26px;}
</style>
<section class="wrapper">
    <div class="panel">
        <header>
            <header class="panel-heading">
                <a href="<?=make_url( __M__, __C__, 'index' )?>" class="btn btn-default btn-sm" id="index-listing">
                    <i class="icon-gears2 btn-icon"></i>模型数据列表
                </a>
                <a href="javascript:void()" class="btn btn-info btn-sm" id="index-add">
                    <i class="icon-plus btn-icon"></i>修改模型数据
                </a>
            </header>
        </header>

        <header class="panel-heading">
            <span>修改模型数据</span>
        </header>

        <div class="panel-body">
            <form class="form-horizontal tasi-form" method="post" action="">

                <!--
                <div class="form-group">
                    <label class="col-sm-2 col-xs-4 control-label">类别</label>
                    <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                        <select name="form[lang]" class="form-control">
                            <option value="zh-cn" selected="">中文</option>
                        </select>
                    </div>
                </div>
                -->

                <?php if( !empty( $special_infos ) ):?>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-4 control-label">所属模型</label>
                    <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                            <input type="hidden" name="infos[smid]" value="<?=$special_infos['id']?>">
                            <input class="form-control" id="disabledInput" placeholder="<?=$special_infos['name']?>" disabled="" type="text">
                    </div>
                </div>
                <?php endif;?>

                <?php if( !empty( $spcial_block_infos ) ):?>
                    <div class="form-group">
                        <label class="col-sm-2 col-xs-4 control-label">所属碎片</label>
                        <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                            <select name="infos[sbid]" id="sbid" class="form-control">
                                <option value="0" >请选择碎片</option>
                                <?php foreach( $spcial_block_infos as $k => $v ):?>
                                    <?php if( $v['id'] == $infos['sbid'] ):?>
                                        <option value="<?=$v['id']?>" selected><?=$v['name']?></option>
                                    <?php endif;?>
                                    <?php if( $v['id'] !== $infos['sbid'] ):?>
                                        <option value="<?=$v['id']?>" ><?=$v['name']?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                <?php endif;?>

                <?php foreach( $field as $k => $v ):?>
                    <?php if( $v['type'] == 'text' ):?>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label"><?=urldecode($v['name'])?></label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <input type="text" class="form-control" name="infos[content][<?=$v['field_name']?>]" value="<?=$infos['content'][$v['field_name']]?>" color="#000000">
                            </div>
                        </div>
                    <?php endif;?>

                    <?php if( $v['type'] == 'textarea' ):?>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label"><?=urldecode($v['name'])?></label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <textarea name="infos[content][<?=$v['field_name']?>]" class="form-control" cols="60" rows="3"><?=$infos['content'][$v['field_name']]?></textarea>
                            </div>
                        </div>
                    <?php endif;?>

                    <?php if( $v['type'] == 'editor' ):?>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label"><?=urldecode($v['name'])?></label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <?=$editor?>
                            </div>
                        </div>
                    <?php endif;?>
                    <?php if( $v['type'] == 'datetime' ):?>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label"><?=urldecode($v['name'])?></label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <input type="text" id="datepicker" class="form-control" name="infos[content][<?=$v['field_name']?>]" value="<?=$infos['content'][$v['field_name']]?>" color="#000000">

                            </div>
                        </div>
                    <?php endif;?>

                    <?php if( $v['type'] == 'image' ):?>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label"><?=urldecode($v['name'])?></label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <?=$atta;?>
                            </div>
                        </div>
                    <?php endif;?>

                    <?php if( $v['type'] == 'images' ):?>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label"><?=urldecode($v['name'])?></label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <?=$attas;?>
                            </div>
                        </div>
                    <?php endif;?>


                <?php endforeach;?>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-4 control-label"></label>
                    <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                        <input type="hidden" name="id" value="<?=$infos['id']?>" />
                        <input class="btn btn-info col-sm-12 col-xs-12" type="submit" name="dosubmit" value="提交">
                    </div>
                </div>
            </form>
        </div>

        </form>
    </div>
    </div>
</section>
<?php tpl_include( 'public/footer' )?>
