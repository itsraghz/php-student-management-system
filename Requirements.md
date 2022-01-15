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

### Staff

* Login
* Add Student
* Add Attendance
* Add Achievements
* (?) View Profile - Should we need to show the profile of the staff?
* Search Student - Links to
  * View Student Profile
  * Update Student Profile
  * View Attendance
  * View Fees
  * View Achievements
  * Add Remarks
  * Update Remarks

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
