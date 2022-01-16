<?php
  require_once 'inc/header.php';
?>

<h2>Completed</h2>

<table class="versionHistory">
    <thead>
        <tr>
            <th>Version</th>
            <th>Date</th>
            <th>Description</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1.0</td>
            <td>14 Jan 2022 Friday</td>
            <td>
              <ul>
                <li>`Requirements.md` with the Users/Roles created</li>
                <li>UI Mock Screens - HomePage with Login, Profile View</li>
                <li>PHP Pages with Index, Login with `style.css`</li>
                <li>Reusable Header, Footer, Menu Pages in PHP with *Session*</li>
                <li>Login and Logout Functionalities</li>
                <li>Authentication and Security Mechanism</li>
                <li>Logout Message and Error Message on `index.php`</li>
                <li>Profile Page - View with Dummy Data.</li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>1.1</td>
            <td>15 Jan 2022 Saturday</td>
            <td>
              <ul>
                <li>Database Connection established</li>
                <li>DB Table Creation for TblUser, TblStudent</li>
                <li>Sample Data inserted for the DB Tables</li>
                <li>PHP Code modified to authenticate the user from the DB</li>
                <li>View Profile for Student - shows the full details from DB.</li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>1.2</td>
            <td>16 Jan 2022 Sunday</td>
            <td>
              <ul>
                <li>File Upload - Demo in PHP</li>
                <li>Sample Data from Google Drive to MySQL Database, including Photo.</li>
                <li>View Profile - with Photo</li>
                <li>Util - `BulkUserUpload.php` to upload the data into `TblUser` </li>
                <li>DB Design Change - Add Year, AadhaarCard in the TblStudent</li>
                <li>Uploaded the Student data via PhpMyAdmin for the 9 students.</li>
                <li>Verified the students details at random in the Web Application</li>
                <li>#ToDO Add Master Data - Departments and Year</li>
                <li>#ToDo UI Redesign - using Bootstrap</li>
              </ul>
            </td>
            <td></td>
        </tr>
    </tbody>
</table>

<h2>Pending</h2>

<table class="versionHistory">
    <thead>
        <tr>
            <th>Version</th>
            <th>Date</th>
            <th>Description</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1.0</td>
            <td>14 Jan 2022 Friday</td>
            <td>
              <ul>
                <li>UI Screen Alignment was done with 125%. Needs to be fixed with 100%.</li>
                <li>Database to be used for Authentication</li>
                <li>Profile View to be on the dynamic data from Database</li>
                <li>Photo is yet to be shown on the Profile View Page.</li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>1.0</td>
            <td>14 Jan 2022 Friday</td>
            <td>
                <b>Data to be collected</b>
              <ul>
                <li>15 Students sample profile data.</li>
                <li>Hosting details in GoDaddy (username, password)</li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>1.1</td>
            <td>15 Jan 2022 Saturday</td>
            <td>
              <ul>
                <li>Differentiate a registered user attempting with wrong creds Vs Unregistered User.</li>
                <li>Photo be stored and displayed on View Profile screen</li>
                <li>Add Student screen to be designed for Staff</li>
                <li>Edit Student details to be added for Staff</li>
                <li>Master data to be added for Department</li>
                <li>Aadhaar Card to be added in TblStudent</li>
              </ul>
            </td>
            <td></td>
        </tr>
    </tbody>
</table>
<?php
  require_once 'inc/footer.php';
?>
