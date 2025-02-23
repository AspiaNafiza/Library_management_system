<?php

//index.php

include "db.php";

echo "<h2>Welcome to the Library</h2>";

$result = $conn->query("SELECT * FROM books");

echo "<table border='1'>
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Author</th>
    <th>Copies</th>
    <th>Actions</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['title']}</td>
        <td>{$row['author']}</td>
        <td>{$row['copies']}</td>
        <td>
            <form action='borrow.php' method='POST' style='display:inline;'>
                <input type='hidden' name='book_id' value='{$row['id']}'>
                <input type='submit' value='Borrow'>
            </form>
            <form action='return.php' method='POST' style='display:inline;'>
                <input type='hidden' name='book_id' value='{$row['id']}'>
                <input type='submit' value='Return'>
            </form>
        </td>
    </tr>";
}
echo "</table>";
?>