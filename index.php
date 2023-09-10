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
    <?php include './editModal.php' ?>
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
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="border border-secondary p-4 rounded shadow">
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
                $counter = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $counter++;
                        echo '<div class="card my-3">
                                <div class="card-header">
                                    Note №' . $counter . '
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['title'] . '</h5>
                                    <p class="card-text">' . $row['description'] . '</p>
                                    <button type="button" class="btn btn-primary edit" id="' . $row['id'] . '" data-bs-toggle="modal" 
                                    data-bs-target="#exampleModal">Edit</button>
                                    <a href="./delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>
                                </div>
                            </div>';
                    }
                } else {
                    echo '<h4 class="mt-4 text-center">No notes. Create them!</h5>';
                }
                ?>
                <div style="display: none;">
                    <h4 class="mt-4 text-center" id="noText">No notes found.</h4>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        const edit = document.querySelectorAll('.edit');
        const editTitle = document.getElementById('editTitle')
        const editDesc = document.getElementById('editDesc')
        const hiddenInput = document.getElementById('hidden')
        const cardBody = document.querySelectorAll('.card-body')
        const noText = document.getElementById('noText')

        edit.forEach(element => {
            element.addEventListener('click', () => {
                editTitle.value = element.parentElement.children[0].innerText
                editDesc.value = element.parentElement.children[1].innerText
                hiddenInput.value = element.id
            })
        })

        const search = document.getElementById('search')
        search.addEventListener('input', () => {
            const value = search.value.toLowerCase()
            var found = false

            cardBody.forEach(element => {
                titleText = element.children[0].innerText.toLowerCase()
                titleDesc = element.children[1].innerText.toLowerCase()

                if (titleText.includes(value) || titleDesc.includes(value)) {
                    element.parentElement.style.display = 'block'
                    found = true
                } else {
                    element.parentElement.style.display = 'none'
                }
            })
            if (!found) {
                noText.parentElement.style.display = 'block'
            } else {
                noText.parentElement.style.display = 'none'
            }
        })
    </script>
</body>

</html>