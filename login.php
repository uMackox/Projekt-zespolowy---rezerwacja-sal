<html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Page</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" action="login.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" id="login" name="login" class="form-control form-control-user" placeholder="Login">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" name="password" class="form-control form-control-user" placeholder="Password">
                                    </div>
                                    <button type="submit" name="loginpressed" value="loginpressed" class="btn btn-primary btn-user btn-block">
                                        Sign-in
                                    </button>
                                    <?php
                                    if(isset($_POST['loginpressed'])){
                                        session_start();
                                        if(! empty($_POST)){
                                            if(isset($_POST['login']) && isset($_POST['password'])){
                                                include 'dbconn.php';
                                                $userlogin = $_POST['login'];
                                                $userpassword = $_POST['password'];

                                                $sql = "SELECT * FROM Users WHERE Login like '".$userlogin."' ";
                                                $result = $dbconn->query($sql);
                                                if($result->num_rows>0){
                                                    if(password_verify($userpassword,$result->fetch_assoc()["Password"])){
                                                        $user = $result->fetch_object();
                                                        $_SESSION['user_id'] = $userlogin;
                                                        header("Location: ./homepage.php");
                                                        exit;
                                                    }
                                                    else{
                                                        echo "<p class='message-warning'>Invalid username or password</p>";
                                                    }
                                                }
                                                else{
                                                    #echo $dbconn->query($sql);
                                                    echo "<p class='message-warning'>Invalid username or password<p class='message-warning'>";
                                                }
                                            }

                                        }
                                    }

                                    ?>

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>

