<?php
  //require_once 'inc/header.php';
  require_once __DIR__ . './inc/header.php';
?>

<h2>Completed</h2>

<table class="table table-hover table-bordered versionHistory">
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
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>2.0</td>
            <td>16 Jan 2022 Sunday</td>
            <td>
              <ul>
                <li>(WIP) UI Redesign - using Bootstrap</li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>2.1</td>
            <td>18 Jan 2022 Tuesday</td>
            <td>
              <ul>
                <li>Add and Edit Student Profile</li>
                <li>Sign Up/Registration Page - to add UserId, Password</li>
                <li>(Functional) Validate the Registration Number of the Student during Registration</li>
                <li>Front End validation for all the values in the Registration Form</li>
                <li>TblStudent - new columns (Community, Dayscholar/Hosteler)</li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>2.2</td>
            <td>18 Apr 2022 Monday</td>
            <td>
              <ul>
                <li>Fixed the issues on Ingretiry Constraint Violation on Student Vs User (ID) - long pending!</li>
                <li>Menu Navigation fixed</li>
                <li>Introduced PHP Logging with log4php</li>
                <li>
                  Manual Bug fix on the log4PHP class `LoggerAppenderRollingFile.php`
                  based on https://stackoverflow.com/a/18789378/1001242 to avoid the
                  <b>'filesize()' stat failed</b> message. <br/>
                  <b>Error: </b> <code>Warning: filesize(): stat failed for logs/myRollingLog.log in C:\installedSoft\xampp\htdocs\sms\lib\apache-log4php-2.3.0\src\main\php\appenders\LoggerAppenderRollingFile.php on line 223</code> <br/>
                  <b>Fix : </b> <br/>
                  Changed the line #223 from <br/>
                  <code>if (filesize($this->file) > $this->maxFileSize)</code> <br/>
                  to <br/>
                  <code>if (filesize(realpath($this->file)) > $this->maxFileSize) { </code>.
                </li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>2.3</td>
            <td>21 Apr 2022 Thursday</td>
            <td>
              <ul>
                <li>Session Timeout Implemented</li>
                <li>Profile Photo enabled</li>
                <li>Search with Pagination added for Users and Students</li>
              </ul>
            </td>
            <td></td>
        </tr>
    </tbody>
</table>

<h2>Bugs</h2>
<table class="table table-hover table-bordered versionHistory">
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
            <td>19 Apr 2022 Tuesday</td>
            <td>
              <ul>
                <li>(DONE) Session is not getting destroyed when logging out.</li>
              </ul>
            </td>
            <td></td>
        </tr>
    </tbody>
</table>

<h2>Pending</h2>

<table class="table table-hover table-bordered versionHistory">
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
                <li>(DONE) Database to be used for Authentication</li>
                <li>(DONE) Profile View to be on the dynamic data from Database</li>
                <li>(DONE) Photo is yet to be shown on the Profile View Page.</li>
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
        <tr>
            <td>2.0</td>
            <td>18 Jan 2022 Tuesday</td>
            <td>
              <ul>
                <li>(DONE) Session Timeout to be implemented</li>
                <li>BootStrap UI font size issue to be fixed</li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>2.1</td>
            <td>20 Apr 2022 Tuesday</td>
            <td>
              <ul>
                <li>Capture the Login details in the DB Table (TblLoginInfo)</li>
                <li>Capture the Application Log via log4php via PDO to DB Table</li>
                <li>Send Application emails on certain events, via log4php. </li>
                <li>Make the photo extension dynamic and not just the .jpg extension.</li>
                <li>Store the Photo in the Database than in the FileSystem</li>
              </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>1.0</td>
            <td>23 Apr 2022 Saturday</td>
            <td>
                <li>Config Mode added</li>
                <li>VERSION_INFO in Footer added</li>
                <li>Quick Login Util added for the DEV Mode</li>
                <li>Department IS_DELETED renamed to IS_ACTIVE to be consistent</li>
                <li>All the BO classes now extend BaseBO</li>
                <li>BO and DAO Classed added for the other tables - TblUserRole, TblRole, TblStudent</li>
                <li>DAO Methods added - getAllRoles(), getRolesForUser()</li>
              </ul>
            </td>
            <td>
              <ul>
                <li></li>
              </ul>
            </td>
        </tr>
    </tbody>
</table>
<?php
  //require_once 'inc/footer.php';
  require_once __DIR__ . './inc/footer.php';
?>
