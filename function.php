<?php
        // koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "todo");

        function query($query) {
            global $conn;
            $result = mysqli_query($conn, $query);
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }

        function registrasi($data) {
            global $conn;

            $username = strtolower(stripslashes($data["username"]));
            $password = mysqli_real_escape_string($conn, $data["password"]);
            $konfirmasi = mysqli_real_escape_string($conn, $data["konfirmasi"]);

            // username sudah ada atau belum
            $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                    alert('Username Sudah Terdaftar!');
                </script>";
                return false;
            }

            // cek konfirmasi password
            if ($password !== $konfirmasi) {
                echo "<script>
                    alert('Konfirmasi password tidak sesuai');
                </script>";

                return false;
            }

            // enskripsi passwordnyaq
            $password = password_hash($password, PASSWORD_DEFAULT);

            // tambahkan user baru ke database
            mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
            return mysqli_affected_rows($conn);
        }

        // Add
        function tambah($data) {
            global $conn;

            $tugas = htmlspecialchars($data["tugas"]);
            $priority = htmlspecialchars($data["priority"]);
                $query = "INSERT INTO tbl_tugas (prioritas, tugas, status) VALUES ('$priority', '$tugas', 'No Status')";

            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }

        // Status
        function status ($data) {
            global $conn;

                if ($_GET['status'] == 1) {
                    $query = "UPDATE tbl_tugas SET status='On Progres' WHERE id=$_GET[id]";
                } else if ($_GET['status'] == 2) {
                    $query = "UPDATE tbl_tugas SET status='Cancelled' WHERE id=$_GET[id]";
                }else if ($_GET['status'] == 3) {
                    $query = "UPDATE tbl_tugas SET status='Done' WHERE id=$_GET[id]";
                } else if ($_GET['status'] == 4) {
                    $query = "DELETE FROM tbl_tugas WHERE id=$_GET[id]";
                    if( hapus($id) > 0) {
                        echo "<script>
                                alert('Data berhasil dihapus!');
                                document.location.href = 'index.php';
                            </script>";
                    } else {
                        echo "<script>
                                alert('Data gagal dihapus!');
                                document.location.href = 'index.php';
                            </script>";
                    }
                }

            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }
?>