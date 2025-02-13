<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .table th, .table td {
            text-align: center;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn-edit {
            background-color: #28a745;
            color: white;
        }
        .btn-edit:hover {
            background-color: #218838;
        }
        .btn-create {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">User Information</h2>

    <?php 
    include "config.php";
    include "Database.php";

    $db = new Database();
    $query = "SELECT * FROM tbl_user";
    $read = $db->select($query);

    if(isset($_GET['msg'])){
        echo "<div class='alert alert-success'>".$_GET['msg']."</div>";
    }
    ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="10%">Serial</th>
                <th width="35%">Name</th>
                <th width="25%">Email</th>
                <th width="15%">Skill</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if($read){ ?>
            <?php 
            $i=1;
            while($row = $read->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['skill']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-sm btn-edit">Edit</a>
                    <a href="delete.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5" class="text-center text-danger">Data is not available!</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="create.php" class="btn btn-primary btn-create">Create New User</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
