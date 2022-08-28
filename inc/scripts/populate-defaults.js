console.log('populate-defaults.js file loaded');

var canAlert = true;
//canAlert = false;

//alertMsg('populate-defaults.js loaded');

var userIds = ["Admin", "Accounts", "hod.ece", "hod.cse", "912518106005", "912518106010"];
//sabarishcse01@gmail.com -> sabarishmahalingam@gmail.com
var passwords = ["Admin", "Accounts", "hod.ece", "hod.cse", "912518106005", "912518106010"];

function alertMsg(msg) {
	if (canAlert) {
		alert(msg);
	}
}

/**
 * [24May2020] A method to populate a set of sample values into Login Form,
 * to speeden up the Development activities.
 *
 * <b>Note: </b> It should be removed after Dev completion, otherwise it is
 * a big vulnerability that the credentials are exposed in plain text through
 * this Javascript, which can be viewed via 'View Source'.
 */
function populate(index) {
	//alertMsg('populate');

	var arrayLen = userIds.length;

	if (index < 0 || index > (arrayLen - 1)) {
		alert("Invalid index passed. It should be between 0-" + (arrayLen - 1));
		return;
	}

	var userNameDefault = userIds[index];
	var passwordDefault = passwords[index]

	//alertMsg('userName --> '+document.getElementById('userName').text);

	document.getElementById('userName')
		.value = userNameDefault;
	document.getElementById('password')
		.value = passwordDefault;

	//alertMsg('(2) userName text --> '+document.getElementById('userName').value);
	//alertMsg('(2) password value --> '+document.getElementById('password').value);

	//return false;
}

/**
 * [24Jul2016] A method to clear / reset the populated values if any,
 * into Login Form, to speeden up the Development activities.
 */
function clear() {
	//alert('clear');

	document.getElementById('userName')
		.value = '';
	document.getElementById('password')
		.value = '';

	//return false;
}
