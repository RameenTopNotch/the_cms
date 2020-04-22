<?php  include "includes/header.php"; ?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" enctype="multipart/form-data" autocomplete="off" required>
                            <?php
                                if(!empty($_GET)){
                                    $firstname = $_GET['firstname'];
                                    $lastname = $_GET['lastname'];
                                    $username = $_GET['username'];
                                    $email = $_GET['email'];
                                } else {
                                    $firstname = null;
                                    $lastname = null;
                                    $username = null;
                                    $email = null;
                                }
                            ?>
                            <div class="form-group">
                                <label class="sr-only">First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter Your First Name" required value="<?php echo $firstname; ?>">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Enter Your Last Name" required value="<?php echo $lastname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <?php
                                    if(isset($_GET['chosen'])){
                                        echo "<p style='color: red;'>This username is chosen already, opt another one</p>";
                                    }
                                ?>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required value="<?php echo $username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="post_image">a Photo of You</label>
                                <input type="file" name="photo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <?php
                                if(isset($_GET['exist'])){
                                    echo "<p style='color: red;'>This email exists in database, choose another one</p>";
                                }
                                ?>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                        <?php
                            if(isset($_POST['submit'])){
                                $username = $_POST['username'];
                                $firstname = $_POST['firstname'];
                                $lastname = $_POST['lastname'];
                                $email = $_POST['email'];

                                $query = "SELECT 1 FROM users WHERE username='$username'";
                                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                $user_found = mysqli_num_rows($result);
                                if($user_found != 0){
                                    header("Location: registration.php?chosen&firstname=$firstname&lastname=$lastname&email=$email&username=$username");
                                } else{
                                    $query = "SELECT 1 FROM users WHERE email='$email'";
                                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                    $email_found = mysqli_num_rows($result);
                                    if($email_found != 0){
                                        header("Location: registration.php?exist&firstname=$firstname&lastname=$lastname&email=$email&username=$username");
                                    } else {
                                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                        $user_photo = $_FILES['photo']['name'];
                                        $user_photo_tmp = $_FILES['photo']['tmp_name'];
                                        move_uploaded_file($user_photo_tmp, "admin/img/$user_photo");
                                        $query = "INSERT INTO users(username, password, user_firstname, user_lastname, user_photo, email) 
                                                VALUES('$username', '$password', '$firstname', '$lastname',  '$user_photo', '$email')";
                                        mysqli_query($connection, $query) or die(mysqli_error($connection));
                                        $_SESSION['username'] = $username;
                                        $_SESSION['role'] = 'subscriber';
                                        header("Location: index.php");
                                    }
                                }
                            }
                        ?>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>
    <?php include "includes/footer.php";?>

    <?php
        if(isset($_))
    ?>
