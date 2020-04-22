<!-- header -->
<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if(isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                        echo "<h2 style='color: orange;'>Hello $username!</h1>";
                    }

                ?>
                <h1 class="page-header">
                    The most interesting blog in the globe!
                </h1>
                <?php
                $query = "SELECT 1 FROM posts";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $posts_no = mysqli_num_rows($result);
                $postPerPage = 3;
                $pages = ceil($posts_no / $postPerPage);
                if(!isset($_GET['page']) or $_GET['page']=='1'){
                    $startPost = 0;
                    $endPost = $postPerPage;
                    $page = 1;
                } else {
                    $startPost = $postPerPage * ($_GET['page'] - 1);
                    $page = $_GET['page'];
                }

                $query = "SELECT * FROM posts WHERE post_status='published' LIMIT $startPost, $postPerPage";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                while($row = mysqli_fetch_assoc($result)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_picture = $row['post_picture'];
                    $post_tags = $row['post_tags'];
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
                <h4>Tags</h4>
                <p style="color: green;"><?php echo $post_tags; ?></p>
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

        <hr>

        <ul class="pager">
            <?php
                for($i=1; $i<=$pages; $i++){
                    if($i==$page){
                        echo "<li><a href='index.php?page=$i' style='color: white; background-color: #2e6da4'>$i</a></li>";
                    } else {
                        echo "<li><a href='index.php?page=$i'>$i</a></li>";
                    }
                }
            ?>
        </ul>

        <!-- footer -->
        <?php include 'includes/footer.php'; ?>


