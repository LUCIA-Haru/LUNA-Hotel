<?php

$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'luna';

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Cannot Connect to Database" . mysqli_connect_error());
}
// Prevent SQL injection 
    function filtration($data) {
    foreach ($data as $key => $value) {
        // Trim whitespace
        $value = trim($value);

        // Remove backslashes
        $value = stripslashes($value);

        // Strip HTML tags
        $value = strip_tags($value);

        // Convert special characters to HTML entities
        $value = htmlspecialchars($value);

        // Assign filtered value back to data
        $data[$key] = $value;
    }
    return $data;
}
// SQL Functions
function selectAll($table)
    {
        $con = $GLOBALS['con'];
        $res = mysqli_query($con, "SELECT * FROM $table");
        return $res;
        
    }

    function select($sql, $values, $datatypes) {
    // Access the global connection object
    $con = $GLOBALS['con'];

    // Prepare the SQL query
    // $con is the connection to the database whiel $sql carries $query
    if ($stmt = mysqli_prepare($con, $sql)) {
        
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Get the result set
            $res = mysqli_stmt_get_result($stmt);
            
            // Close the prepared statement
            mysqli_stmt_close($stmt);
            
            // Return the result set
            return $res;
        } else {
            // If execution fails, close the statement and exit with an error message
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Select");
        }
    } else {
        // If preparation fails, exit with an error message
        die("Query cannot be executed - Select");
    }
}
function update($sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
       if(mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
       }
       else{
           mysqli_stmt_close($stmt);
            die("Query cannot be executed - Update");
       }
    }
    else{
        die("Query cannot be executed - Update");
    }
 }
    

   function insert($sql, $values, $datatypes) {
    $con = $GLOBALS['con'];

    // Prepare the SQL statement
    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Get the number of affected rows
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Insert");
        }
    } else {
        die("Query cannot be executed - Insert");
    }
}
function delete($sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
       if(mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
       }
       else{
           mysqli_stmt_close($stmt);
            die("Query cannot be executed - Delete");
       }
    }
    else{
        die("Query cannot be prepared - Delete");
    }
 }
?>