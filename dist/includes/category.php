<?php
session_start();
include 'connection.php';

// Function to validate input data
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Add Category
if(isset($_POST['add_category'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    
    // Validate inputs
    if(empty($name)) {
        header('location: ../pages/categories.php?error=Category name is required');
        exit();
    } else if(empty($description)) {
        header('location: ../pages/categories.php?error=Description is required');
        exit();
    }
    
    // Check if category already exists
    $check_sql = "SELECT * FROM categories WHERE name = '$name'";
    $check_result = mysqli_query($db, $check_sql);
    
    if(mysqli_num_rows($check_result) > 0) {
        header('location: ../pages/categories.php?error=Category with this name already exists');
        exit();
    }
    
    // Insert new category
    $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    $result = mysqli_query($db, $sql);
    
    if($result) {
        header('location: ../pages/categories.php?success=Category added successfully');
        exit();
    } else {
        header('location: ../pages/categories.php?error=Failed to add category: ' . mysqli_error($db));
        exit();
    }
}

// Delete Category
if(isset($_GET['delete'])) {
    $id = validate($_GET['delete']);
    
    // Check if category is being used in feedbacks
    $check_sql = "SELECT * FROM feedbacks WHERE category_id = '$id'";
    $check_result = mysqli_query($db, $check_sql);
    
    if(mysqli_num_rows($check_result) > 0) {
        header('location: ../pages/categories.php?error=Cannot delete category because it is being used in feedbacks');
        exit();
    }
    
    // Delete category
    $sql = "DELETE FROM categories WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
    
    if($result) {
        header('location: ../pages/categories.php?success=Category deleted successfully');
        exit();
    } else {
        header('location: ../pages/categories.php?error=Failed to delete category');
        exit();
    }
}

// Edit Category
if(isset($_POST['edit_category'])) {
    $id = validate($_POST['id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    
    // Validate inputs
    if(empty($name)) {
        header('location: ../pages/edit-category.php?id='.$id.'&error=Category name is required');
        exit();
    } else if(empty($description)) {
        header('location: ../pages/edit-category.php?id='.$id.'&error=Description is required');
        exit();
    }
    
    // Check if category name already exists (excluding current category)
    $check_sql = "SELECT * FROM categories WHERE name = '$name' AND id != '$id'";
    $check_result = mysqli_query($db, $check_sql);
    
    if(mysqli_num_rows($check_result) > 0) {
        header('location: ../pages/edit-category.php?id='.$id.'&error=Category with this name already exists');
        exit();
    }
    
    // Update category
    $current_time = date('Y-m-d H:i:s');
    $sql = "UPDATE categories SET name = '$name', description = '$description', updated_at = '$current_time' WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
    
    if($result) {
        header('location: ../pages/categories.php?success=Category updated successfully');
        exit();
    } else {
        header('location: ../pages/edit-category.php?id='.$id.'&error=Failed to update category');
        exit();
    }
}