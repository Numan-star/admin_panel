<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <div class="row d-flex justify-content-center">

                <section class="col-lg-7 connectedSortable">
                    <h1>
                        Currency Converter
                    </h1>
                    <form action=<?= base_url() . 'Welcome/convert' ?> method="POST">

                        <table>
                            <tr>
                                <td>
                                    <label for="amount" class="form-label text-dark">Amount :</label>
                                    <input type="text" name="amount" placeholder="amount..."><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <label for="amount" class="form-label text-dark">From :</label>
                                    <select name='cur1'>
                                        <option value="AUD">Australian Dollor(AUD)</option>
                                        <option value="USD" selected>US Dollar(USD)</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <label for="amount" class="form-label text-dark">To :</label>
                                    <select name='cur2'>
                                        <option value="INR" selected>Indian Rupee(INR)</option>
                                        <option value="PAK">Pakistan Rupee(PKR)</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <input class="btn btn-sm btn-info" type='submit' name='convert' value="convert">
                                </td>
                            </tr>
                        </table>

                    </form>
                    <p class="my-2">Your converted amount is :</p>
                    <h2 class="text-center">
                        <?php
                        echo $amount
                        ?>
                    </h2>

                </section>


            </div>
        </div>
    </section>

</div>