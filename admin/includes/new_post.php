<?php
    $username = $_SESSION['username'];
?>
<form action="" method="post" enctype="multipart/form-data">
    <h3>Add a New Post</h3>
    <div class="form-group">
        <label>Post Title</label>
        <input type="text" class="form-control" name="post_title" style="width: 60vw">
    </div>

    <div class="form-group">
        <label>Post Category</label>
        <?php
            $query = "SELECT * FROM categories";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        ?>
        <select name="post_cat_id" class="form-control" style="width: 20vw;">
            <?php
                while($row = mysqli_fetch_assoc($result)){
                    $cat_id = $row['cat_id'];
                    $cat_name = $row['cat_name'];
                    echo "<option value='$cat_id'>$cat_name</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Post Author</label>
        <input type="text" class="form-control" name="post_author" style="width: 60vw" value="<?php echo $username; ?>" readonly>
    </div>

    <div class="form-group">
        <label>Post Status</label>
        <select name="post_status" style="width: 7vw; class="form-control">
            <option value="published">Published</option>
            <option value="draft">draft</option>
        </select>
    </div>

    <div class="form-group">
        <label>Post Picture</label>
        <input type="file" name="post_picture">
    </div>

    <div class="form-group">
        <label>Post Tags</label>
        <textarea name="post_tags" class="form-control" style="width: 60vw"></textarea>
    </div>

    <div class="form-group">
        <label>Post Content</label>
        <textarea name="post_content" class="form-control" style="width: 60vw"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="submit" value="Add Post" class="btn btn-success">
    </div>
</form>

<?php
    if(isset($_POST['submit'])){
        $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
        $post_author = mysqli_real_escape_string($connection,$_POST['post_author']);
        $post_cat_id = (int)$_POST['post_cat_id'];
        $post_status = $_POST['post_status'];
        $post_picture = $_FILES['post_picture']['name'];;
        $post_picture_temp = $_FILES['post_picture']['tmp_name'];
        move_uploaded_file($post_picture_temp, "../img/$post_picture");
        $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);

        $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_picture,
                post_tags, post_status, post_content) VALUES($post_cat_id, '$post_title', '$post_author',
                now(), '$post_picture', '$post_tags', '$post_status', '$post_content')";

        mysqli_query($connection, $query) or die(mysqli_error($connection));

        header("Location: posts.php");
    }


?>

























