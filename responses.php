<?php include('server.php');
require_once('auth.php');     // <-- use requireLogin() / requireAdmin() as needed
// requireAdmin();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$res = mysqli_query($conn,
    "SELECT vRegid, name, designation, arrTime, deptTime,
            place, purpose, fileName, fileType, fileData
     FROM   vehicle_logs
     ORDER BY created_at DESC");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Vehicle Responses</title>
  <style>
<!-- Place this inside <head> … </head> -->
/* — RESET ---------------------------------------------------------*/
*
*::before,
*::after { box-sizing: border-box; }


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
            padding: 10px 0;
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

        #viewImg {
            background-color: rgb(4, 75, 155);
            color: white;
            padding: 5px 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            align-items: center;
            margin-left: 2%;
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
            padding: 40px 40px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            width: 400px;
            /* background-color:rgb(187, 233, 241); */

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

        #cancel-btn {
            background-color: rgb(230, 23, 23);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 48%;
            text-decoration: 0;
        }
        #submit-btn{
             background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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


        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
/* — LAYOUT --------------------------------------------------------*/
        body{
            margin:0;
            font: 15px/1.5 "Segoe UI", Roboto, sans-serif;
            background:#f6f8fb;
            color:#333;
        }

        form {
            background: white;
            border-radius: 20px;
            padding: 40px 80px;
            /* text-align: center; */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 1000px;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            width: 900px;;
            /* background-color:rgb(187, 233, 241); */

        }

    h2{
        margin: 1rem 0;
        text-align:center;
        color:#0a3d62;
    }

    .table-wrapper{
        max-width: 96%;
        margin:0 auto 2rem;
        overflow-x: auto;
        background:#fff;
        border-radius:10px;
        box-shadow:0 4px 14px rgba(0,0,0,.08);
}

    table{
        width:100%;
        border-collapse:collapse;
        min-width:800px;
}

/* — HEADER -------------------------------------------------------*/
    thead{
        background:#0a3d62;
        color:#fff;
}

    th,td{
        padding:.75rem 1rem;
        text-align:left;
}


    th{ font-weight:600; }

/* — ZEBRA + HOVER ------------------------------------------------*/
    tbody tr:nth-child(even){ background:#f3f6fa; }

    tbody tr:hover{
        background:#dde8fb;
        transition:.2s;
}

/* — THUMBNAILS / LINKS ------------------------------------------*/
    .thumb{
        width:80px; height:80px;
        object-fit:cover;
        border-radius:6px;
        box-shadow:0 0 0 1px rgba(0,0,0,.1), 0 2px 6px rgba(0,0,0,.12);
        transition:.2s;
}
    .thumb:hover{ transform:scale(1.05); }

/* non‑image link style */
    .file-link{
        display:inline-block;
        padding:.25rem .5rem;
        border-radius:5px;
        background:#e1ecf4;
        color:#084b8a;
        text-decoration:none;
        font-size:.9rem;
}   
    .file-link:hover{ background:#d4e4f2; }

/* — CHIPS FOR TIMES --------------------------------------------*/


    @media (max-width:600px){
        h2{ font-size:1.2rem; }
}

        table   { border-collapse:collapse; width:100%; font-family:Arial, sans-serif; }
        th, td  { border:1px solid #ccc; padding:.5rem; }
        .thumb  { max-width:90px; max-height:90px; object-fit:cover; }
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

    <form action="">
        <h2>Vehicle Log Responses</h2>
        <table>
            <tr>
                <th>#sno</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Arrived</th>
                <th>Departed</th>
                <th>Place</th>
                <th>Purpose</th>
                <th>File</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $row['vRegid'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['designation']) ?></td>
                    <td><?= htmlspecialchars($row['arrTime']) ?></td>
                    <td><?= htmlspecialchars($row['deptTime']) ?></td>
                    <td><?= htmlspecialchars($row['place']) ?></td>
                    <td><?= htmlspecialchars($row['purpose']) ?></td>
                    <div class="file">
                        <td>
                            <?php if ($row['fileName']): ?>
                                <?php
                                    $id = $row['fileData'];
                                    $img = "show_file.php?vRegid=$id";
                                    $originPath = $row["fileData"];
                                    $imgfile = substr($originPath, 33, );
                                ?>
                                <?php if (str_starts_with($row['fileType'], 'image/')): ?>
                                    <img class="thumb" src="<?= $imgfile ?>" alt="<?= htmlspecialchars($row['fileName']) ?>">
                                    </a>
                                    <h4><?= htmlspecialchars($row['fileName']) ?></h5>

                                        <a id="viewImg" href='<?= $imgfile ?>'>View Image</a>
                                        <button id='submit-btn'>aprove</button>
                                        <button id="cancel-btn">Reject</button>
                                    <?php else: ?>
                                        <a href="<?= $img ?>" target="_blank">
                                            <?= htmlspecialchars($row['fileName']) ?>
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>—<?php endif; ?>
                        </td>
                    </div>
                </tr>
            <?php endwhile; ?>
        </table>
    </form>
</body>

<!-- Footer -->
<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> NITTTR. All rights reserved. | Unauthorized access is prohibited.</p>
</footer>

</html>
