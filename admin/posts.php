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
                        Posts
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    <?php
                        if(isset($_GET['action'])){
                            switch($_GET['action']){
                                case 'new_post':
                                    include 'includes/new_post.php';
                                    break;
                                case 'edit':
                                    include 'includes/edit_post.php';
                                    break;
                                case 'delete';
                                    $post_id = (int)$_GET['post_id'];
//                                    Getting the picture that belongs to the post and deleting it.
                                    $query = "SELECT post_picture FROM posts WHERE post_id=$post_id";
                                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                    $row = mysqli_fetch_assoc($result);
                                    $post_picture = $row['post_picture'];
                                    unlink("../img/$post_picture");
//                                    Deleting the post
                                    $query = "DELETE FROM posts WHERE post_id=$post_id";
                                    mysqli_query($connection, $query) or die(mysqli_error($connection));
                                    header("Location: posts.php");
                                    break;
                            }
                        } else {
                            include 'includes/view_all_posts.php';
                        }
                    ?>
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
