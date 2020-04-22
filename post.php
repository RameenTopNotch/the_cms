<!-- header -->
<?php include 'includes/header.php'; ?>

<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                The most interesting blog in the globe!
            </h1>
            <?php
            $post_id = (int)$_GET['post_id'];
            $query = "SELECT * FROM posts WHERE post_id=$post_id";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            $row = mysqli_fetch_assoc($result);
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_picture = $row['post_picture'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            ?>
            <!-- The Post -->
            <h2>
                <?php echo $post_title ?>
            </h2>
            <p class="lead">
                by <?php echo $post_author ?>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="img/<?php echo $post_picture ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <h4>Tags</h4>
            <p style="color: green;"><?php echo $post_tags; ?></p>
            <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">
                Read More <span class="glyphicon glyphicon-chevron-right"></span>
            </a>

            <hr>
<!-- comment section -->
            <div class="well">
                <?php
                    if(!isset($_SESSION['username'])){
                        echo "<p style='color: red;'>You must log-in to put a comment</p>";
                    } elseif(isset($_GET['sent'])){
                        echo "<p style='color: green;'>You're comment has been sent, wait for approval</p>";
                    }
                ?>
                <h4>Leave a Comment</h4>
                <form method="post" action="">
                    <div class="form-group">
                        <textarea name="comment_content" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="comment">Submit Comment</button>
                </form>
            </div>

            <?php
                $query = "SELECT * FROM comments WHERE comment_post_id=$post_id";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

                while($row = mysqli_fetch_assoc($result)){
                    $comment_status = $row['comment_status'];
                    if($comment_status == 'unapproved')
                        continue;
                    $comment_writer = $row['comment_writer'];
//                    finding the user photo
                    $query2 = "SELECT user_photo FROM users WHERE username='$comment_writer'";
                    $result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
                    $row2 = mysqli_fetch_assoc($result2);
                    $user_photo = $row2['user_photo'];

                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date']; ?>

                    <div class="media">
                        <a href="#" class="pull-left">
                            <img src="admin/img/<?php echo $user_photo; ?>" width='50px' alt="" class="media-object">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <?php echo $comment_writer; ?><small> <?php echo $comment_date; ?></small>
                            </h4>
                            <p><?php echo $comment_content; ?></p>

                        </div>
                    </div>

            <?php } ?>

            <?php
                if(isset($_POST['comment']) && isset($_SESSION['username'])){
                    $comment_writer = $_SESSION['username'];
//                    Getting user's email from database
                    $query = "SELECT * FROM users WHERE username='$comment_writer'";
                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                    $row = mysqli_fetch_assoc($result);
                    $user_email = $row['email'];


//                    Inserting Comment
                    $comment = mysqli_real_escape_string($connection, $_POST['comment_content']);
                    $query = "INSERT INTO comments(comment_post_id, comment_writer, comment_email, comment_content) 
                            VALUES($post_id, '$comment_writer', '$user_email', '$comment')";
                    mysqli_query($connection, $query);


//                    Increasing the comment count for the post
                    $query = "SELECT post_comment_count FROM posts WHERE post_id=$post_id";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($result);
                    $post_comment_count = $row['post_comment_count'] + 1;
                    $query = "UPDATE posts SET post_comment_count=$post_comment_count WHERE post_id=$post_id";
                    mysqli_query($connection, $query);

                    header("Location: post.php?post_id=$post_id&sent=1");
                }
            ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidbar.php'; ?>


    </div>
    <!-- /.row -->

    <!-- footer -->
    <?php include 'includes/footer.php'; ?>


