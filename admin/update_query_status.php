<?php
include 'conn.php'; // Include the database connection file

// Check if the 'id' parameter is set in the POST request
if (isset($_POST['id'])) {
    // Sanitize the input to prevent SQL injection
    $que_id = mysqli_real_escape_string($conn, $_POST['id']);

    // Prepare the SQL UPDATE statement
    $sql = "UPDATE contact_query SET query_status = 1 WHERE query_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $que_id); // 'i' indicates the type is integer

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // If successful, return a success response
        echo json_encode(['success' => true]);
    } else {
        // If there was an error, return an error response
        echo json_encode(['success' => false, 'message' => 'Error updating record: ' . mysqli_error($conn)]);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If no ID is provided, return an error response
    echo json_encode(['success' => false, 'message' => 'No ID provided for update.']);
}

// Close the database connection
mysqli_close($conn);
?>