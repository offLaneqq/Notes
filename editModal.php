<?php 
include './database.php';

if(isset($_POST['hidden'])) {
  $title = $_POST['editTitle'];
  $desc = $_POST['editDesc'];
  $id = $_POST['hidden'];
  $sql = "UPDATE notes_table SET `id`='$id', `title`='$title', `description`='$desc' WHERE `id`='$id'";
  $res = mysqli_query($conn, $sql);
};

echo '<!-- Modal -->
<div
  class="modal fade"
  id="exampleModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog" id="liveAlertPlaceholder">
    <div class="modal-content">
      <form method="POST">
        <input type="hidden" name="hidden" id="hidden" />
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="editTitle"
              placeholder="Enter title..."
              name="editTitle"
            />
          </div>
          <div class="mb-3">
            <label for="desc" class="form-label">Description</label>
            <textarea
              class="form-control"
              id="editDesc"
              rows="3"
              placeholder="Enter description..."
              name="editDesc"
            ></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button type="submit" class="btn btn-primary" name="editSubmit">
            Edit Note
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
'; ?>
