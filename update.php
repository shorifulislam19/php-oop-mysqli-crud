<?php 
include "config.php";
include "Database.php";

$db = new Database();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM tbl_user WHERE id=$id";
$getData = $db->select($query);

if ($getData) {
    $user = $getData->fetch_assoc();
} else {
    die("User not found!");
}

// Update User
if(isset($_POST['submit'])){
    $name  = mysqli_real_escape_string($db->link, $_POST['name']);
    $email = mysqli_real_escape_string($db->link, $_POST['email']);
    $skill = mysqli_real_escape_string($db->link, $_POST['skill']);

    if(empty($name) || empty($email) || empty($skill)){
        $error = "Field must not be empty!";
    } else {
        $query = "UPDATE tbl_user 
                  SET name = '$name', email = '$email', skill = '$skill' 
                  WHERE id = $id";

        $update = $db->update($query);
        if($update){
            header("Location: index.php?msg=User Updated Successfully");
            exit();
        } else {
            $error = "Something went wrong!";
        }
    }
}

// Delete User
if(isset($_POST['delete'])){
    $query = "DELETE FROM tbl_user WHERE id = $id";
    $delete = $db->update($query);
    if($delete){
        header("Location: index.php?msg=User Deleted Successfully");
        exit();
    } else {
        $error = "Failed to delete user!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <h2 class="text-center">Update User</h2>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="update.php?id=<?php echo $id; ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Skill</label>
            <input type="text" name="skill" class="form-control" value="<?php echo $user['skill']; ?>">
        </div>

        <button type="submit" name="submit" class="btn btn-success">Update</button>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
        <a href="index.php" class="btn btn-secondary">Go Back</a>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
