<?php

//return.php

include "db.php";

$book_id = $_POST['book_id'];

$conn->begin_transaction();

try {
    // Increase available copies
    $stmt = $conn->prepare("UPDATE books SET copies = copies + 1 WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();

    $conn->commit();
    echo "Book returned successfully!";
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}
?>