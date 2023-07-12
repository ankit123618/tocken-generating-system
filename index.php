<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TGS - Token Generating System | Welcome to the Dashboard</title>
    <link rel="stylesheet" href="css/design.css" type="text/css">
</head>

<body>
    <div class="container">
        <!-- header -->
        <div class="header">
            <header>
                <p style="text-align: center;">TGS -Tocken Generating System</p>
            </header>
        </div>

        <!-- Admin button -->
        <div class="adminbtn">
            <button class="btn">Admin1</button>
            <button class="btn">Admin2</button>
        </div>

        <form class="form">
            <h2>Enter Kisaan Details</h2>

            <input type="text" name="username" placeholder="Enter Your Name">
            <br><input type="password" name="password" placeholder="Password">
            <br> <input type="submit" class="btn" style="margin-top: 5px; position:relative; left:45px;" value="Submit">
        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            console.log("hello! jquery is start");

            

            const formdata = $(".form").serialize()
            console.log(formdata);
            $.ajax({
                url: "./db/data.php",
                method: "post",
                data: {
                    data: formdata
                },
                success: function(data) {
                    console.log(data);

                    console.log("success");
                }
            })
        })
    </script>
</body>

</html>