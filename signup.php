<?php require_once 'auth.php';
requireStatus();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
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
            padding: 20px;
            text-align: center;
            font-size: 30px;
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
            margin-right: 3px;
            height: 110px;
            object-position: 0.01px 2px;
            object-fit: contain;
        }

        form {
            background: white;
            border-radius: 20px;
            padding: 20px 40px;
            /* text-align: center; */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 500px;
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
        input[type=email] {
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
            padding: 10px;
            margin-left: 30px;
        }

        #logo {
            width: 50%;
            margin-left: 20%;
        }

        button[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #cancel-btn {
            background-color: rgb(230, 23, 23);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 26.3%;
            text-decoration: 0;
        }

        #cancel-btn:hover {
            color: white;
            background-color: rgb(255, 213, 26);
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
            padding: 10px;
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
        <form action="server.php" method="POST">

            <div class="img-caontainer">
                <img id="logo" src="./images/nitttrlogo.png" alt="nitttr img" class="rounded-circle"
                    style="width:128px;height:128px ">
            </div>
            <input type="hidden" name="action" value="signup">
            <label for="user-name">Username</label>

            <input type="text" class="form-control" name="newUser-name" required placeholder="Enter Name">
      
            <label for="email">Email</label>

            <input type="email" class="form-control" name="newUseremail" required id="email" placeholder="Enter Email">
            <div class="paswd-container" style="position:relative; max-width:380px;">
                <label
                    for="user-paswd">Password</label>

                <input type="password" id="newUser-paswd" class="form-control" style="padding-right:2.5rem;" name="newUser-paswd" required placeholder="Enter password">

                <i id="togglePwd" class="fa-solid fa-eye" style="
                    position:absolute;
                    left:30px; top:20%;
                    margin-left:80%;
                    transform:translateY(+180%);
                    cursor:pointer; color:#666;">
                </i>
            </div>
   

            <label for="user-confrimpaswd">Confrim Password</label>

            <input type="password" class="form-control" name="newUser-confrimpaswd" required placeholder="Re-Enter password">
            <br>


            <button type="submit" id="std-submit">Create
                Account</button><button type="reset" id="cancel-btn">Cancel</button>
            <br><br>
            <label for="remb-chkbox"><span style="font-size: 15px;">Remember me</span>&nbsp;&nbsp;<input type="checkbox"
                    id="remb-chkbox"><a href="login_form.php"><span style="margin-left: 19.2%;">Already
                        Registered?</span></a></label>
            <!-- <a href="forgetpaswd.php">Forgot password</a> -->
         <!-- ② JS helpers -->
            <script>
                document.getElementById('togglePwd').addEventListener('click', function () {
                    const pwdField = document.getElementById('newUser-paswd');
                    const typeNow = pwdField.getAttribute('type') === 'password' ? 'text' : 'password';
                    pwdField.setAttribute('type', typeNow);

                    /* swap icon */
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            </script>
        </form>
    </div>

   
</body>
 <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> NITTTR. All rights reserved. | Unauthorized access is prohibited.</p>
    </footer>
</html>
