<form action="" method="post" enctype="multipart/form-data">
    <?php
        $post_id = (int)$_GET['post_id'];
        $query = "SELECT * FROM posts WHERE post_id=$post_id";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $row = mysqli_fetch_assoc($result);
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_author = $row['post_author'];
        $post_status = $row['post_status'];
        $post_picture = $row['post_picture'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
    ?>
    <h3>Edit The Post</h3>
    <div class="form-group">
        <label>Post Title</label>
        <input type="text" class="form-control" name="post_title" style="width: 60vw" value="<?php echo $post_title; ?>">
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
                if($cat_id == $post_cat_id){
                    echo "<option value='$cat_id' selected>$cat_name</option>";
                } else {
                    echo "<option value='$cat_id'>$cat_name</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Post Author</label>
        <input type="text" class="form-control" name="post_author" style="width: 60vw" value="<?php echo $post_author; ?>">
    </div>

    <div class="form-group">
        <label>Post Status</label>
        <select name="post_status" style="width: 7vw; class="form-control">
            <?php
                if($post_status == 'published'){
                    echo "<option value=\"published\" selected>Published</option>";
                    echo "<option value=\"draft\">draft</option>";
                } else {
                    echo "<option value=\"published\">Published</option>";
                    echo "<option value=\"draft\" selected>draft</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Post Picture</label>
        <img src="../img/<?php echo $post_picture ?>" alt="" width="100px">
        <input type="file" name="post_picture">
    </div>

    <div class="form-group">
        <label>Post Tags</label>
        <textarea name="post_tags" class="form-control" style="width: 60vw"><?php echo $post_tags ?></textarea>
    </div>

    <div class="form-group">
        <label>Post Content</label>
        <textarea name="post_content" class="form-control" style="width: 60vw"><?php echo $post_content ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="submit" value="Edit Post" class="btn btn-success">
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

    $query = "UPDATE posts SET post_cat_id=$post_cat_id, post_title='$post_title', 
                post_author='$post_author', post_picture='$post_picture', 
                post_tags='$post_tags', post_status='$post_status', 
                post_content='$post_content' WHERE post_id=$post_id";

    mysqli_query($connection, $query) or die(mysqli_error($connection));

    header("Location: posts.php");
}


?>