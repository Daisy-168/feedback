<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="app-content">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Categories</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Add Category</h3>
            </div>
            <form action="../includes/category.php" method="post">
              <div class="card-body">
                <?php if(isset($_GET['error'])): ?>
                  <div class="alert alert-danger"><?=$_GET['error']?></div>
                <?php endif; ?>
                
                <?php if(isset($_GET['success'])): ?>
                  <div class="alert alert-success"><?=$_GET['success']?></div>
                <?php endif; ?>
                
                <div class="mb-3">
                  <label for="name" class="form-label">Category Name</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
              </div>
            </form>
          </div>
        </div>
        
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category List</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Created At</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include '../includes/connection.php';
                      
                      $sql = "SELECT * FROM categories ORDER BY created_at DESC";
                      $result = mysqli_query($db, $sql);
                      
                      if(mysqli_num_rows($result) > 0) {
                        $count = 1;
                        while($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td>".$count++."</td>";
                          echo "<td>".$row['name']."</td>";
                          echo "<td>".$row['description']."</td>";
                          echo "<td>".date('M d, Y H:i', strtotime($row['created_at']))."</td>";
                          echo "<td>
                                  <a href='edit-category.php?id=".$row['id']."' class='btn btn-sm btn-info'>Edit</a>
                                  <a href='../includes/category.php?delete=".$row['id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</a>
                                </td>";
                          echo "</tr>";
                        }
                      } else {
                        echo "<tr><td colspan='5' class='text-center'>No categories found</td></tr>";
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
