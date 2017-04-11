<?
define('ROOT',dirname(__FILE__));
require_once(ROOT.'/helper.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
Сортировка 
<form id="form" role="form" method="GET" action="/view.php">
 <select class="form-control" name="sort" onchange="$('#form').submit();">
  <option value="ASC" <? if($_GET['sort']=='ASC'){ echo 'selected'; } ?>>от новых к старым</option>
  <option value="DESC" <? if($_GET['sort']=='DESC'){ echo 'selected'; } ?>>от старых к новым</option>
 </select>
</form>
<ul>
<?
if(isset($_GET['sort']))
{
  switch($_GET['sort'])
  {
	case 'ASC': $data = helper::sortAsc(); break;
	case 'DESC' : $data = helper::sortDesc(); break;
  }
}else{ $data = helper::sortAsc(); }
for($i=0;$i<count($data);$i++){
?>
<li>
USER_NAME: <?= $data[$i]['USER_NAME'] ?> 
NAME: <?= $data[$i]['NAME'] ?> 
EMAIL: <?= $data[$i]['EMAIL'] ?> 
TEXT: <?= $data[$i]['TEXT'] ?> 
<? if($data[$i]['FILE']!=''){ ?>
<a href="/upload/<?= $data[$i]['FILE'] ?>">FILE</a>
<? } ?>
</li>
<? } ?>
</ul>
</div>
</body>