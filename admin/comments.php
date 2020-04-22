<?php include 'includes/header.php'; ?>

<div id="wrapper">
    <div id="page-wrapper">
        <?php
            if(!empty($_GET)){
                switch($_GET){
                    case isset($_GET['delete']):
                        $comment_id = (int)$_GET['delete'];
                        $post_id = (int)$_GET['post_id'];
                        $query = "DELETE FROM comments WHERE comment_id=$comment_id";
                        mysqli_query($connection, $query) or die(mysqli_error($connection));
//                        counting down comments
                        $post_id = $_GET['post_id'];
                        $query = "SELECT post_comment_count FROM posts WHERE post_id=$post_id";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($result);
                        $post_comment_count = $row['post_comment_count'] - 1;
                        $query = "UPDATE posts SET post_comment_count=$post_comment_count WHERE post_id=$post_id";
                        mysqli_query($connection, $query);
                        break;
                    case isset($_GET['approve']):
                        $comment_id = (int)$_GET['approve'];
                        $query = "UPDATE comments SET comment_status='approved' WHERE comment_id=$comment_id";
                        mysqli_query($connection, $query) or die(mysqli_error($connection));
                        break;
                    case isset($_GET['unapprove']):
                        $comment_id = (int)$_GET['unapprove'];
                        $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id=$comment_id";
                        mysqli_query($connection, $query) or die(mysqli_error($connection));
                        break;
                }
            }
        ?>
        <!-- Navigation -->
        <?php include 'includes/navigation.php'; ?>

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Comments
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Writer</th>
                            <th>Comment Content</th>
                            <th>In Response To</th>
                            <th>Status</th>
                            <th>Writer Email</th>
                            <th>Date</th>
                            <th>Approve/Unapprove</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM posts FULL JOIN comments ON comment_post_id=post_id";
                        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                        while($row = mysqli_fetch_assoc($result)){
                            $comment_id = $row['comment_id'];
                            $post_id = $row['post_id'];
                            $comment_writer = $row['comment_writer'];
                            $comment_content = $row['comment_content'];
                            $comment_on_post = $row['post_title'];
                            $comment_status = $row['comment_status'];
                            $writer_email = $row['comment_email'];
                            $comment_date = $row['comment_date'];

                            echo "<tr>";
                            echo "<td>$comment_writer</td>";
                            echo "<td>$comment_content</a></td>";
                            echo "<td>$comment_on_post</td>";
                            echo "<td>$comment_status</td>";
                            echo "<td>$writer_email</td>";
                            echo "<td>$comment_date</td>";
                            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a> | <a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                            echo "<td><a href='comments.php?delete=$comment_id&post_id=$post_id'>delete</a></td>";
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
