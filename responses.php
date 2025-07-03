<?php include('server.php');
require_once('auth.php');     // <-- use requireLogin() / requireAdmin() as needed
// requireAdmin();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$res = mysqli_query($conn,
    "SELECT vRegid, name, designation, arrTime, deptTime,
            place, purpose, fileName, fileType
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
*,
*::before,
*::after { box-sizing: border-box; }

/* — LAYOUT --------------------------------------------------------*/
body{
    margin:0;
    font: 15px/1.5 "Segoe UI", Roboto, sans-serif;
    background:#f6f8fb;
    color:#333;
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
.badge{
    display:inline-block;
    min-width:72px;
    padding:.25rem .4rem;
    background:#edf1fa;
    border-radius:4px;
    text-align:center;
    font-variant-numeric:tabular-nums;
}

@media (max-width:600px){
    h2{ font-size:1.2rem; }
}

    table   { border-collapse:collapse; width:100%; font-family:Arial, sans-serif; }
    th, td  { border:1px solid #ccc; padding:.5rem; }
    .thumb  { max-width:90px; max-height:90px; object-fit:cover; }
  </style>
</head>
<body>
<h2>Vehicle Log Responses</h2>
<table>
<tr>
  <th>#</th><th>Name</th><th>Designation</th>
  <th>Arrived</th><th>Departed</th><th>Place</th>
  <th>Purpose</th><th>File</th>
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

  <td>
    <?php if ($row['fileName']): ?>
        <?php if (str_starts_with($row['fileType'], 'image/')): ?>
            <a href="show_file.php?vRegid=<?= $row['vRegid'] ?>" target="_blank">
              <img class="thumb"
                   src="show_file.php?vRegid=<?= $row['vRegid'] ?>"
                   alt="<?= htmlspecialchars($row['fileName']) ?>">
            </a>
        <?php else: ?>
            <a href="show_file.php?vRegid=<?= $row['vRegid'] ?>" target="_blank">
              <?= htmlspecialchars($row['fileName']) ?>
            </a>
        <?php endif; ?>
    <?php else: ?>
        —
    <?php endif; ?>
  </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>