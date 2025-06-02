<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="app-content">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">My Feedbacks</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Feedback History</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Category</th>
                      <th>Content</th>
                      <th>Location</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include '../../includes/connection.php';
                      $user_id = $_SESSION['user_id'];
                      
                      $sql = "SELECT f.*, c.name as category_name 
                              FROM feedbacks f 
                              INNER JOIN categories c ON f.category_id = c.id 
                              WHERE f.user_id = '$user_id' 
                              ORDER BY f.created_at DESC";
                      
                      $result = mysqli_query($db, $sql);
                      
                      if(mysqli_num_rows($result) > 0) {
                        $count = 1;
                        while($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td>".$count++."</td>";
                          echo "<td>".$row['category_name']."</td>";
                          echo "<td>".$row['content']."</td>";
                          echo "<td>".$row['location']."</td>";
                          echo "<td>".date('M d, Y H:i', strtotime($row['created_at']))."</td>";
                          echo "</tr>";
                        }
                      } else {
                        echo "<tr><td colspan='5' class='text-center'>No feedbacks found</td></tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>