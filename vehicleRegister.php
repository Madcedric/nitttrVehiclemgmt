<?php
require_once 'auth.php';
requireLogin();
// $wrgpaswd = $_SESSION['status'] ?? '';
// unset($_SESSION['wrgpaswd']); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .header-text p {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
        }

        .header-banner {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .banner {
            background-color: #000278;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            color: #333;
            display: block;
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            /* horizontal centring  */
            align-items: center;
        }

        a {
            text-decoration: none;
        }

        @media (max-width: 600px) {

            .banner,
            .banner img {
                min-height: 180px;
                /* shorter banner on small screens */
            }
        }


        /* Image */
        .banner img {
            width: auto;
            /* fills the full width                      */
            height: 150px;

            /* banner height – adjust or use 40vh        */
            display: block;
            /* kills the tiny inline-gap under <img>     */
            object-fit: cover;
            /* scales to fill, cropping if needed        */
            object-position: center;
            /* keeps the focal point centred          */
        }

        h3 {
            text-align: center;
            margin-right: 10px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;

        }

        .logo img {
            width: 110px;
            padding: 2px;
            margin-right: 5px;
            height: 110px;
            object-position: 0.01px 2px;
            object-fit: contain;
        }

        form {
            background: white;
            border-radius: 30px;
            padding: 0 20px;
            /* text-aign: center; */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            width: 400px;
            /* background-color:rgb(187, 233, 241); */

        }

        label {
            display: block;
            /* Each label on a new line */
            margin-bottom: 5px;
        }

        input[type=text],
        input[type=password],
        input[type=email],
        input[type=time] {
            width: 100%;
            /* Take up the full width of the container */
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            /* Include padding and border in element's total width and height */
        }

        .img-caontainer {
            padding: 5px;
            margin-left: 20%;
        }

        #logo {
            width: 50%;
            margin-left: 20%;
        }

        button[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #cancel-btn {
            background-color: rgb(255, 166, 0);
            color: white;
            padding: 10px 20px;
            border: none;
            /* position: block; */
            border-radius: 4px;
            cursor: pointer;
            margin-left: 2%;
            text-decoration: 0;
        }

        input[type=file] {
            background-color: rgb(4, 75, 155);
            color: white;
            padding: 10px 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #response-btn {
            background-color: rgb(4, 75, 155);
            color: white;
            padding: 10px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 2%;
        }

        #logout-btn {
            /* keep your visual styles */
            background-color: rgb(240, 0, 0);
            color: #fff;
            padding: 12px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            bottom: 15%;
            right: -2%;

        }


        #logout-btn:hover {
            color: white;
            background-color: rgb(1, 138, 13);
        }

        #cancel-btn:hover {
            color: white;
            background-color: rgb(218, 0, 0);
        }

        button[type=submit]:hover {
            background-color: #45a049;
        }

        .alink {
            margin-top: 12px;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-text h1 {
                font-size: 24px;
            }


        }

        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
    </style>

</head>

<body>
    <!-- Header Banner -->
    <header class="header-banner">
        <div class="header-content">
            <div class="logo-container">
                <div class="logo">
                    <img src="./images/nitttrlogo.png" alt="NITTTR Logo">
                </div>
                <div class="header-text">
                    <h1>National Institute of Technical Teachers Training and Research</h1>
                    <p>[MINISTRY OF EDUCATION, GOVT. OF INDIA] <br> Taramani, Chennai 600113 Tamilnadu</p>
                </div>
            </div>
        </div>
    </header>

    <div class="container pt-3 my-5" id="form">
        <form class="container-fluid pt-3 my-5" action="server.php" enctype="multipart/form-data" method="POST">
            <div class="img-caontainer">
                <img id="logo" src="./images/nitttrlogo.png" alt="nitttr img" class="rounded-circle"
                    style="width:128px;height:128px ">
            </div>
            <h3 style=" color:#0a3d62;">Vehicle Management</h3>
            <div class="container pt-3 my-5">
                <input type="hidden" name="action" value="vehicleRegister">
                <label for="name">Name:</label>

                <input class="form-control" type="text" id="name" name="name">


                <label for="designation">Designation:</label>

                <input class="form-control" type="text" id="designation" name="designation">

                <section>
                    <label for="time">Arrived At:</label>
                    <input class="form-control" type="time" id="arrtime" name="arrtime">



                    <label for="time">Departured At:</label>
                    <input class="form-control" type="time" id="depttime" name="depttime">
                </section>

                <label for="place">Place/Area:</label>

                <input class="form-control" type="text" id="place" name="place">

                <label for="purps">Purpose:</label>

                <input class="form-control" type="text" id="purps" name="purps">
                <br>
                <label for="file">Upload</label>

                <input type="file" id="file" name="file">

                <br><br>
                <br>
                <div class="btns"><button type="submit" id="std-submit" name="storeData"
                        value="store-data">Register</button>
                    <a id="response-btn" href="noaccess.php" style="color:white">View Responses</a></button>
                    <button class="cancel" type="reset" id="cancel-btn">Clear</button>
                    <a id="logout-btn" onclick="logout()" href="login_form.php" style="color:white">logout</a>
                </div>
                      </div>
          

        </form>
    </div>
    <script>
        function logout() {
            alert("Logged out Successfully✅", 'vehicleRegister.php');
        }
    </script>

</body>
<!-- Footer -->
<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> NITTTR. All rights reserved. | Unauthorized access is prohibited.</p>
</footer>

</html>
