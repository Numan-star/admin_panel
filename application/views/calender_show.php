<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
</head>
<style>
    table {
    margin-top: 20px;
    border: 1px solid black;
    border-collapse: collapse;
    width: 500px;
}

td {
    width: 50px;
    height: 60px;
    text-align: center;
    border: 1px solid gray;
    font-size: 20px;
    font-weight: bold;
}

td:hover {
    transition: ease-in all 0.2s;
    color: white;
    /* cursor: pointer; */
    background-color: skyblue;
}

th {
    height: 45px;
    padding-bottom: 7px;
    background: skyblue;
    font-size: 30px;
    text-align: center;
}
th:hover{
    transition: ease-in-out all 0.3s;
    background-color: lavender;
}

.prev_sign a,
.next_sign a {
    color: black;
    font-size: 30px;
    text-decoration: none;
}

tr.week_name {
    font-size: 20px;
    font-weight: 500;
    color: black;
    width: 10px;
    background-color: skyblue;
}

.highlight {
    background-color: skyblue;
    color: white;
    height: 58px;
    display: flex;
    justify-content: center;
    align-items:center;
}
@media only screen and (max-width: 500px) {
    table {
    margin-top: 15px;
    margin-bottom:10px;
    border: 1px solid black;
    border-collapse: collapse;
    width: 350px;
}
}

</style>
<body>
    
<div class="content-wrapper">
        <h2 class="text-center">Dynamic Calendar</h2>

        <section class="content">
            <div class="container-fluid d-flex justify-content-center">

                <div class="row">
                    <section class="connectedSortable mt-2">
                        <?php
                        // Generate calendar
                        echo $this->calendar->generate($year, $month);
                        ?>
                    </section>

                </div>
            </div>
        </section>

    </div>
</body>
</html>
   