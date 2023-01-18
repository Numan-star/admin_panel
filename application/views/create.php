<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Codeigniter | Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand  text-light">Navbar</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>Create User</h1>
        <form method="POST" action="<?= base_url() . 'Crud/create' ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="<?= set_value('name') ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?= form_error('name') ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control" id="exampleInputPassword1">
                <?= form_error('email') ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">PhoneNumber</label>
                <input type="text" name="phoneNumber" value="<?= set_value('phoneNumber') ?>" class="form-control" id="exampleInputPassword1">
                <?= form_error('phoneNumber') ?>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="<?= base_url() . 'Crud/index' ?>" class="btn btn-dark">Cancel</a>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>