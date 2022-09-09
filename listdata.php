<?php
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
    }

    if (isset($_POST['simpan'])) {
            $_POST['tugas'] = $_POST['task'];
            tambah($_POST);
        }

        if (isset($_GET['status'])) {
            status($_GET);
        }

        $hasil = query("SELECT * FROM tbl_tugas");
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
  <option value="High">High</option>
  <option value="Medium">Medium</option>
  <option value="Low">Low</option>
</select>
  </div>
  <div class="col-auto">
  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
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
                        <a href="index.php?halaman=listdata&status=1&id=<?= $h['id']; ?>" class="btn btn-primary"><i class="fa-solid fa-play"></i></a>
                        <a href="index.php?halaman=listdata&status=2&id=<?= $h['id']; ?>" class="btn btn-warning"><i class="fa-solid fa-ban"></i></a>
                        <a href="index.php?halaman=listdata&status=3&id=<?= $h['id']; ?>" class="btn btn-success"><i class="fa-solid fa-check"></i></a>
                        <a href="index.php?halaman=listdata&status=4&id=<?= $h['id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>