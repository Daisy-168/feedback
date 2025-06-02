<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="app-content">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Edit Category</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
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
              <h3 class="card-title">Edit Category</h3>
            </div>
            <?php
              include '../includes/connection.php';
              
              if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM categories WHERE id = '$id'";
                $result = mysqli_query($db, $sql);
                
                if(mysqli_num_rows($result) > 0) {
                  $category = mysqli_fetch_assoc($result);
                } else {
                  echo "<div class='alert alert-danger'>Category not found</div>";
                  exit();
                }
              } else {
                header('location: categories.php');
                exit();
              }
            ?>
            <form action="../includes/category.php" method="post">
              <div class="card-body">
                <?php if(isset($_GET['error'])): ?>
                  <div class="alert alert-danger"><?=$_GET['error']?></div>
                <?php endif; ?>
                
                <input type="hidden" name="id" value="<?=$category['id']?>">
                
                <div class="mb-3">
                  <label for="name" class="form-label">Category Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?=$category['name']?>" required>
                </div>
                
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="3" required><?=$category['description']?></textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="edit_category" class="btn btn-primary">Update Category</button>
                <a href="categories.php" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>