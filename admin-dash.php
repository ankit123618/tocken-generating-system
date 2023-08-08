<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("db/connection.php");
echo (mysqli_error($connection));
session_start();
if ($_SESSION['username'] != "admin")
    header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/design.css">

</head>

<body>
    <header class="container-fluid bg-success text-white p-5">
        <?php require_once("component/logout.php"); ?>
        <p><?php echo $_SESSION['username']; ?></p>
    </header>
    <hr>

    <!-- DROP DOWN TO SHOW THE LIST OF REPORTS -->

    

    <!-- TO BE OPTIMISED -->
    <div class="progress-bar">
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="ad-all-data">सम्पूर्ण किसान</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="verified-data">प्रमाणित किसान</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="unverified-data">अप्रमाणित किसान</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="deleted-data">हटाये गये किसान</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="sms-data">सन्देश के लिए</button>
        <!-- <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="date-data">तारीख अनुसार</button> -->
    </div>

    <!-- alert box to show responses -->
    <div class="alert" id="message-box">

        <!-- SMS TABLE  -->
        <table class="table-responsive data-tables" id="sms-data-table">



            <?php
            $select = "select * from kisaan";
            $result = mysqli_query($connection, $select);
            $num = mysqli_num_rows($result);
            if ($num != 0) {

                echo "<tr class='bg-success text-white'>
                    <th>नाम</th>
                    <th>फोन</th>
                    <th>सन्देश</th>
                </tr>";
                for ($i = 0; $i < $num; $i++) {
                    $row = mysqli_fetch_array($result);

                    // TAKEN THE DATA VALUE IN VARIABLES

                    $name = $row['name'];
                    $phone = $row['phone'];
                    $message = $row['message'];

                    echo "<tr>
                    
                    <td><input type='text' value='$name' id = 'name' name='name'></td>
                    <td><input type='number' value='$phone' id = 'phone' name='phone'></td>
                    <td><input type='text' value='$message' id = 'message' name='message'></td>
                    
                </tr>";
                }
                echo "<td>
                <form action='db/download-data.php' method='get'>
                    <input type='text' name='table' value='sms' hidden>
                    <input type='submit' value='download as excel'>
                </form>
            </td>";
            } else
                echo "<tr><th>no data</th></tr>";
            ?>
        </table>

        <!-- verified data table -->
        <table class="table-responsive data-tables" id="verified-data-table">
            <tr>
                <th>टोकन</th>
                <th>नाम</th>
                <th>फोन</th>
                <th>तहसील</th>
                <th>ग्राम</th>
                <th>वितरण केंद्र का नाम</th>
                <th>बही अनुसार रकवा</th>
                <th>बही क्रमांक</th>
                <th>समग्र</th>
                <th>तारीख</th>

                <th>दिया गया समय </th>
                <th>दी गयी तारिख</th>



            </tr>
            <?php
            $select = "select * from kisaan where status = 'verified'";
            $result = mysqli_query($connection, $select);
            // var_dump($result);
            $num = mysqli_num_rows($result);
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_array($result);

                // TAKEN THE DATA VALUE IN VARIABLES
                $token = $row['token'];
                $name = $row['name'];
                $phone = $row['phone'];
                $tahseel = $row['tahseel'];
                $gram = $row['gram'];
                $vitrank = $row['vitrankendra'];
                $rakva = $row['rakva'];
                $bahi = $row['bahi'];
                $samagra = $row['samagra'];
                $date = $row['date'];

                $ta = $row['timealloted'];
                $da = $row['datealloted'];



            ?>


                <tr>
                    <td><input type="number" value="<?php echo $token; ?>" name="token"></td>
                    <td><input type="text" value="<?php echo $name; ?>" name="name"></td>
                    <td><input type="number" value="<?php echo $phone; ?>" name="phone"></td>
                    <td><input type="text" value="<?php echo $tahseel; ?>" name="tahseel"></td>
                    <td><input type="text" value="<?php echo $gram; ?>" name="gram"></td>
                    <td><input type="text" value="<?php echo $vitrank; ?>" name="vitrank"></td>
                    <td><input type="text" value="<?php echo $rakva; ?>" pattern="[0-9]+(\.[0-9]+)?" name="rakva"></td>
                    <td><input type="number" value="<?php echo $bahi; ?>" name="bahi"></td>
                    <td><input type="number" value="<?php echo $samagra; ?>" name="samagra"></td>
                    <td><input type="text" value="<?php echo $date; ?> " disabled name="date"></td>
                    <td><input type="text" value="<?php echo $da; ?> " name="da"></td>
                    <td><input type="text" value="<?php echo $ta; ?> " name="ta"></td>
                </tr>
                <tr>

                </tr>
            <?php


            }
            ?>
            <td>
                <form action="db/download-data.php" method="get">
                    <input type="text" name="table" value="verified" hidden>
                    <input type="submit" value="download as excel">
                </form>
            </td>
        </table>

        <!-- unverified data table -->
        <table class="table-responsive data-tables" id="unverified-data-table">
            <tr>
                <th>टोकन</th>
                <th>नाम</th>
                <th>फोन</th>
                <th>तहसील</th>
                <th>ग्राम</th>
                <th>वितरण केंद्र का नाम</th>
                <th>बही अनुसार रकवा</th>
                <th>बही क्रमांक</th>
                <th>समग्र</th>
                <th>तारीख</th>

                <th>दिया गया समय </th>
                <th>दी गयी तारिख</th>

                <th>कारण</th>


            </tr>
            <?php
            $select = "select * from kisaan where status = 'unverified'";
            $result = mysqli_query($connection, $select);
            // var_dump($result);
            $num = mysqli_num_rows($result);
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_array($result);

                // TAKEN THE DATA VALUE IN VARIABLES
                $token = $row['token'];
                $name = $row['name'];
                $phone = $row['phone'];
                $tahseel = $row['tahseel'];
                $gram = $row['gram'];
                $vitrank = $row['vitrankendra'];
                $rakva = $row['rakva'];
                $bahi = $row['bahi'];
                $samagra = $row['samagra'];
                $date = $row['date'];
                $ta = $row['timealloted'];
                $da = $row['datealloted'];

                $reason = $row['reason'];


            ?>



                <tr>
                    <td><input type="number" value="<?php echo $token; ?>" name="token"></td>
                    <td><input type="text" value="<?php echo $name; ?>" name="name"></td>
                    <td><input type="number" value="<?php echo $phone; ?>" name="phone"></td>
                    <td><input type="text" value="<?php echo $tahseel; ?>" name="tahseel"></td>
                    <td><input type="text" value="<?php echo $gram; ?>" name="gram"></td>
                    <td><input type="text" value="<?php echo $vitrank; ?>" name="vitrank"></td>
                    <td><input type="text" value="<?php echo $rakva; ?>" pattern="[0-9]+(\.[0-9]+)?" name="rakva"></td>
                    <td><input type="number" value="<?php echo $bahi; ?>" name="bahi"></td>
                    <td><input type="number" value="<?php echo $samagra; ?>" name="samagra"></td>
                    <td><input type="text" value="<?php echo $date; ?> " disabled name="date"></td>
                    <td><input type="text" value="<?php echo $da; ?> " name="da"></td>
                    <td><input type="text" value="<?php echo $ta; ?> " name="ta"></td>

                    <td><input type="text" value="<?php echo $reason; ?> " name="reason"></td>


                </tr>
            <?php


            }
            ?>
            <tr>
                <td>
                    <form action="db/download-data.php" method="get">
                        <input type="text" name="table" value="unverified" hidden>
                        <input type="submit" value="download as excel">
                    </form>
                </td>
            </tr>
        </table>


        <!-- deleted data -->
        <table class="table-responsive data-tables" id="deleted-data-table">
            <tr>
                <th>टोकन</th>
                <th>नाम</th>
                <th>फोन</th>
                <th>तहसील</th>
                <th>ग्राम</th>
                <th>वितरण केंद्र का नाम</th>
                <th>बही अनुसार रकवा</th>
                <th>बही क्रमांक</th>
                <th>समग्र</th>
                <th>तारीख</th>

                <th>दिया गया समय </th>
                <th>दी गयी तारिख</th>

                <th>कारण</th>
            </tr>

            <?php
            $select = "select * from kisaan where status = 'deleted'";
            $result = mysqli_query($connection, $select);
            // var_dump($result);
            $num = mysqli_num_rows($result);
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_array($result);

                // TAKEN THE DATA VALUE IN VARIABLES
                $token = $row['token'];
                $name = $row['name'];
                $phone = $row['phone'];
                $tahseel = $row['tahseel'];
                $gram = $row['gram'];
                $vitrank = $row['vitrankendra'];
                $rakva = $row['rakva'];
                $bahi = $row['bahi'];
                $samagra = $row['samagra'];
                $date = $row['date'];

                $ta = $row['timealloted'];
                $da = $row['datealloted'];
                $reason = $row['reason'];


            ?>



                <tr>
                    <td><input type="number" value="<?php echo $token; ?>" name="token"></td>
                    <td><input type="text" value="<?php echo $name; ?>" name="name"></td>
                    <td><input type="number" value="<?php echo $phone; ?>" name="phone"></td>
                    <td><input type="text" value="<?php echo $tahseel; ?>" name="tahseel"></td>
                    <td><input type="text" value="<?php echo $gram; ?>" name="gram"></td>
                    <td><input type="text" value="<?php echo $vitrank; ?>" name="vitrank"></td>
                    <td><input type="text" value="<?php echo $rakva; ?>" name="rakva"></td>
                    <td><input type="number" value="<?php echo $bahi; ?>" name="bahi"></td>
                    <td><input type="number" value="<?php echo $samagra; ?>" name="samagra"></td>
                    <td><input type="text" value="<?php echo $date; ?> " name="date"></td>
                    <td><input type="text" value="<?php echo $ta; ?> " name="time"></td>
                    <td><input type="text" value="<?php echo $da; ?> " name="date"></td>

                    <td><input type="text" value="<?php echo $reason; ?> " name="reason"></td>





                <tr>

                </tr>

                </tr>
            <?php


            }
            ?>
            <td>
                <form action="db/download-data.php" method="get">
                    <input type="text" name="table" value="deleted" hidden>
                    <input type="submit" value="download as excel">
                </form>
            </td>
        </table>

        <!-- Data table by default is hide -->


        <table class="table-responsive data-tables" id="ad-data-table">

            <tr class="bg-success text-white">
                <th>टोकन</th>
                <th>नाम</th>
                <th>फोन</th>
                <th>तहसील</th>
                <th>ग्राम</th>
                <th>वितरण केंद्र का नाम</th>
                <th>बही अनुसार रकवा</th>
                <th>बही क्रमांक</th>
                <th>समग्र</th>
                <th>तारीख</th>

                <th>दिया गया समय </th>
                <th>दी गयी तारिख</th>
                <th>स्थिति</th>

            </tr>


            <?php
            $select = "select * from kisaan";
            $result = mysqli_query($connection, $select);
            $num = mysqli_num_rows($result);
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_array($result);

                // TAKEN THE DATA VALUE IN VARIABLES
                $token = $row['token'];
                $name = $row['name'];
                $phone = $row['phone'];
                $tahseel = $row['tahseel'];
                $gram = $row['gram'];
                $vitrank = $row['vitrankendra'];
                $rakva = $row['rakva'];
                $bahi = $row['bahi'];
                $samagra = $row['samagra'];
                $date = $row['date'];
                $ta = $row['timealloted'];
                $da = $row['datealloted'];
                $status = $row['status'];

            ?>

                <tr>
                    <td><input type="number" value="<?php echo $token; ?>" name="token"></td>
                    <td><input type="text" value="<?php echo $name; ?>" name="name"></td>
                    <td><input type="number" value="<?php echo $phone; ?>" name="phone"></td>
                    <td><input type="text" value="<?php echo $tahseel; ?>" name="tahseel"></td>
                    <td><input type="text" value="<?php echo $gram; ?>" name="gram"></td>
                    <td><input type="text" value="<?php echo $vitrank; ?>" name="vitrank"></td>
                    <td><input type="text" value="<?php echo $rakva; ?>" pattern="[0-9]+(\.[0-9]+)?" name="rakva"></td>
                    <td><input type="number" value="<?php echo $bahi; ?>" name="bahi"></td>
                    <td><input type="number" value="<?php echo $samagra; ?>" name="samagra"></td>
                    <td><input type="text" value="<?php echo $date; ?> " disabled name="date"></td>
                    <td><input type="text" value="<?php echo $da; ?> " name="da"></td>
                    <td><input type="text" value="<?php echo $ta; ?> " name="ta"></td>


                    <td>
                        <input type="text" name="status" id="status" value="<?php echo $status; ?>">

                    </td>

                </tr>
            <?php } ?>
            <tr>

                <td>
                    <form action="db/download-data.php" method="get">
                        <input type="text" name="table" value="all" hidden>
                        <input type="submit" value="download as excel">
                    </form>

                </td>
            </tr>

        </table>

    </div>
    <!-- <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="script/script.js"></script>
</body>

</html>