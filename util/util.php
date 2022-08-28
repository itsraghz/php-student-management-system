<?php

//require_once __DIR__ . '/../dao/ReligionDAO.php';

class Util
{
	/** Taken from http://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_required */
	public static function sanitizeInput($data)
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);

		 /* Ref : https://www.sitepoint.com/community/t/htmlspecialchars-and-mysql-real-escape-string/91502/4 */
		 /* Both htmlspecialchars and htmlentities do basically the same thing exccept
		 	that htmlentities converts a lot more characters to their equivalent HTML entity codes.
			htmlspecialchars covers all the conversions you’d normally need as it is only really < and &
			that need to be converted to entity codes when displaying thext in an HTML page.
		*/
		 //$data = htmlentities($data);

	   return $data;
	}

	public static function isUserAStaff()
	{
		$isUserAStaff = false;

		if(isset($_SESSION['isUserAStaff']) && !empty($_SESSION['isUserAStaff'])) {
			//$isUserAStaff = $_SESSION['isUserAStaff'];
			//$isUserAStaff = 1;
			$isUserAStaff = true;
		}

		return $isUserAStaff;
	}

	public static function isUserNotAStudent()
	{
		//$this->log->info('isUserNotAStudent - ENTER');

		$isUserNotAStudent = false;

		if(isset($_SESSION['isUserNotAStudent']) && !empty($_SESSION['isUserNotAStudent'])) {
			//$isUserNotAStudent = $_SESSION['isUserNotAStudent'];
			//$isUserNotAStudent = 1;
			$isUserNotAStudent = true;
		}

		//$this->log->info('isUserNotAStudent - EXIT');

		return $isUserNotAStudent;
	}

	public static function getAdmissionMode($modeId)
	{
		$mode = "";

		if($modeId==1) {
			$mode = "Counselling";
		} else if ($modeId==2) {
			$mode = "Management";
		} else {
			$mode = "Unknown";
		}

		return $mode;
	}

	public static function getDepartment($deptId)
	{
		$department = "";

		if($deptId==1) {
			$department = "B.E. (ECE)";
		} else if ($deptId==2) {
			$department = "B.E. (EEE)";
		} else if ($deptId==3) {
			$department = "B.E. (CSE)";
		} else if ($deptId==4) {
			$department = "B.E. (Mech)";
		} else if ($deptId==5) {
			$department = "B.E. (Civil)";
		} else {
			$department = "Unknown";
		}

		return $department;
	}

	public static function getReligion($religionId)
	{
		$religion = "";

		$religion = Util::getReligionHardCoded($religionId);
		//$religion = Util::getReligionFromDB($religionId);

		return $religion;
	}

	public static function getReligionHardCoded($religionId)
	{
		$religion = "";

		if($religionId==1) {
			$religion = "Hindu";
		} else if ($religionId==2) {
			$religion = "Islam";
		} else if ($religionId==3) {
			$religion = "Christian";
		} else if ($religionId==4) {
			$religion = "Jain";
		} else if ($religionId==5) {
			$religion = "Sikh";
		} else {
			$religion = "Unknown";
		}

		return $religion;
	}

	/*public static function getReligionFromDB($religionId)
	{
		$religion = "";

		//$religionDAO = new ReligionDAO;
		$religionNamesArray = array();

		$religionNamesArray = isset($_SESSION['religionNamesArray']) ? $_SESSION['religionNamesArray'] : null;

		if(empty($religionNamesArray))
		{
			$religionDAO = new ReligionDAO;
			$religionNamesArray = $religionDAO->fetchAll();
			$_SESSION['religionNamesArray'] = $religionNamesArray;
		}

		$religion = $religionNamesArray[$religionId];

		return $religion;
	}*/

	public static function getCommunity($communityId)
	{
		$community = "";

		if($communityId==1) {
			$community = "Chettiyar";
		} else if ($communityId==2) {
			$community = "Mudaliyar";
		} else if ($communityId==3) {
			$community = "Nadar";
		} else if ($communityId==4) {
			$community = "Thevar";
		} else if ($communityId==5) {
			$community = "Vallambar";
		} else if ($communityId==6) {
			$community = "Ambalam";
		} else {
			$community = "Unknown";
		}

		return $community;
	}
}
?>
