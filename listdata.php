<?php
    // koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "todo");

    // Add todo
    if (isset($_POST['simpan'])) {
        $tugas = $_POST['task'];
        $priority = $_POST['priority'];
        $sql = "INSERT INTO tbl_tugas (prioritas, tugas, status) VALUES ('[$priority]', '[$tugas]', 'No Status')";
        mysqli_query($conn, $sql);
    }
    die($_POST['simpan']);

    if (isset($_GET['status'])) {
        if ($_GET['status'] == 1) {
            $sql = "UPDATE tbl_tugas SET status='On Progres' WHERE id=$_GET[id]";
        } else if ($_GET['status'] == 2) {
            $sql = "UPDATE tbl_tugas SET status='Cancelled' WHERE id=$_GET[id]";
        }else if (['status'] == 3) {
            $sql = "UPDATE tbl_tugas SET status='Done' WHERE id=$_GET[id]";
        } else if ($_GET['status'] == 4) {
            $sql = "DELETE FROM tbl_tugas WHERE id=$_GET[id]";
        }
        mysqli_query($conn, $sql);
    }

    // query sql
    $sql = "SELECT * FROM tbl_tugas";
    $hasil = mysqli_query($conn, $sql);
?>

<h1 class="mt-4">List Data</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">To Do List</li>
                        </ol>

                        <form action="" method="POST">
                            <div class="row g-4 align-items-center">
  <div class="col-auto">
    <label for="" class="col-form-label">New To Do : </label>
  </div>
  <div class="col-auto">
    <input type="text" id="" class="form-control" name="task">
  </div>
  <div class="col-auto">
  <select class="form-select" aria-label="Default select example" name="priority">
  <option selected>Set Priority</option>
  <option value="High">High</option>
  <option value="Medium">Medium</option>
  <option value="Low">Low</option>
</select>
  </div>
  <div class="col-auto">
  <button type="button" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
  </div>
</div>
                            
                        </form>
                        <br>

                        <div class="container-fluid px-4">
<div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Priority</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Priority</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($hasil as $h) : ?>
                <tr>
                <td><?php echo $i; ?></td>
                    <td><?= $h["prioritas"] ?></td>
                    <td><?= $h["tugas"] ?></td>
                    <td><?= $h["status"] ?></td>
                    <td>
                        <a href="index.php?halaman=listdata&status=1&id=<?= $h['id']; ?>" class="btn btn-info">Start</a>
                        <a href="index.php?halaman=listdata&status=2&id=<?= $h['id']; ?>" class="btn btn-warning">Cancel</a>
                        <a href="index.php?halaman=listdata&status=3&id=<?= $h['id']; ?>" class="btn btn-success">Done</a>
                        <a href="index.php?halaman=listdata&status=4&id=<?= $h['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>