<? include_once("utility/config.php");
include_once("utility/dbclass.php");
include_once("utility/functions.php");

$objDB = new DB();

$mode=loadVariable('mode','');
$username=loadVariable('username','');
$password=loadVariable('password','');



if($mode == "login" && $username !="" && $password != "") {

		// check into admin user table if the faculty login credentials exits
		
		$Query = "SELECT * from ".SCHEMA.".admin_users where admin_username='".$username."' and admin_password = '".$password."' ";
		$objDB->setQuery($Query);
		$rs = $objDB->select();
		
		if(count($rs) == 1) {
			// authenticated
			
			$QueryUPD = "UPDATE ".SCHEMA.".admin_users SET admin_last_login_date = current_date where admin_username='".$username."' and admin_password = '".$password."'  ";
			$objDB->setQuery($QueryUPD);
			$rs = $objDB->update();
			
			echo "authorized";
		} else {
			echo "auth_failed";
		}
} else {
echo "error";/*.$mode." ".$comment." ".$rate_value." ".$name." ".$email*/
}

?>