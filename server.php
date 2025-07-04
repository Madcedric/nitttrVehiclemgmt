<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

//!initialize the var need for
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "vehiclemgtdb";

//! Creating the connection to db
$conn = mysqli_connect($hostname, $username, $password, $dbname);

//!Check connected or not
if (!$conn) {

    die("Sever Not Connected" . mysqli_connect_error());
} else {
    // echo "db connected";
}

$action = $_POST['action'] ?? '';
$respBtn = $_POST['responsebtn'] ?? '';
$name = $_POST['name'] ?? '';
$design = $_POST['designation'] ?? '';
$arrTime = $_POST['arrtime'] ?? '';
$deptTime = $_POST['depttime'] ?? '';
$place = $_POST['place'] ?? '';
$regBtn = $_POST['storeData'] ?? '';
$purpose = $_POST['purps'] ?? '';
$uploadedFile = $_POST['file'] ?? '';
$uname_or_email = trim($_POST['user_name_or_paswd'] ?? '');
$loginpaswd = trim($_POST['user-paswd'] ?? '');

//! check if the var are comming
// echo var_dump($uname_or_email);
// echo var_dump($loginpaswd);


//? Signup form
$uname = trim($_POST['newUser-name'] ?? '');
$uemail = trim($_POST['newUseremail'] ?? '');
$upaswd = $_POST['newUser-paswd'] ?? '';
$uconfrimpaswd = $_POST['newUser-confrimpaswd'] ?? '';
// echo var_dump($uname);
// echo var_dump($uemail);
// echo var_dump($upaswd);

//! Session Confrimation!

switch ($action) {
    case 'login':
        handlelogin();
        break;
    case 'signup':
        handleSignup();
        break;
    case 'vehicleRegister':
        handleVehicleregister();
        break;
    case 'reponses':
        handleResponses();
        break;

}

function handleSignup()
{
    global $conn, $uname, $upaswd, $uemail, $uconfrimpaswd;

    $sqlQuery = 'SELECT userName, userEmail FROM usersTbl WHERE userEmail = ? OR userName = ?';
    $stmt = mysqli_prepare($conn, $sqlQuery);
    $stmt->bind_param('ss', $uemail, $uname);
    $stmt->execute();
    mysqli_stmt_bind_result($stmt, $foundsignupName, $foundsignupEmail);

    // if (mysqli_stmt_fetch($stmt)) {
    //     echo $foundsignupName . ' ' . $foundsignupEmail;
    // } else {
    //     alertFunc("No user found with that email ❌", 'signup.php');
    // }

    $stmt->close();

    // echo var_dump($foundsignupName) . $uname . $foundsignupEmail;



    if (empty($upaswd) || empty($uname) || empty($uemail) || empty($uconfrimpaswd)) {
        alertFunc("Invalid Input Check All The Values ❌", 'signup.php');
    } elseif (paswd_verify($upaswd, $uconfrimpaswd, 'signup')) {
        if ($foundsignupName === $uname || $uemail === $foundsignupEmail) {
            alertFunc('Username or Email Already Exist ❌', 'signup.php');
        } else {
            //! table changed from signup to usersTbl !!!
            $sqlQuery = "INSERT  INTO  usersTbl(userName, userEmail, userPaswd, reuserPaswd) VALUES(?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sqlQuery);
            if (!$stmt) {
                die("Sorry Preparation Failed" . mysqli_error($conn));
            } else {
                $stmt->bind_param('ssss', $uname, $uemail, $upaswd, $uconfrimpaswd);
                $stmt->execute();
                $stmt->close();

                //! need to make a alert latter !

                alertFunc('Account Created Successfully✅', 'login_form.php');

                // exit;
            }
        }
    } else {
        alertFunc('Password Doesnn\'t Match ❌', 'signup.php');


    }
}
function paswd_verify($paswd1, $paswd2, $session)
{

    // global $conn, $uname, $upaswd;
    if ($session == 'signup') {
        if ($paswd1 === $paswd2) {
            return True;
        } else {
            return False;
        }
    } elseif ($session == 'login') {
        if ($paswd2 === $paswd1) {
            return True;
        } else {
            return False;
        }
    }
}

function handleResponses()
{

    global $conn, $name, $design, $arrTime, $deptTime, $place, $purpose, $uploadedFile;


    $sqlQuery = "SELECT * FROM vehicle_logs(name, designation, arrTime, deptTime, place, purpose, fileName, fileType, fileData) VALUES(?, ?, ?, ?, ?, ? ,?, ?, ?)";
    $res = mysqli_prepare($conn, $sqlQuery);


}




