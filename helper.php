<?
class helper
{
	public static function getConnection()
	{
		$paramsPath = ROOT.'/db_params.php';
		$params = include($paramsPath);
		$mysqli = new mysqli($params['host'], $params['login'], $params['password'], $params['db']);
		return $mysqli;
	}
	public static function validateEmail($email)
	{
		return preg_match("/^(\S+)@([a-z0-9-]+)(\.)([a-z]{2,4})(\.?)([a-z]{0,4})+$/",$email);
	}
	public static function validateText($text)
	{
		return strlen($text)>=20?1:0;
	}
	public static function selectData()
	{
		$mysqli = helper::getConnection();
		$res = $mysqli->query("SELECT * FROM  `htmlform`");
		$rows = array();
		while($row = $res->fetch_array())
        {
         $rows[] = $row;
        }
		return $rows;
	}
	public static function sortDesc()
	{
		$mysqli = helper::getConnection();
		$res = $mysqli->query("SELECT * FROM  `htmlform` ORDER BY  `htmlform`.`DATE` DESC");
		$rows = array();
		while($row = $res->fetch_array())
        {
         $rows[] = $row;
        }
		return $rows; 
	}
	public static function sortAsc()
	{
		$mysqli = helper::getConnection();
		$res = $mysqli->query("SELECT * FROM  `htmlform` ORDER BY  `htmlform`.`DATE` ASC");
		$rows = array();
		while($row = $res->fetch_array())
        {
         $rows[] = $row;
        }
		return $rows; 
	}
}
?>