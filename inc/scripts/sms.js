console.log('sms.js file loaded');

var canAlert = true;
canAlert = false;

//alertMsg('sms.js loaded');

console.log('canAlert : ' + canAlert);

function msgAlert(msg) {
	console.log('msgAlert() - canAlert : ' + canAlert);
	if (canAlert === true) {
		console.log('msgAlert() - canAlert is true');
		//alert(msg);
	}
	console.log(msg);
}

function validateStudentAdd() {
	msgAlert('validateStudentAdd() invoked');

	var form = document.forms["addProfileForm"];
	//msgAlert('form object : ');
	//msgAlert(form);

	var name = form['Name'];
	msgAlert('Name : ' + name.value);
	if (name.value.trim() == "") {
		alert('The value for the element Name is missing, and must be filled out.');
		name.focus();
		return false;
	}

	var RegnNo = form['RegnNo'];
	msgAlert('RegnNo : ' + RegnNo.value);
	if (RegnNo.value.trim() == "") {
		alert('The value for the element RegnNo is missing, and must be filled out.');
		RegnNo.focus();
		return false;
	}

	var DOB = form['DOB'];
	msgAlert('DOB : ' + DOB.value);
	if (DOB.value.trim() == "") {
		alert('The value for the element DOB is missing, and must be filled out.');
		DOB.focus();
		return false;
	}

	var Gender = form['Gender'].value;
	msgAlert('Gender : ' + Gender.value);
	if (Gender.value.trim() == "") {
		alert('The value for the element Gender is missing, and must be filled out.');
		Gender.focus();
		return false;
	}

	return true;
}

function validateNonNullValue(key) {
	msgAlert('validateNonNullValue() invoked, key=' + key);
	var value = form[key].value;
	msgAlert(key + ' : ' + value);
	if (value == "") {
		alert('The value for the "' + key + '" is missing, and must be filled out.');
		return false;
	}
	return true;
}

function submitStudentAdd() {
	msgAlert('submitStudentAdd() invoked');

	if (validateStudentAdd() === true) {
		msgAlert('Form validation successful');
		alert('Break #1');
		alert('Break #2');

		document.forms['addProfileForm'].action = 'insert.php';
		document.forms['addProfileForm'].submit();
		alert('Break #3');
		alert('Break #4');
	} else {
		alert('Rectify all the errors for the form to be submitted.');
	}
}

/**
 * A good tip I have learned from https://stackoverflow.com/a/9413809/1001242
 * Query: https://stackoverflow.com/questions/1191113/how-to-ensure-a-select-form-field-is-submitted-when-it-is-disabled
 */
function enablePath() {
	document.getElementById('modeC')
		.disabled = "";
	document.getElementById('modeM')
		.disabled = "";
	document.getElementById('genderMale')
		.disabled = "";
	document.getElementById('genderFemale')
		.disabled = "";
	document.getElementById('deptId')
		.disabled = "";
	document.getElementById('year')
		.disabled = "";
	document.getElementById('religionId')
		.disabled = "";
	document.getElementById('communityId')
		.disabled = "";
}
