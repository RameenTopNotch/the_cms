<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Picture</th>
            <th>cmt_count</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM posts FULL JOIN categories ON cat_id=post_cat_id";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        while($row = mysqli_fetch_assoc($result)){
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_cat = $row['cat_name'];
            $post_status = $row['post_status'];
            $post_picture = $row['post_picture'];
            $post_cmt_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
            echo "<td>$post_author</td>";
            echo "<td><a href='#'>$post_title</a></td>";
            echo "<td>$post_cat</td>";
            echo "<td>$post_status</td>";
            echo "<td><img src='../img/$post_picture' alt='' width='100px'></td>";
            echo "<td>$post_cmt_count</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='posts.php?action=edit&post_id=$post_id'>edit</a></td>";
            echo "<td><a href='posts.php?action=delete&post_id=$post_id'>delete</a></td>";
            echo "</tr>";
        }
    ?>
    </tbody>
</table>