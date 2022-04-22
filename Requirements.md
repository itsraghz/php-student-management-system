# Requirements

## Roles

| Role | Description | Remarks |
| ---- | ----------- | ------- |
| Student |  Standard User  |    |
| Admin  | Privileged User   |  Super User who can create/modify the Users to the System  |
| Accounts | Privileged User |  User who can work with the financials  |
| Staff | Privileged User   |  <ul><li>Common profile to have a super user privilege on the Students Profile</li>. <li>Time being, Accounts role is also added.</li></ul>  |
| HoD |  Privileged User  |  Time being, merged with the Staff Profile  |
| Principal | Privileged User   | Time being, merged with the Staff Profile    |

## Use Cases

### Student

* Login
* View Profile
* View Attendance
* View Fees
* View Achievements
* View Remarks
* Change Password
* Forgot Password

### Staff

* Login
* Add Student
* Add Attendance
* Add Achievements
* (?) View Profile - Should we need to show the profile of the staff?
* Search Student - Links to
  * View Student Profile
    (*) Should see the Community of the Student     
  * Update Student Profile
  * View Attendance
  * View Fees
  * View Achievements
  * Add Remarks
  * Update Remarks
  * Reset Password
* Report
  * Fees
  * Attendance

### Admin

* Login
* Create User (Student, Staff, Principal, HoD)
* Edit Profile
* Search User
* Password Reset
  * Display the temporary/new password on screen
  * Email functionality (Future Enhancement - Phase 2)

### Accounts

* Login
* Add Fees
* Modify Fees
* Search Functionality
  * Search By Student Id
  * Search By Student Name        
  * Search All Students by Department-Year combination

## Hosting

* Data Gathering - Google Sheets will have a formatting issue. Better to share an excel template.
* Images (for Profile Pics) - Share the format '<REGN-No.jpg>' for all the students - department wise folders and yearwise subfolders if they want.
* A document to be prepared and shared - as User Guide.
* Validation to be performed on the data after the bulk upload is performed.
  * Address - new line spaces can be trimmed.
  * Aadhaar Card - missing digits (12 Digits) - can be added in excel sheet with a rule.
  * Mobile # - should be of 10 digits.
  * Email should be in valid format - abc@xyz.com
