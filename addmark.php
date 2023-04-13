<?php
include("connect.php");

extract($_POST);
if(isset($save)){

$inputData = [
'username' => validate($fullName) ?? "",
'regno'   => validate($gender) ?? "",
'unit1'    => validate($unit1) ?? "",
'unit2'    => validate($unit2) ?? "",
'unit3'    => validate($unit3) ?? "",
'unit4'    => validate($unit4) ?? "",
];

$tableName= "student";
$db = $conn;
$result= insert_data($db, $tableName, $inputData);

}

function insert_data($db, $tableName, $inputData){

 $data = implode(" ",$inputData);
if(empty($db)){
 $msg= "Database connection error";
}elseif(empty($tableName)){
  $msg= "Table Name is empty";
}elseif(trim( $data ) == ""){
  $msg= "Empty Data not allowed to insert";
}else{

    $query  = "INSERT INTO ".$tableName." (";
    $query .= implode(",", array_keys($inputData)) . ') VALUES (';
    $query .= "'" . implode("','", array_values($inputData)) . "')";
    $execute= $db->query($query);
   if($execute=== true){
    function alert($message) {
        echo "<script>alert('$message');
    window.location.href='staffpage.php';
    </script>";
   }
   // Function call
   alert("Marks Added Successfully!!");
 }else{
  $msg= mysqli_error($db);
 }
}
 return $msg;

}

function validate($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adding Marks</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form">
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
            <h2>Adding Marks</h2>

           <label>Username</label>
                <input type="text" name="username" class="form-control">
            </div>    
            <div class="form-group">
                <label>Registration No</label>
                <input type="text" name="regno" class="form-control">
            </div>
            <div class="form-group">
                <label>Unit1</label>
                <input type="text" name="unit1" class="form-control">
            </div>
            <div class="form-group">
                <label>Unit2</label>
                <input type="text" name="unit2" class="form-control">
            </div>
            <div class="form-group">
                <label>Unit3</label>
                <input type="text" name="unit3" class="form-control">
            </div>
            <div class="form-group">
                <label>Unit4</label>
                <input type="text" name="unit4" class="form-control">
            </div>
        
            <div class="form-group">
                <input type="submit" class="btn" value="Submit">
           </div>
        </form>
    </div>    
</body>
</html>