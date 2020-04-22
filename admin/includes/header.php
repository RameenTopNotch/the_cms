<?php
    ob_start();
    session_start();
    include '../includes/db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css"
          integrity="sha256-2SjB4U+w1reKQrhbbJOiQFARkAXA5CGoyk559PJeG58=" crossorigin="anonymous" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--  This massive shit belongs to the chart  -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        <?php
            $query = "SELECT 1 FROM posts";
            $result = mysqli_query($connection, $query);
            $posts_no = mysqli_num_rows($result);

            $query = "SELECT 1 FROM posts WHERE post_status='published'";
            $result = mysqli_query($connection, $query);
            $published_posts_no = mysqli_num_rows($result);

            $query = "SELECT 1 FROM posts WHERE post_status='draft'";
            $result = mysqli_query($connection, $query);
            $draft_posts_no = mysqli_num_rows($result);

            $query = "SELECT 1 FROM comments";
            $result = mysqli_query($connection, $query);
            $comments_no = mysqli_num_rows($result);

            $query = "SELECT 1 FROM comments WHERE comment_status='approved'";
            $result = mysqli_query($connection, $query);
            $appd_comments_no = mysqli_num_rows($result);

            $query = "SELECT 1 FROM comments WHERE comment_status='unapproved'";
            $result = mysqli_query($connection, $query);
            $pending_comments_no = mysqli_num_rows($result);

            $query = "SELECT 1 FROM users WHERE role='subscriber'";
            $result = mysqli_query($connection, $query);
            $users_no = mysqli_num_rows($result);

            $query = "SELECT 1 FROM categories";
            $result = mysqli_query($connection, $query);
            $categories_no = mysqli_num_rows($result);
        ?>

        function drawStuff() {

            var data = new google.visualization.arrayToDataTable([
                ['', ''],
                ["posts", <?php echo $posts_no; ?>],
                ["published posts", <?php echo $published_posts_no; ?>],
                ["draft posts", <?php echo $draft_posts_no; ?>],
                ["users", <?php echo $users_no; ?>],
                ['comments', <?php echo $comments_no; ?>],
                ['comments(appd)', <?php echo $appd_comments_no; ?>],
                ['comments(pndg)', <?php echo $pending_comments_no; ?>],
                ['categories', <?php echo $categories_no; ?>]
            ]);

            var options = {
                width: 850,
                legend: { position: 'none' },
                chart: {
                    title: '',
                    subtitle: '' },
                axes: {
                    y: {
                        0: { side: 'top', label: ''} // Top x-axis.
                    }
                },
                bar: { groupWidth: "50%" }
            };

            var chart = new google.charts.Bar(document.getElementById('top_x_div'));
            // Convert the Classic options to Material options.
            chart.draw(data, google.charts.Bar.convertOptions(options));
        };
    </script>
    <!-- The end of it  -->

</head>

<body>