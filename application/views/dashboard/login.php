<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">


    <title>Login to Dashboard</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/login.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="d-flex justify-content-center align-content-center flex-row text-center">
    <div class="col-md-3 mt-5">

        <div class="col-md-12 mt-3">
            <?php
            $success = $this->session->userdata('success');
            if ($success != "") {
            ?>
                <div class="alert alert-success" id="my_alert"><?= $success ?></div>
            <?php
            }
            $failure = $this->session->userdata('failure');
            if ($failure != "") {
            ?>
                <div class="alert alert-danger" id="my_alert"><?= $failure ?></div>
            <?php
            }
            ?>
        </div>

        <form action="<?= base_url() ?>welcome/signIn" method='POST'>
            <img class="mb-4" src="<?php echo base_url(); ?>assest/img/ci.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>

            <div class="bg-dark rounded-lg  col-md-12 p-4 text-light">

                <label for="username" class="sr-only text-light">Username</label>
                <input type="text" name="username" class="form-control my-4" placeholder="Username">
                <?= form_error('username') ?>
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" class="form-control my-4" placeholder="Password">
                <?= form_error('password') ?>
                <button class="btn btn-lg btn-outline-light btn-block mb-5" type="submit" value="signIn" name="signIn">Sign in</button>
                <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017-2022</p> -->
                <div>
                    <a class=" text-decoration-none text-light" href="<?= base_url() . 'welcome/signUp' ?>">Don't have account? SignUp
                    </a>
                </div>

            </div>

        </form>

    </div>
    <script>
        let alert = document.getElementsByClassName('alert');
        if (alert == null) {
            console.log(" ");
        } else {
            setTimeout(() => {
                document.getElementById("my_alert").style.display = "none";
            }, 4000)
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>