<?php
include "db.php";

if (isset($_POST['Addadmins'])) {
    try {

        $Name = mysqli_real_escape_string($conn, $_POST['Names']);
        $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
        $userid = mysqli_real_escape_string($conn, $_POST['userid']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
    

            // ✅ Step 6: Insert Data into Database
            $query = "INSERT INTO login(name, phoneno, userid, password, role ) VALUES ('$Name','$phoneno','$userid','$password','1')";
            if (mysqli_query($conn, $query)) {
                $res = [
                    'status' => 200,
                    'message' => 'User Added Successfully'
                ];
                echo json_encode($res);
            } else {
                throw new Exception('Query Failed: ' . mysqli_error($conn));
            }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}

if (isset($_POST['delete_user'])) {
    $id = mysqli_real_escape_string($conn, $_POST['userid']);
    $query = "DELETE FROM login WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>