function handleVehicleregister()
{

    global $conn, $regBtn, $name, $design, $arrTime, $deptTime, $place, $purpose, $uploadedFile;
    //     echo '<pre>';
// var_dump($_POST);   // everything from the form
// var_dump($);  // the file‑upload info
// echo '</pre>';
// exit;
    //var_dump($name.''.$regBtn.''.$design.''.$arrTime.''.$deptTime.''.$place.''.$purpose.''.$uploadedFile) ;
    if (isset($regBtn)) {

        if (empty($name) || empty($design) || empty($arrTime) || empty($deptTime) || empty($place) || empty($purpose) || empty($_FILES)) {
            alertFunc("Invalid Input Check All The Values ❌", 'vehicleRegister.php');
        }

        // if ($name === '' || !isset($_FILES['image'])) {
        //     die('Missing required fields or file.');
        // }

        /* STEP 2 ─ collect basic info ------------------------------ */
        $tmpPath = $_FILES['file']['tmp_name'];       // temp file on disk
        $origFilename = basename($_FILES['file']['name']);      // original name
        $mime = mime_content_type($tmpPath);          // server‑side MIM


        /* STEP 3 ─ pick a final storage path ----------------------- */
        $uploadDir = __DIR__ . '/uploadDirnitttr/';            // e.g.  C:/xampp/htdocs/.../uploads/
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755);
        }

        // Make name unique:   20250702_113045_invoice.pdf
        $uniqueName = date('Ymd_His') . '_' . $origFilename;
        $finalPath = $uploadDir . $uniqueName;

        /* STEP 4 ─ move the file from temp to /uploads ------------- */
        if (!move_uploaded_file($tmpPath, $finalPath)) {
            die('Unable to move uploaded file.');
        }

        $sqlQuery = "INSERT  INTO  vehicle_logs(name, designation, arrTime, deptTime, place, purpose, fileName, fileType, fileData) VALUES(?, ?, ?, ?, ?, ? ,?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sqlQuery);
        if (!$stmt) {
            die("Sorry Preparation Failed" . mysqli_error($conn));
        } else {
            $stmt->bind_param('sssssssss', $name, $design, $arrTime, $deptTime, $place, $purpose, $origFilename, $mime, $finalPath);
            $stmt->execute();
            $stmt->close();

            alertFunc('Data Stored Successfully✅', 'vehicleRegister.php');
            // echo '<script>alert(" File uploaded and saved (ID ' . mysqli_insert_id($conn) . ').")</script>';
        }

    } else {
        die('Click register first');
    }

}




function handlelogin()
{
    global $conn, $loginpaswd, $uname_or_email;

    $adminsql = "SELECT adminName, adminEmail, adminPaswd FROM adminsTbl where adminEmail = ? OR adminName = ?";
    $stmt = mysqli_prepare($conn, $adminsql);
    $stmt->bind_param('ss', $uname_or_email, $uname_or_email);
    $stmt->execute();
    mysqli_stmt_bind_result($stmt, $foundAdname, $foundAdemail, $foundAdpasswd);
    mysqli_stmt_fetch($stmt);
    $stmt->close();


    if ($foundAdname === $uname_or_email || $foundAdemail === $uname_or_email) {
        if ($foundAdpasswd === $loginpaswd) {
            redirectFunc('responses.php');
            exit;
        } else {
            alertFunc('Password Incorrect Check Again! ❌', 'login_form.php');
        }
    } elseif (paswd_verify($loginpaswd, $loginpaswd, 'login')) {

        //? If the user is not admin then check in usersTbl

        $sqlQuery = "SELECT userId, userName, userEmail, userPaswd FROM usersTbl where userEmail = ? OR userName = ?";
        $stmt = mysqli_prepare($conn, $sqlQuery);
        $stmt->bind_param('ss', $uname_or_email, $uname_or_email);
        $stmt->execute();
        mysqli_stmt_bind_result($stmt, $userid, $founduname, $founduemail, $foundupasswd);
        mysqli_stmt_fetch($stmt);
        $stmt->close();
        if ($founduname === $uname_or_email || $founduemail === $uname_or_email) {
            if ($foundupasswd === $loginpaswd) {
                // redirectFunc('vehicleRegister.php');
                alertFunc("Logged In Successfully✅", 'vehicleRegister.php');
                $_SESSION['user_id'] = $userid;
                exit;
            } else {
                echo
                    alertFunc('Password Incorrect Check Again! ❌', 'login_form.php');            // 
                // $_SESSION['wrgpaswd']="Password Incorrect Check Again!";
                // redirectFunc('login_form.php');
                // exit;


            }
        } else {
            alertFunc("Sorry No Username Or Email Exist ❌, Create Create New Account ✅", 'login_form.php');
        }
    }
}


function redirectFunc($url)
{
    header("Location:" . $url);
}

function alertFunc($msg, $url)
{
    $msg = addslashes($msg);

    echo "<script>
            alert('$msg');
            window.location.href = '$url';
            </script>";
}



