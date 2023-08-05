<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TGS - Token Generating System | Welcome to the Dashboard</title>
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/design.css" type="text/css">
</head>

<body>
    <div class="container">
        <!-- header -->
        <div class="header pt-5 index-header text-center ">
            <header>
                <img src="pictures/download.jpg" alt="logo" width="100" height="100">
                <!-- <p style="text-align: center;font-size:xxx-large;">TGS -Token Generating System</p> -->
            </header>
        </div>

        <hr>



        <!-- operational button -->
        <div class="opbtn text-center progress-bar position-relative">

            <button class="btns btn btn-success border-5 p-3 mb-5" id="generate_tocken" data-bs-toggle="modal" data-bs-target="#tokenBackdrop" onclick="kisaanScript(this)">टोकन बनाएं</button>
            <button class="btns btn btn-success border-5 p-3 mb-5" data-bs-toggle="modal" data-bs-target="#adminBackdrop" onclick="adminScript()">एडमिन</button>
            <button class="btns btn btn-success border-5 p-3 mb-5" data-bs-toggle="modal" data-bs-target="#operatorBackdrop" onclick="opScript()">ऑपरेटर</button>
        </div>



        <!-- modal form to show when clicking on generate token -->
        <!-- Modal  kisaan form - generate token -->
        <div class="modal fade" id="tokenBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white p-5">
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
                                            <option value="select">अपनी तहसील चुने</option>
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
                                            <option value="select">अपना वितरण केंद्र चुने</option>
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
        <div class="alert" id="message-box"></div>

        <!-- Modal admin form -->
        <div class="modal fade" id="adminBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white p-5">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">एडमिन लॉगिन</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5">
                        <form class="form" id="admin-form">
                            <table>

                                <tr>
                                    <th>नाम</th>
                                    <td><input type="text" name="user-name" autocomplete="username"></td>
                                </tr>

                                <tr>
                                    <th>पासवर्ड</th>
                                    <td><input type="password" name="password" autocomplete="new-password"></td>
                                </tr>

                            </table>
                            <input type="submit" class="btn btn-success" value="submit">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal operator form -->
        <div class="modal fade" id="operatorBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white p-5">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">ऑपरेटर लॉगिन करें</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5">
                        <form class="form" id="operator-form">
                            <table>
                                <tr>
                                    <th>नाम</th>
                                    <td><input type="text" name="oname" autocomplete="username"></td>
                                </tr>
                                <tr>
                                    <th>पासवर्ड</th>
                                    <td><input type="password" name="password" autocomplete="new-password"></td>
                                </tr>

                            </table>
                            <input type="submit" class="btn btn-success" value="submit">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
        <script src="script/script.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    </div>

</body>

</html>