<?php
    if(isset($_POST['searchBtn']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
//        including header and navigation
        include 'includes/header.php';
        include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    The most interesting blog in the globe!
                </h1>
                <?php
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status='published'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                while($row = mysqli_fetch_assoc($result)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_picture = $row['post_picture'];
                    $post_content = $row['post_content'];
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
                <img class="img-responsive" src="MATERIALS/<?php echo $post_picture ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php } ?>

            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidbar.php'; ?>


        </div>
        <!-- /.row -->

        <!-- footer -->
        <?php include 'includes/footer.php';
    } else {
        header("Location: index.php");
    } ?>
