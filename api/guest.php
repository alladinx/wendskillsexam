<?PHP
header("Content-Type: application/json");

$data = json_decode( file_get_contents('php://input'), true );
$result = $data['f']($data);

include_once("database.php");
include_once("guestController.php");

function saveGuest($v){
    $p['guestName'] = $v['guestName'];
    $p['createdDate'] = date("Y-m-d H:i:s");

    $res = saveGuestData($p);

    return $res;
}

function saveGuestData($v){
    $db = connectDB();

    $sql = "INSERT INTO mst_guests(guestname,createddate) 
            VALUES('".$v['guestName']."','".$v['createdDate']."')";
    mysqli_query($db, $sql);

    closeDB($db);
}

function connectDB(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "webdevrey";
    $port = "3307";
    $con = new mysqli($host, $user, $pass, $dbname,$port);

    return $con;
}

function closeDB($con){
    mysqli_close($con);
}

echo json_encode($result);
?>