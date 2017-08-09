<? include_once("utility/config.php");
include_once("utility/dbclass.php");
include_once("utility/functions.php");

$objDB = new DB();

$regID=loadVariable('regID','');

if($regID !="") {

		// insert into gcm data table after checking duplicate record
		
		$Query = "SELECT * from ".SCHEMA.".gcm_reg_ids where reg_id='".$regID."' ";
		$objDB->setQuery($Query);
		$rs = $objDB->select();
		
		if(count($rs) == 0) {
			// insert
			$QueryINS  = " INSERT INTO ".SCHEMA.".gcm_reg_ids (reg_id,added_date) VALUES('".$regID."',current_date)";
			$objDB->setQuery($QueryINS);
			$objDB->insert();
			
		} 
	}	
 else {
echo "error";/*.$mode." ".$comment." ".$rate_value." ".$name." ".$email*/
}

?>