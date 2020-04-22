<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="padding-left: 5rem; padding-right: 5rem;">Home</a>
            <?php
                if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                    echo '<a href="admin/" class="navbar-brand" 
                        style="background-color: orange; padding-left: 5rem; 
                        padding-right: 5rem;">Admin</a>';
                } elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'subscriber'){
                    echo '<a href="profile.php" class="navbar-brand" 
                        style="background-color: yellow; padding-left: 5rem; 
                        padding-right: 5rem;">My Profile</a>';
                }
            ?>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href='#' style="font-size: 1.75rem;">About</a></li>
                <li><a href='#' style="font-size: 1.75rem;">Resume</a></li>
                <li><a href='#' style="font-size: 1.75rem;">Education</a></li>
                <li><a href='#' style="font-size: 1.75rem;">Future</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>