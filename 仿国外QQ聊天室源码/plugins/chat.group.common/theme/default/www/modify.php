<?php

!defined('IN_ONEZ') && exit('Access Denied');
define('CUR_URL','/admin/pages/group_notice.php');
$groupid=onez()->gp('groupid');
$gid=(int)onez()->gp('gid');


$G['title']='备注名称';

$item=$G['user'];
$item['avatar']=onez('chat.group.common')->avatar($G['userid']);
list($item['avatar'])=explode('?',$item['avatar']);

#初始化表单
$form=onez('admin')->widget('form')
  ->set('title',$G['title'])
  ->set('values',$item)
;
#创建表单项
$form->add(array('type'=>'hidden','key'=>'action','value'=>'save'));
#$form->add(array('label'=>'显示昵称','type'=>'html','html'=>'<code>'.$item['nickname'].'</code>','hint'=>''));
$form->add(array('label'=>'显示昵称','type'=>'text','key'=>'nickname','hint'=>'','notempty'=>'显示昵称不能为空','group'=>''));
$form->add(array('label'=>'头像','type'=>'form.file','key'=>'avatar','hint'=>'','notempty'=>'','group'=>''));


#处理提交
if($onez=$form->submit()){
  ob_clean();
  $onez['key8']=$onez['nickname'];
  if($onez['avatar'] && $onez['avatar']!=$item['avatar']){
    onez('chat.group.common')->avatar_set($G['userid'],$onez['avatar']);
  }
  $G['this']->data()->open('member')->update(array(
    'avatar'=>$onez['avatar'],
  ),"id='$G[userid]'");
  onez()->ok('操作成功','reload2');
}
onez('admin')->header();
?>
<section class="content-header">
  <h1>
    <?php echo $G['title']?>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo onez()->href('/')?>">
        <i class="fa fa-dashboard">
        </i>
        管理首页
      </a>
    </li>
    <li class="active">
      <?php echo $G['title']?>
    </li>
  </ol>
</section>
<section class="content">
  <form id="form-common" method="post">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?php echo $G['title']?>
        </h3>
        <div class="box-tools pull-right">
        </div>
      </div>
      <div class="box-body">
        <?php echo $form->code()?>
      </div>
      <div class="box-footer clearfix">
        <button type="submit" class="btn btn-primary">
          确定修改
        </button>
        <!--<a href="<?php echo $G['this']->href('/admin/pages/group_notice.php&groupid='.$groupid)?>" class="btn btn-default">
          返回
        </a>-->
      </div>
    </div>
    <input type="hidden" name="action" value="save" />
  </form>
</section>
<script type="text/javascript">
$(function(){
  $('#form-common').bind('submit',function(){
    $.post(window.location.href,$(this).serialize()+'&ajax=1',function(data){
      if(data.status=='success'){
        parent.doit({
          groupid:'<?php echo $groupid?>',
          action:'setname',
          userid:'<?php echo $userid?>'
        });
        parent.closeWin();
      }else{
        onez.doit(data);
      }
    },'json');
    return false;
  });
});
</script>
<?php
onez('admin')->footer();
?>