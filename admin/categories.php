<?php include 'includes/header.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Categories
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                                if(isset($_POST['add_cat'])){
                                    $cat_name = $_POST['cat_name'];
                                    $query = "INSERT INTO categories(cat_name) VALUES('$cat_name')";
                                    mysqli_query($connection, $query) or die(mysqli_error($connection));
                                }

                                if(isset($_POST['edit_cat_name'])){
                                    $cat_name = $_POST['cat_name'];
                                    $cat_id = $_GET['cat_id'];
                                    $query = "UPDATE categories SET cat_name='$cat_name' WHERE cat_id=$cat_id";
                                    mysqli_query($connection, $query) or die(mysqli_error($connection));
                                    header("Location: categories.php");
                                }

                                if(isset($_GET['delete'])){
                                    $cat_id = $_GET['delete'];
                                    $query = "DELETE FROM categories WHERE cat_id=$cat_id";
                                    mysqli_query($connection, $query) or die(mysqli_error($connection));
                                }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" name="cat_name" class="form-control" placeholder="Enter a new category" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="add_cat" class="btn btn-primary" value="Add Category">
                                </div>
                            </form>

                            <?php
                                if(isset($_GET['edit'])){
                                    $cat_name = $_GET['edit']; ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" name="cat_name" class="form-control" value="<?php echo $cat_name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="edit_cat_name" class="btn btn-primary" value="Edit Category">
                                        </div>
                                    </form>
                                <?php } ?>


                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Name</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query = "SELECT * FROM categories";
                                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                    while($row = mysqli_fetch_assoc($result)){
                                        $cat_id = $row['cat_id'];
                                        $cat_name = $row['cat_name'];
                                        echo "<tr>";
                                        echo "<td>$cat_id</td>";
                                        echo "<td>$cat_name</td>";
                                        echo "<td><a href='categories.php?delete=$cat_id'>Delete</a>";
                                        echo "<td><a href='categories.php?edit=$cat_name&cat_id=$cat_id'>Edit</a>";
                                        echo "</tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
