<?php include 'includes/header.php'; ?>

<div id="wrapper">
    <div id="page-wrapper">
        <!-- Navigation -->
        <?php include 'includes/navigation.php'; ?>

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Photo</th>
                                <th>Authorization</th>
                                <th>Email</th>
                                <th>Change Role</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(!empty($_GET)){
                                switch($_GET){
                                    case isset($_GET['delete']):
                                        $user_id = (int)$_GET['delete'];
                                        $user_photo = $_GET['user_photo'];
                                        $query = "DELETE FROM users WHERE user_id=$user_id";
                                        mysqli_query($connection, $query) or die(mysqli_error($connection));
                                        unlink("img/$user_photo");
                                        break;
                                    case isset($_GET['admin']):
                                        $user_id = $_GET['admin'];
                                        $query = "UPDATE users SET role='admin' WHERE user_id=$user_id";
                                        mysqli_query($connection, $query) or die(mysqli_error($connection));
                                        break;
                                    case isset($_GET['subscriber']):
                                        $user_id = $_GET['subscriber'];
                                        $query = "UPDATE users SET role='subscriber' WHERE user_id=$user_id";
                                        mysqli_query($connection, $query) or die(mysqli_error($connection));
                                        break;
                                }
                            }
                        ?>

                        <?php
                            $query = "SELECT * FROM users";
                            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                            while($row = mysqli_fetch_assoc($result)){
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $firstname = $row['user_firstname'];
                                $lastname = $row['user_lastname'];
                                $user_photo = $row['user_photo'];
                                $role = $row['role'];
                                $email = $row['email'];

                                echo "<tr>";
                                echo "<td>$username</td>";
                                echo "<td>$firstname</td>";
                                echo "<td>$lastname</td>";
                                echo "<td><img src='img/$user_photo' alt='' width='75px'></td>";
                                echo "<td>$role</td>";
                                echo "<td>$email</td>";
                                echo "<td><a href='users.php?admin=$user_id'>admin</a> | <a href='users.php?subscriber=$user_id'>subscriber</a></td>";
                                echo "<td><a href='users.php?delete=$user_id&user_photo=$user_photo'>delete</a></td>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
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
