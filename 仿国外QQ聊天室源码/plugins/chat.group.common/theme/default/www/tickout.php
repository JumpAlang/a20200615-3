<?php

!defined('IN_ONEZ') && exit('Access Denied');
$type=onez()->gp('type');
!$G['ismaster'] && onez('chat.group.common')->error('没有权限');


$G['title']='踢出名单';
$action=onez()->gp('action');
if($action=='delete'){
  $id=(int)onez()->gp('id');
  $G['this']->data()->open('group_users')->update(array(
    'tickout_exptime'=>0,
    'key1'=>'ok',
  ),"id='$id'");
  onez()->ok('解除成功','reload');
}
$xxx="";
onez('admin')->header();

$record=$G['this']->data()->open('group_users')->page("key1='tickout' and upid='$groupid' order by id desc");
?>
<section class="content-header">
  <h1>
    <?php echo $G['title']?><small></small>
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
  <div class="box box-info">
    <div class="box-body  table-responsive no-padding">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>管理员</th>
            <th>显示昵称</th>
            <th>封禁时间</th>
            <th>封禁理由</th>
            <th>封禁方式</th>
            <th>解封时间</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody class="todo-list">
          <?php foreach($record[0] as $rs){
            ?>
          <tr>
            <td>
              <?php echo onez('chat.group.common')->nickname($rs['tickout_masteruid'])?>
            </td>
            <td>
              <?php 
if($rs['token']=='guest'){
  $userid='guest.'.$rs['userid'];
  echo '【游客】<code>'.onez('chat.group.common')->nickname_guest($rs['userid']);
}else{
  $userid=$rs['userid'];
  echo onez('chat.group.common')->nickname($rs['userid']);
}
              ?>
            </td>
            <td>
              <?php echo date('Y-m-d H:i:s',$rs['addtime'])?>
            </td>
            <td>
              <?php echo $rs['tickout_because']?>
            </td>
            <td>
              <?php echo $rs['tickout_method']?$rs['tickout_method']:'账号'?>
            </td>
            <td>
              <?php echo date('Y-m-d H:i:s',$rs['tickout_exptime'])?>
            </td>
            <td>
              <a href="javascript:void(0)" onclick="onez.del('<?php echo $rs['id']?>')" class="btn btn-xs btn-danger">
                解除
              </a>
            </td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
<?php if($record[1]){ ?>
    <div class="box-footer clearfix">
      <?php echo $record[1]?>
    </div>
<?php  } ?>
  </div>
</section>
<script type="text/javascript">
onez.del=function(id){
  onez.confirm('您确定要解除此用户的踢出状态吗？',function(){
    $.post(window.location.href,{action:'delete',id:id,ajax:1},function(data){
      onez.doit(data);
    },'json');
  });
};
</script>
<?php
onez('admin')->footer();
?>