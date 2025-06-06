<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->
  <!--begin::App Content-->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <?php
          include '../includes/connection.php';
          
          // Count total feedbacks
          $feedback_sql = "SELECT COUNT(*) as total FROM feedbacks";
          $feedback_result = mysqli_query($db, $feedback_sql);
          $feedback_count = mysqli_fetch_assoc($feedback_result)['total'];
          
          // Count total users
          $user_sql = "SELECT COUNT(*) as total FROM users";
          $user_result = mysqli_query($db, $user_sql);
          $user_count = mysqli_fetch_assoc($user_result)['total'];
          
          // Count total categories
          $category_sql = "SELECT COUNT(*) as total FROM categories";
          $category_result = mysqli_query($db, $category_sql);
          $category_count = mysqli_fetch_assoc($category_result)['total'];
        ?>
        <!--begin::Col-->
        <div class="col-lg-3 col-6">
          <!--begin::Small Box Widget 1-->
          <div class="small-box text-bg-primary">
            <div class="inner">
              <h3><?php echo $feedback_count; ?></h3>
              <p>Feedbacks</p>
            </div>
            <svg
              class="small-box-icon"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
              ></path>
            </svg>
            <a
              href="admin-feedbacks.php"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
            >
              More info <i class="bi bi-link-45deg"></i>
            </a>
          </div>
          <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
          <!--begin::Small Box Widget 2-->
          <div class="small-box text-bg-success">
            <div class="inner">
              <h3><?php echo $user_count; ?></h3>
              <p>Users</p>
            </div>
            <svg
              class="small-box-icon"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
              ></path>
            </svg>
            <a
              href="#"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
            >
              More info <i class="bi bi-link-45deg"></i>
            </a>
          </div>
          <!--end::Small Box Widget 2-->
        </div>
        <div class="col-lg-3 col-6">
          <!--begin::Small Box Widget 3-->
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3><?php echo $category_count; ?></h3>
              <p>Categories</p>
            </div>
            <svg
              class="small-box-icon"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
              ></path>
            </svg>
            <a
              href="categories.php"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
            >
              More info <i class="bi bi-link-45deg"></i>
            </a>
          </div>
          <!--end::Small Box Widget 3-->
        </div>
      </div>
      <!--end::Row-->

      <!-- Recent Feedbacks -->
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent Feedbacks</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Category</th>
                      <th>Content</th>
                      <th>Location</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $recent_sql = "SELECT f.*, u.username, c.name as category_name 
                                     FROM feedbacks f 
                                     INNER JOIN users u ON f.user_id = u.id 
                                     INNER JOIN categories c ON f.category_id = c.id 
                                     ORDER BY f.created_at DESC LIMIT 5";
                      
                      $recent_result = mysqli_query($db, $recent_sql);
                      
                      if(mysqli_num_rows($recent_result) > 0) {
                        while($row = mysqli_fetch_assoc($recent_result)) {
                          echo "<tr>";
                          echo "<td>".$row['username']."</td>";
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
            <div class="card-footer">
              <a href="admin-feedbacks.php" class="btn btn-primary">View All Feedbacks</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Feedback by Category Chart -->
      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Feedbacks by Category</h3>
            </div>
            <div class="card-body">
              <div id="feedbackCategoryChart" style="height: 300px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent User Activity</h3>
            </div>
            <div class="card-body">
              <div id="userActivityChart" style="height: 300px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Feedback by Category Chart
    <?php
      $category_data_sql = "SELECT c.name, COUNT(f.id) as count 
                           FROM categories c 
                           LEFT JOIN feedbacks f ON c.id = f.category_id 
                           GROUP BY c.id 
                           ORDER BY count DESC";
      $category_data_result = mysqli_query($db, $category_data_sql);
      
      $categories = [];
      $counts = [];
      
      while($row = mysqli_fetch_assoc($category_data_result)) {
        $categories[] = $row['name'];
        $counts[] = (int)$row['count'];
      }
    ?>
    
    const categoryChartOptions = {
      series: [{
        name: 'Feedbacks',
        data: <?php echo json_encode($counts); ?>
      }],
      chart: {
        type: 'bar',
        height: 300
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      xaxis: {
        categories: <?php echo json_encode($categories); ?>,
      },
      colors: ['#0d6efd']
    };

    const categoryChart = new ApexCharts(document.querySelector("#feedbackCategoryChart"), categoryChartOptions);
    categoryChart.render();
    
    // User Activity Chart
    <?php
      $activity_sql = "SELECT DATE(created_at) as date, COUNT(*) as count 
                      FROM feedbacks 
                      GROUP BY DATE(created_at) 
                      ORDER BY date DESC 
                      LIMIT 7";
      $activity_result = mysqli_query($db, $activity_sql);
      
      $dates = [];
      $activity_counts = [];
      
      while($row = mysqli_fetch_assoc($activity_result)) {
        $dates[] = $row['date'];
        $activity_counts[] = (int)$row['count'];
      }
      
      // Reverse arrays to show chronological order
      $dates = array_reverse($dates);
      $activity_counts = array_reverse($activity_counts);
    ?>
    
    const userActivityOptions = {
      series: [{
        name: 'Feedbacks',
        data: <?php echo json_encode($activity_counts); ?>
      }],
      chart: {
        height: 300,
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
        type: 'datetime',
        categories: <?php echo json_encode($dates); ?>
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy'
        },
      },
      colors: ['#20c997']
    };

    const userActivityChart = new ApexCharts(document.querySelector("#userActivityChart"), userActivityOptions);
    userActivityChart.render();
  });
</script>

<?php include 'footer.php'; ?>
