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
            $cat_id = (int)$_GET['cat_id'];
            $query = "SELECT * FROM posts WHERE post_status='published' AND post_cat_id=$cat_id";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            while($row = mysqli_fetch_assoc($result)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_picture = $row['post_picture'];
                $post_content = substr($row['post_content'], 0, 200);
                ?>
                <!-- First Blog Post -->
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
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">
                    Read More <span class="glyphicon glyphicon-chevron-right"></span>
                </a>

                <hr>

            <?php } ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidbar.php'; ?>


    </div>
    <!-- /.row -->

    <!-- footer -->
    <?php include 'includes/footer.php'; ?>


