<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TGS - Token Generating System | Welcome to the Dashboard</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/design.css" type="text/css">
</head>

<body>
    <div class="container">
        <!-- header -->
        <div class="header">
            <header>
                <p style="text-align: center;font-size:xxx-large;">TGS -Token Generating System</p>
            </header>
        </div>

        <!-- operational button -->
        <div class="opbtn">
            <button class="btns" id="generate_tocken" data-bs-toggle="modal" data-bs-target="#tokenBackdrop">टोकन बनाएं</button>
            <button class="btns" data-bs-toggle="modal" data-bs-target="#adminBackdrop">एडमिन</button>
            <button class="btns" data-bs-toggle="modal" data-bs-target="#operatorBackdrop">ऑपरेटर</button>
        </div>

        <!-- modal form to show when clicking on generate token -->
        <!-- Button trigger modal -->

        <!-- Modal  kisaan form - generate token -->
        <div class="modal fade" id="tokenBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">कृषक अपना फॉर्म भरें</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                    <th>दिनांक</th>
                                    <td><input type="date" name="date"></td>
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
                                    <td><input type="number" name="rakva"></td>
                                </tr>
                                <tr>
                                    <th>तहसील ग्राम</th>
                                    <td><input type="text" name="tahseel"></td>
                                </tr>
                                <tr>
                                    <th>वितरण केंद्र का नाम</th>
                                    <td><input type="text" name="vitrank"></td>
                                </tr>
                            </table>
                            <input type="submit" class="btn btn-success" value="submit">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal  kisaan form - admin form -->
        <div class="modal fade" id="adminBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">कृषक अपना फॉर्म भरें</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="admin-form">
                            <table>
                                <tr>
                                    <th>Password</th>
                                    <td><input type="password" name="password"></td>
                                </tr>
                                
                            </table>
                            <input type="submit" class="btn btn-success" value="submit">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal  kisaan form - operator form -->
        <div class="modal fade" id="operatorBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">कृषक अपना फॉर्म भरें</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="operator-form">
                            <table>
                            <tr>
                                    <th>Operator Name</th>
                                    <td><input type="text" name="Oname"></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td><input type="password" name="password"></td>
                                </tr>
                                
                            </table>
                            <input type="submit" class="btn btn-success" value="submit">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
        <!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> -->
        <script src="../jquery/jquery.min.js"></script>
        <script>
            $(document).ready(() => {
                console.log("hello! jquery is start");

                // form submission code - kisaan
                $("#kisaan-form").submit(e => {
                    e.preventDefault()
                    let formdata = $("#kisaan-form").serialize()
                    console.log(formdata);
                    $.ajax({
                        url: "./db/data.php",
                        method: "post",
                        data: {
                            data: formdata,
                            form: "kisaan-form",
                            operation: "insert"
                        },
                        success: data => {
                            console.log(data);
                        }

                    })
                })

            })
        </script>
</body>

</html>