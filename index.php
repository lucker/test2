<?
define('ROOT',dirname(__FILE__));
require_once(ROOT.'/helper.php');
$error = array();
 if(isset($_POST[NAME])){
	 if($_POST[NAME]==''){ $error[NAME] = '*Обязательное поле'; }
 }
 if(isset($_POST[USER_NAME])){
	 if($_POST[USER_NAME]==''){ $error[USER_NAME] = '*Обязательное поле'; }
 }
 if(isset($_POST[EMAIL])){
	 if(!helper::validateEmail($_POST[EMAIL])){ $error[EMAIL] = 'Не коректное поле'; }
 }
 if(isset($_POST[TEXT])){
	 if(!helper::validateText($_POST[TEXT])){ $error[TEXT] = 'Минимум 20 символов'; }
 }
 //запись в бд
 if(count($error)==0&&!empty($_POST))
 {
        $uploadfile = '';
		if(file_exists($_FILES['FILE']['tmp_name']))
		{
		  $filename =date("d-m-Y-H-i-s").'.'.pathinfo($_FILES['FILE']['name'], PATHINFO_EXTENSION);
		  $uploadfile = ROOT.'/upload/'.$filename; 
          move_uploaded_file($_FILES['FILE']['tmp_name'], $uploadfile);
		}else{ $uploadfile = ''; } 
		$mysqli = helper::getConnection();
		$query = "INSERT INTO `sohan_test2`.`htmlform` (`id`, `USER_NAME`, `NAME`, `EMAIL`, `TEXT`, `FILE`, `IP`, `DATE`) VALUES (NULL, '".$_POST[USER_NAME]."', '".$_POST[NAME]."', '".$_POST[EMAIL]."', '".$_POST[TEXT]."', '".$filename."', '".$_POST[IP]."', '".date("Y-m-d H:i:s")."');";
		$res = $mysqli->query($query);
		echo ' Записалось в бд';
		exit;
 }
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
  <form role="form" enctype="multipart/form-data" action="/" method="POST">
   <div class="form-group <? if($error['USER_NAME']){ echo 'has-error'; } ?>">
    <label for="USER_NAME" class="control-label">USER_NAME</label>
    <input type="text" class="form-control" id="USER_NAME" placeholder="Enter USER_NAME" name="USER_NAME" value="<?= $_POST['USER_NAME'] ?>">
    <? if($error['USER_NAME']){ ?>
    <span class="help-inline"><?= $error['USER_NAME'] ?></span>
    <? } ?>
  </div>

  <div class="form-group <? if($error['NAME']){ echo 'has-error'; } ?>">
    <label for="NAME">NAME</label>
    <input type="text" class="form-control" id="NAME" placeholder="Enter NAME" name="NAME" value="<?= $_POST['NAME'] ?>">
    <? if($error['NAME']){ ?>
    <span class="help-inline"><?= $error['NAME'] ?></span>
    <? } ?>
  </div>
  <div class="form-group <? if($error['EMAIL']){ echo 'has-error'; } ?>">
    <label for="EMAIL">EMAIL</label>
    <input type="text" class="form-control" id="EMAIL" placeholder="Enter email" name="EMAIL" value="<?= $_POST['EMAIL'] ?>">
    <? if($error['EMAIL']){ ?>
    <span class="help-inline"><?= $error['EMAIL'] ?></span>
    <? } ?>
  </div>
  <div class="form-group <? if($error['TEXT']){ echo 'has-error'; } ?>">
    <label for="TEXT">TEXT</label>
     <textarea class="form-control" rows="3" id="TEXT" name="TEXT"><?= $_POST['TEXT'] ?></textarea>
    <? if($error['TEXT']){ ?>
     <span class="help-inline"><?= $error['TEXT'] ?></span>
    <? } ?>
  </div>
  <div class="form-group">
    <label for="FILE">FILE</label>
    <input type="file" id="FILE" name="FILE" value="<?= $_POST['FILE'] ?>">
  </div>
  <input type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" name="IP">
  <button type="submit" class="btn btn-default">Отправить</button>
  </form>
 </div>
</body>
</html>
