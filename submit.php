<?php include './database.php' ?>
<?php

    if (isset($_POST['submit'])) {
        if (!empty($_POST['title'] && !empty($_POST['desc']))) {
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $sql = "INSERT INTO notes_table(title, description) VALUES('$title', '$desc')";
            $res = $conn->query($sql);
            // header("Location: /"); // goto main
            // exit;
        }
    }
    ?>