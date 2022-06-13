<?php
  require_once __DIR__ . '/../inc/header.php';

  require_once __DIR__ . '/../inc/header.php';
  require_once __DIR__ . '/../dao/UserDAO.php';
  require_once __DIR__ . '/../bo/TblUserBO.php';
  //session_start();

  $UserDAO = new UserDAO;
  $userBOArray = array();
  $userBOArray = $UserDAO->getAllUsers();
  $count = count($userBOArray);
  $userBO = $userBOArray[$count-1];

  /* Pagination based on https://www.positronx.io/create-pagination-in-php-with-mysql-and-bootstrap/ */
  if(isset($_POST['records-limit'])){
      $_SESSION['records-limit'] = $_POST['records-limit'];
  }

  $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
  $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;

  /*$page = (isset($_SESSION['page']) && is_numeric($_SESSION['page']) ) ? $_SESSION['page'] : 0;

  if($page==0) {
    $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
  }*/

  /* My Own - Order */
  $order = isset($_GET['order']) ? $_GET['order'] : 'desc';

  /*if(empty($order)) {
    $order = isset($_SESSION['order']) ? $_SESSION['order'] : 'desc';
  }*/

  if(strcmp($order, "asc")!=0 && strcmp($order, "desc")!=0) {
    $order = "desc";
  }

  /* Retain the values in Session for reusing it when coming back from view Page */
  /*$_SESSION['records-limit'] = $limit;
  $_SESSION['page'] = $page;
  $_SESSION['order'] = $order;*/


  $paginationStart = ($page - 1) * $limit;
  global $pdo;
  $users = $pdo->query("SELECT * FROM TblUser ORDER BY ID $order LIMIT $paginationStart, $limit")->fetchAll();
  // Get total records
  $sql = $pdo->query("SELECT count(id) AS id FROM TblUser")->fetchAll();
  $allRecords = $sql[0]['id'];

  // Calculate total pages
  $totalPages = ceil($allRecords / $limit);
  // Prev + Next
  $prev = $page - 1;
  $next = $page + 1;

?>
      <h2>List - Users</h2>

      <p>
        Totally, there are <b><?php echo $count; ?> Users</b> are there in the System.
      </p>

      <?php
        if(isset($_SESSION['errorMsg']) && !empty($_SESSION['errorMsg'])) {
          echo "<center><span style='color: red'>" . $_SESSION['errorMsg'] . "</span></center>";
          unset($_SESSION['errorMsg']);
        }
      ?>
      <?php
        if(isset($_SESSION['profileNotFoundMsg']) && !empty($_SESSION['profileNotFoundMsg'])) {
          echo "<center><span style='color: red'>" . $_SESSION['profileNotFoundMsg'] . "</span></center>";
          unset($_SESSION['profileNotFoundMsg']);
        }
      ?>
      <!-- Select dropdown -->
      <div class="d-flex flex-row-reverse bd-highlight mb-3">
          <form action="list.php" method="post">
              <select name="records-limit" id="records-limit" class="custom-select">
                  <option disabled selected>Records Limit</option>
                  <?php foreach([3,5,7,10,12] as $limit) : ?>
                  <option
                      <?php if(isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?>
                      value="<?= $limit; ?>">
                      <?= $limit; ?>
                  </option>
                  <?php endforeach; ?>
              </select>
              &nbsp; | &nbsp;
              <b>Order : </b> &rarr;
              <?php if(strcmp($order, 'desc') == 0) { ?>
                  <a class="page-link" href="list.php?order=asc">Ascending</a>
              <?php } else { ?>
                  <span style='color:gray;'>Ascending</span>
              <?php } ?>
              &nbsp; | &nbsp;
              <?php if(strcmp($order, 'asc') == 0) { ?>
                  <a class="page-link" href="list.php?order=desc">Descending</a>
              <?php } else {
              ?>
                  <span style='color:gray;'>Descending</span>
              <?php } ?>
          </form>
      </div>
      <!-- Datatable -->
      <div class="table-responsive-md">
        <table class="table table-hover table-bordered table-striped">
          <caption>User Data</caption>
          <thead class="thead-light">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">User Id</th>
                <th scope="col">Created Date</th>
                <th scope="col">Created By</th>
                <th scope="col">Is Active</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //foreach ($userBOArray as $k => $v) {
              ?>
                <!--<tr>
                  <th scope="row"><?php //echo $v->getId();?></th>
                  <td><?php //echo $v->getUserId();?></td>
                  <td><?php //echo $v->getCreatedDate();?></td>
                  <td><?php //echo $v->getCreatedBy();?></td>
                  <td><?php //echo $v->getIsActive();?></td>
                </tr>-->
              <?php
              //}
              ?>
              <?php
              foreach ($users as $k => $v) {
              ?>
                <tr>
                  <th scope="row">
                    <a href='view.php?UserId=<?php echo $v['UserId'];?>'><?php echo $v['Id'];?></a>
                    &nbsp;|&nbsp;
                    <a href='edit.php?UserId=<?php echo $v['Id'];?>'>E</a>
                  </th>
                  <td><?php echo $v['UserId'];?></td>
                  <td><?php echo $v['CREATED_DATE'];?></td>
                  <td><?php echo $v['CREATED_BY'];?></td>
                  <td><?php echo $v['IS_ACTIVE'];?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
        </table>
        <!-- Pagination -->
        <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                </li>
                <?php for($i = 1; $i <= $totalPages; $i++ ): ?>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="list.php?page=<?= $i; ?>&order=<?= $order;?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?php if($page >= $totalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>
      </div>
<?php
  require_once __DIR__ . '/../inc/footer.php';
?>
