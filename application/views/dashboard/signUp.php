<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>SignUp | Page</title>
</head>

<body class="d-flex justify-content-center align-content-center flex-row  bg-dark text-light">

    <div class="col-md-7">
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
        <form action="<?= base_url() ?>welcome/signUp" method='POST' enctype="multipart/form-data" class="d-flex flex-column align-items-center mt-3">
            <h1 class="my-3">SignUp</h1>
            <div class="form-group col-md-7">
                <label for="username">Username</label>
                <input name="username" type="text" placeholder="Username..." class="form-control">
                <?= form_error('username') ?>
            </div>
            <div class="form-group col-md-7">
                <label for="email">Email address</label>
                <input name="email" type="email" placeholder="Email..." class="form-control">
                <?= form_error('email') ?>

            </div>
            <div class="form-group col-md-7">
                <label for="date">Date of birth</label>
                <input name="date" type="date" class="form-control">
                <?= form_error('date') ?>

            </div>
            <div class="form-group col-md-7">
                <label for="password">Password</label>
                <input name="password" type="password" placeholder="Password..." class="form-control">
                <?= form_error('password') ?>
            </div>
            <div class="form-group col-md-7">
                <label for="confirmpassword">Confirm Password</label>
                <input name="passconf" type="password" placeholder="Confirm password..." class="form-control">
                <?= form_error('passconf') ?>
            </div>
            <div class="form-group col-md-7">
                <label for="picture">Upload Profile_Pic</label>
                <input class="form-control" type="file" name="userfile" />
                <?= form_error('userfile') ?>
            </div>
            <div>
                <button type="submit" value="signUp" name="signUp" class="btn btn-outline-light">SignUp</button>
            </div>
            <a class="mt-2 text-decoration-none text-light text-bold" href="<?= base_url() . 'welcome/signIn' ?>">Already a User? Login
            </a>
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