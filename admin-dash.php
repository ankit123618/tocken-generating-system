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
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="all-data">सम्पूर्ण किसान</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="verified-data">प्रमाणित किसान</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="unverified-data">अप्रमाणित किसान</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="deleted-data">हटाये गये किसान</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="vitrankendra-data">वितरण केंद्र अनुसार</button>
        <button class="btns btn btn-success border-5 p-3 mb-5 text-white" onclick="showData(this)" id="date-data">तारीख अनुसार</button>
    </div>

    <!-- alert box to show responses -->
    <div class="alert" id="message-box">
        <!-- verified data table -->
        <table class="table-responsive data-tables" id="verified-data-table">
            <th class="bg-success text-white p-3 mb-2">प्रमाणित किसान</th>


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
                <tr>
                    <td>
                        <form action="db/download-data.php" method="get">
                            <input type="text" name="table" value="verified" hidden>
                            <input type="submit" value="download as excel">
                        </form>
                        <button onclick="downloadSheet(this)" id="download-verified" class="bg-gradient bg-warning p-3" data-id='<?php echo $token; ?>' data-name='<?php echo $name ?>' data-phone="<?php echo $phone ?>" data-tahseel="<?php echo $tahseel ?>" data-vitrank="<?php echo $vitrankendra ?>" data-rakva="<?php echo $rakva ?>" data-bahi="<?php echo $bahi ?>" data-samagra="<?php echo $samagra ?>" data-date="<?php echo $date ?>" data-status="<?php echo $status; ?>" data-da="<?php echo $da; ?>" data-ta="<?php echo $ta; ?>">जानकारी डाउनलोड करें</button>
                    </td>

                </tr>
            <?php


            }
            ?>
        </table>

        <!-- unverified data table -->
        <table class="table-responsive data-tables" id="unverified-data-table">
            <th class="bg-success text-white p-3 mb-2">अप्रमाणित किसान</th>

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


                <tr>
                    <td>
                        <form action="db/download-data.php" method="get">
                            <input type="text" name="table" value="unverified" hidden>
                            <input type="submit" value="download as excel">
                        </form>
                        <button onclick="downloadSheet(this)" id="download-unverified" class="bg-gradient bg-warning p-3" data-id='<?php echo $token; ?>' data-name='<?php echo $name ?>' data-phone="<?php echo $phone ?>" data-tahseel="<?php echo $tahseel ?>" data-vitrank="<?php echo $vitrankendra ?>" data-rakva="<?php echo $rakva ?>" data-bahi="<?php echo $bahi ?>" data-samagra="<?php echo $samagra ?>" data-date="<?php echo $date ?>" data-status="<?php echo $status; ?>" data-da="<?php echo $da; ?>" data-ta="<?php echo $ta; ?>">जानकारी डाउनलोड करें</button>
                    </td>

                </tr>

                </tr>
            <?php


            }
            ?>
        </table>


        <!-- deleted data -->
        <table class="table-responsive data-tables" id="deleted-data-table">
            <th class="bg-success text-white p-3 mb-2">Deleted kisaan</th>

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

                <tr>
                    <td><input type="number" value="<?php echo $row['token']; ?>" hidden name="token"></td>
                    <td><input type="text" value="<?php echo $row['name']; ?>" name="name"></td>
                    <td><input type="number" value="<?php echo $row['phone']; ?>" name="phone"></td>
                    <td><input type="text" value="<?php echo $row['tahseel']; ?>" name="tahseel"></td>
                    <td><input type="text" value="<?php echo $row['vitrankendra']; ?>" name="vitrank"></td>
                    <td><input type="text" value="<?php echo $row['rakva']; ?>" name="rakva"></td>
                    <td><input type="number" value="<?php echo $row['bahi']; ?>" name="bahi"></td>
                    <td><input type="number" value="<?php echo $row['samagra']; ?>" name="samagra"></td>
                    <td><input type="text" value="<?php echo $row['date']; ?> " name="date"></td>
                    <td><input type="text" value="<?php echo $row['timealloted']; ?> " name="time"></td>
                    <td><input type="text" value="<?php echo $row['datealloted']; ?> " name="date"></td>
                    <td><input type="text" value="<?php echo $row['status']; ?> " name="status"></td>


                    <td>
                        <button class="btn btn-success" onclick="status(this)" id="update" data-id='<?php echo $token; ?>' data-name='<?php echo $name ?>' data-phone="<?php echo $phone ?>" data-tahseel="<?php echo $tahseel ?>" data-vitrank="<?php echo $vitrankendra ?>" data-rakva="<?php echo $rakva ?>" data-bahi="<?php echo $bahi ?>" data-samagra="<?php echo $samagra ?>" data-date="<?php echo $date ?>" data-status="<?php echo $status; ?>" data-da="<?php echo $da; ?>" data-ta="<?php echo $ta; ?>">
                            सत्यापित करें
                        </button>
                    </td>


                <tr>
                    <td>
                        <form action="db/download-data.php" method="get">
                            <input type="text" name="table" value="deleted" hidden>
                            <input type="submit" value="download as excel">
                        </form>
                        <button onclick="downloadSheet(this)" id="download-deleted" class="bg-gradient bg-warning p-3" data-id='<?php echo $token; ?>' data-name='<?php echo $name ?>' data-phone="<?php echo $phone ?>" data-tahseel="<?php echo $tahseel ?>" data-vitrank="<?php echo $vitrankendra ?>" data-rakva="<?php echo $rakva ?>" data-bahi="<?php echo $bahi ?>" data-samagra="<?php echo $samagra ?>" data-date="<?php echo $date ?>" data-status="<?php echo $status; ?>" data-da="<?php echo $da; ?>" data-ta="<?php echo $ta; ?>">जानकारी डाउनलोड करें</button>
                    </td>

                </tr>

                </tr>
            <?php


            }
            ?>
        </table>

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
                    </td>
                    <td>
                        <button class="btn btn-success" onclick="status(this)" id="update" data-id='<?php echo $token; ?>' data-name='<?php echo $name ?>' data-phone="<?php echo $phone ?>" data-tahseel="<?php echo $tahseel ?>" data-vitrank="<?php echo $vitrank ?>" data-rakva="<?php echo $rakva ?>" data-bahi="<?php echo $bahi ?>" data-samagra="<?php echo $samagra ?>" data-date="<?php echo $date ?>" data-status="<?php echo $status; ?>" data-da="<?php echo $da; ?>" data-ta="<?php echo $ta; ?>">
                            सत्यापित करें
                        </button>
                    </td>
                </tr>
            <?php } ?>
            <tr>

                <td>
                    <form action="db/download-data.php" method="get">
                        <input type="text" name="table" value="all" hidden>
                        <input type="submit" value="download as excel">
                    </form>

                    <button onclick="downloadSheet(this)" id="download-all" class="btn btn-warning bg-gradient p-3" data-id='<?php echo $token; ?>' data-name='<?php echo $name ?>' data-phone="<?php echo $phone ?>" data-tahseel="<?php echo $tahseel ?>" data-vitrank="<?php echo $vitrankendra ?>" data-rakva="<?php echo $rakva ?>" data-bahi="<?php echo $bahi ?>" data-samagra="<?php echo $samagra ?>" data-date="<?php echo $date ?>" data-status="<?php echo $status; ?>" data-da="<?php echo $da; ?>" data-ta="<?php echo $ta; ?>">जानकारी डाउनलोड करें</button>
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