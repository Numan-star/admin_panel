<div class="content-wrapper">
    <div class="container">
        <h1 class="container mb-5">User Detail</h1>
        <form>
            <div>
                <div class='form-group col-md-10'>
                    <label for='pname'>Name </label>
                    <input disabled type='text' name='editpname' value="<?= $user['pname'] ?>" class='form-control' placeholder='Enter your name...'>

                </div>
                <div class='form-group col-md-10'>
                    <label for='email'>Email </label>
                    <input disabled type='email' name='editemail' value="<?= $user['email'] ?>" class='form-control' placeholder='Enter your email...'>
                </div>
                <div class='form-group col-md-10'>
                    <label for='password'>Phone Number</label>
                    <input disabled type='text' name='editphoneNumber' value="<?= $user['phoneNumber'] ?>" maxlength='11' class='form-control' placeholder='Enter your phoneNumber...'>
                </div>
            </div>
            <a class="btn btn-warning" href="<?= base_url() ?>welcome/insert">
                Back
            </a>
        </form>
    </div>
</div>