<?php
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
}
?>
