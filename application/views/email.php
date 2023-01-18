<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <div class="row d-flex justify-content-center">

                <section class="col-lg-6 connectedSortable">

                    <div class="col-md-12">
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
                    <h1>Send Email</h1>
                    <p><span class="error">* required field</span></p>
                    <form enctype="multipart/form-data" class="text-danger" method="POST" action="<?= base_url() . 'welcome/email' ?>">
                        <div class="mb-2">
                            <label for="to" class="form-label text-dark">To *</label>
                            <input type="email" placeholder="Recipients" name="to" value="<?= set_value('to') ?>" class="form-control">
                            <?= form_error('to') ?>
                        </div>
                        <div class="mb-2">
                            <label for="subject" class="form-label text-dark">Subject *</label>
                            <input type="text" placeholder="Subject" name="subject" value="<?= set_value('subject') ?>" class="form-control">
                            <?= form_error('subject') ?>
                        </div>
                        <div class="mb-1">
                            <div>
                                <label for="message" class="form-label text-dark">Message *</label>
                            </div>
                            <textarea class="col-sm-6 col-md-12" placeholder="Message..." name="message" value="<?= set_value('message') ?>" cols="70" rows="10"></textarea>
                            <?= form_error('message') ?>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="email" value="email" class="btn btn-info">Send</button>
                            <a href="<?= base_url() . 'welcome' ?>" class="btn btn-dark">Cancel</a>
                        </div>

                    </form>




                </section>


            </div>
        </div>
    </section>

</div>