<?php
require_once("db/connection.php");
session_start();
if ($_SESSION['username'] != "op1")
    header("location:index.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Dashboard</title>
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/design.css">
</head>

<body>
    <!-- header for operator -->
    <header class="container-fluid bg-success text-white p-5">
        <?php require_once("component/logout.php"); ?>
        <p><?php echo $_SESSION['username']; ?></p>
    </header>
    <hr>

    <!-- operational button -->
    <div class="opbtn progress-bar">
        <button class="btns btn btn-success border-5 p-3 mb-5" data-bs-toggle="modal" data-bs-target="#tokenBackdrop" onclick="kisaanScript(this)" id="fromop">नया टोकन</button>
        <button class="btns btn btn-success border-5 p-3 mb-5" id="token-request" onclick="showData(this)" id="all-data">टोकन की याचिकाएं</button>
    </div>
    <!-- Modal  new token form - generate token -->
    <div class="modal fade" id="tokenBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white p-5 bg-gradient">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">कृषक का फॉर्म भरें</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <form class="form" id="kisaan-form">
                        <table>
                            <tr>
                                <th>कृषक का नाम</th>
                                <td><input type="text" name="name"></td>
                            </tr>
                            <tr>
                                <th>फ़ोन</th>
                                <td><input type="number" name="phone"></td>
                            </tr>
                            <tr>
                                <th>समग्र id</th>
                                <td><input type="number" name="sid"></td>
                            </tr>
                            <tr>
                                <th>बही क्रमांक</th>
                                <td><input type="number" name="bahi"></td>
                            </tr>
                            <tr>
                                <th>बही अनुसार रकवा</th>
                                <td><input type="text" name="rakva" pattern="[0-9]+(\.[0-9]+)?"></td>
                            </tr>
                            <tr>
                                <th>तहसील ग्राम</th>
                                <td>
                                    <select name="tahseel">
                                        <option value="select">तहसील चुने</option>
                                        <option value="narsinghpur">नरसिंगपुर</option>
                                        <option value="gaadarwada">गाडरवाड़ा</option>
                                        <option value="gotegaon">गोटेगांव</option>
                                        <option value="tendukheda">तेंदूखेड़ा</option>
                                        <option value="karelisaainkheda">करेली साईंखेड़ा</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>वितरण केंद्र का नाम</th>
                                <td>
                                    <select name="vitrank">
                                        <option value="select">वितरण केंद्र चुने</option>
                                        <option value="narsinghpur">नरसिंगपुर</option>
                                        <option value="kareli">करेली</option>
                                        <option value="gotegaon">गोटेगांव</option>
                                        <option value="gaadarwada">गाडरवाड़ा</option>
                                        <option value="karakbel">करकबेल</option>
                                        <option value="saalichoka">सालीचौका</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" class="btn btn-success" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- alert box to show kisaan message, token generated or not -->
    <div class="alert" id="message-box">

        <!-- Data table by default is hide -->
        <table class="table-responsive data-tables" id="data-table">
            <tr class="bg-success text-white">
                <th></th>
                <th>नाम</th>
                <th>फोन</th>
                <th>तहसील ग्राम</th>
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
            $select = "select * from kisaan where status = 'pending'";
            $result = mysqli_query($connection, $select);
            $num = mysqli_num_rows($result);
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_array($result);

                // TAKEN THE DATA VALUE IN VARIABLES
                $token = $row['token'];
                $name = $row['name'];
                $phone = $row['phone'];
                $tahseel = $row['tahseel'];
                $vitrank = $row['vitrankendra'];
                $rakva = $row['rakva'];
                $bahi = $row['bahi'];
                $samagra = $row['samagra'];
                $date = $row['date'];
                $status = $row['status'];
                $ta = $row['timealloted'];
                $da = $row['datealloted'];
            ?>

                <tr>
                    <td><input type="number" value="<?php echo $token; ?>" hidden name="token"></td>
                    <td><input type="text" value="<?php echo $name; ?>" name="name"></td>
                    <td><input type="number" value="<?php echo $phone; ?>" name="phone"></td>
                    <td><input type="text" value="<?php echo $tahseel; ?>" name="tahseel"></td>
                    <td><input type="text" value="<?php echo $vitrank; ?>" name="vitrank"></td>
                    <td><input type="text" value="<?php echo $rakva; ?>" pattern="[0-9]+(\.[0-9]+)?" name="rakva"></td>
                    <td><input type="number" value="<?php echo $bahi; ?>" name="bahi"></td>
                    <td><input type="number" value="<?php echo $samagra; ?>" name="samagra"></td>
                    <td><input type="text" value="<?php echo $date; ?> " disabled name="date"></td>
                    <td><input type="text" value="<?php echo $da; ?> " name="da"></td>
                    <td><input type="text" value="<?php echo $ta; ?> " name="ta"></td>
                    <td>
                        <select name="status">
                            <option value="<?php echo $status; ?>">लंबित</option>
                            <option value="verified">प्रमाणित</option>
                            <option value="unverified">अप्रमाणित</option>
                            <option value="deleted">हटाएं</option>
                        </select>

                    <td>
                        <button class="btn btn-success" onclick="status(this)" id="update" data-id='<?php echo $token; ?>' data-name='<?php echo $name ?>' data-phone="<?php echo $phone ?>" data-tahseel="<?php echo $tahseel ?>" data-vitrank="<?php echo $vitrankendra ?>" data-rakva="<?php echo $rakva ?>" data-bahi="<?php echo $bahi ?>" data-samagra="<?php echo $samagra ?>" data-date="<?php echo $date ?>" data-status="<?php echo $status; ?>" data-da="<?php echo $da; ?>" data-ta="<?php echo $ta; ?>">
                            सत्यापित करें
                        </button>
                    </td>
                    
                </tr>
            <?php } ?>

        </table>

    </div>




    <!-- <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script> -->
    <script src="script/script.js"></script>
</body>

</html>