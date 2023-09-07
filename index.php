<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <?php include './navbar.php' ?>
    <?php include './database.php' ?>
    <?php

    if (isset($_POST['submit'])) {
        if (!empty($_POST['title'] && !empty($_POST['desc']))) {
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $sql = "INSERT INTO notes_table(title, description) VALUES('$title', '$desc')";
            $res = $conn->query($sql);
            header("Location: /"); // goto main
            exit;
        }
    }
    ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form method="POST" class="border border-secondary p-4 rounded shadow">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title..." name="title">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" id="desc" rows="3" placeholder="Enter description..." name="desc"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="text-center">Your Notes</h1>

                <?php
                $sql = "SELECT * from `notes_table`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card my-3">
                                <div class="card-header">
                                    Note #1
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['title'] . '</h5>
                                    <p class="card-text">' . $row['description'] . '</p>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </div>
                            </div>';
                    }
                } else {
                    echo '<h4 class="mt-4 text-center">No notes. Create them!</h5>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>