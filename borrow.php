<?php

//borrow.php

include "db.php";

$book_id = $_POST['book_id'];

$conn->begin_transaction();

try {
    // Lock the row for update
    $stmt = $conn->prepare("SELECT copies FROM books WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stmt->bind_result($copies);
    $stmt->fetch();
    $stmt->close();

    if ($copies > 0) {
        // Reduce copies
        $stmt = $conn->prepare("UPDATE books SET copies = copies - 1 WHERE id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();

        $conn->commit();
        echo "Book borrowed successfully!";
    } else {
        throw new Exception("Book not available");
    }
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}
?>