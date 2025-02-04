<?php
include 'conn.php'; // Include the database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $que_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM contact_query WHERE query_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $que_id); // 'i' indicates the type is integer

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // If successful, redirect to the query listing page
        header("Location: query.php?message=Record+deleted+successfully");
        exit();
    } else {
        // If there was an error, display it
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "No ID provided for deletion.";
}

// Close the database connection
mysqli_close($conn);
?>