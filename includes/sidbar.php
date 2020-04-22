<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="searchBtn">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            </div>
            <!-- /.input-group -->
        </form>

    </div>
        <!--  Login  -->
        <?php
            if(!isset($_SESSION['username'])){ ?>
                <div class="well">
                    <p style="color: red;">Not Registered yet? Click <a href="registration.php" class="btn btn-primary">here</a></p>
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="input-group">
                            <?php
                            if(isset($_GET['noUser'])){
                                echo "<p>No Such User</p>";
                            }
                            ?>
                            <input type="text" class="form-control" name="username"
                                   placeholder="username" required>
                            <input type="password" class="form-control" name="password"
                                   style="margin-top: 10px;" placeholder="password" required>
                            <?php
                            if(isset($_GET['wrongPass'])){
                                echo "<p>Wrong Password</p>";
                            }
                            ?>
                            <input type="submit" name="login" value="Log In" class="btn btn-primary" style="margin-top: 10px;">
                        </div>
                        <!-- /.input-group -->
                    </form>
                </div>
            <?php }
                elseif(isset($_SESSION['username'])){ ?>

                    <form action="includes/login.php" method="post">
                        <input type="submit" name="logout" value="Log Out" class="btn btn-danger" style="margin-bottom: 10px;">
                    </form>

                <?php }
            ?>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                    while($row = mysqli_fetch_assoc($result)){
                        $cat_id = $row['cat_id'];
                        $cat_name = $row['cat_name']; ?>
                        <li><a href='category.php?cat_id=<?php echo $cat_id; ?>'><?php echo "$cat_name"; ?></a></li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>