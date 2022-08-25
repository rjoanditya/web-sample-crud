<?php
$conn = mysqli_connect('localhost', 'root', '', 'magang-kami');
?>

<!doctype html>
<html lang="en">

<head>
    <title>KAMI | Rizky Joanditya WEB DEV</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h2 class="heading-section">Web Sample CRUD</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="h5 mb-4 text-center">Penilaian Magangers KAMI Batch #3</h3>
                    <div class="table-wrap">
                        <div class="d-flex justify-content-end">
                            <div class="card border-radius" style="margin:3px">
                                <button type="button" class="btn" data-toggle="modal" data-target="#inputModal">
                                    <span aria-hidden=" true"><i class="fa fa-plus"></i></span>
                                </button>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>Nama</th>
                                    <th class="text-center">Semester</th>
                                    <th class="text-center">Poin</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user = mysqli_query($conn, "SELECT * FROM user ORDER BY bidang ASC");
                                if (mysqli_num_rows($user) > 0) {
                                    while ($row = mysqli_fetch_array($user)) {
                                ?>
                                <tr class="alert" role="alert">
                                    <td>
                                        <div class="email">
                                            <span><?= $row['name'] ?></span>
                                            <span><?= $row['bidang'] ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center"><?= $row['semester'] ?></td>
                                    <td class="quantity">
                                        <div class="input-group">
                                            <input type="text" name="quantity" disabled style="background-color: white;"
                                                class="quantity form-control input-number"
                                                value="<?php echo $row['poin'] ?>" min="1" max="100">
                                        </div>
                                    </td>
                                    <!-- <td>Rp 2000000</td> -->
                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#modalEdit<?= $row['id'] ?>" class="btn pencil">
                                            <span aria-hidden="true"><i class="fa fa-pencil"></i></span>
                                        </button>
                                    </td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" id="delete" name="delete"
                                                class="btn btn-danger close">
                                                <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                            </button>
                                        </form>
                                        <?php
                                                if (isset($_POST['delete'])) {
                                                    $id = $_POST['id'];
                                                    $sqlDelete = "DELETE FROM user WHERE id = $id";
                                                    $delete = mysqli_query($conn, $sqlDelete);
                                                    if ($delete) {
                                                        echo '<script>alert("Anda Yakin akan Menghapus User?")</script>';
                                                        echo '<script>window.location="index.php"</script>';
                                                    } else {
                                                        echo 'Gagal dihapus, ' . mysqli_error($conn);
                                                    }
                                                }
                                                ?>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-2" role="dialog"
                                    aria-labelledby="editModalTitle" aria-hidden="true" data-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inputModalLongTitle">Edit Magangers</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="col-11">
                                                    <input type="hidden" name="id-user" value="<?= $row['id'] ?>"
                                                        class="form-control m-3">
                                                    <input type="text" name="name" placeholder="Nama"
                                                        value="<?= $row['name'] ?>" class="form-control m-3">
                                                    <select name="bidang" class="form-control m-3">
                                                        <option disabled selected value="<?= $row['bidang'] ?>">
                                                            <?= $row['bidang'] ?></option>
                                                        <option value="Secretary">Secretary</option>
                                                        <option value="HR Recruitment">HR Recruitment</option>
                                                        <option value="HR Development">HR Development</option>
                                                        <option value="Business Development">Business Development
                                                        </option>
                                                        <option value="Branding Strategist">Branding Strategist</option>
                                                        <option value="Public Relation">Public Relation</option>
                                                        <option value="Fundraising">Fundraising</option>
                                                        <option value="Digital Marketing">Digital Marketing</option>
                                                        <option value="Social Media Specialist">Social Media Specialist
                                                        </option>
                                                        <option value="Content Creator TikTok">Content Creator TikTok
                                                        </option>
                                                        <option value="Creative Design">Creative Design</option>
                                                        <option value="Video Editor">Video Editor</option>
                                                        <option value="Program / Project Management">Program / Project
                                                            Management</option>
                                                        <option value="Web Development">Web Development</option>
                                                    </select>
                                                    <div class="form-floating">
                                                        <label for="semester" class="mx-3">semester</label>
                                                        <input type="number" id="semester" min="1" max="8"
                                                            name="semester" placeholder="Semester"
                                                            class="form-control mx-3 mb-3"
                                                            value="<?= $row['semester'] ?>">
                                                    </div>
                                                    <input type="number" name="poin" value="<?= $row['poin'] ?>"
                                                        placeholder="Poin" max="100" class="form-control m-3">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <input type="submit" value="ubah" name="ubah"
                                                        class="btn btn-primary">
                                                </div>
                                            </form>
                                            <?php if (isset($_POST['ubah'])) {
                                                        $id = $_POST['id-user'];
                                                        $nama = $_POST['name'];
                                                        $bidang = $_POST['bidang'];
                                                        $semester = $_POST['semester'];
                                                        $poin = $_POST['poin'];
                                                        $sqlUpdate = "UPDATE user SET
                                                            name        = '" . $nama . "',
                                                            bidang    = '" . $bidang . "',
                                                            semester    = '" . $semester . "',
                                                            poin        = '" . $poin . "' 
                                                            WHERE id    = '$id'
                                                            ";
                                                        $update = mysqli_query($conn, $sqlUpdate);

                                                        if ($update) {
                                                            echo '<script>alert("Data berhasil diubah")</script>';
                                                            echo '<script>window.location="index.php"</script>';
                                                        } else {
                                                            echo 'Gagal diubah ' . mysqli_error($conn);
                                                        }
                                                    } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php }
                                } else { ?>
                                <tr>
                                    <td colspan="8">Tidak ada data</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalTitle"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputModalLongTitle">Input Magangers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="col-11">
                        <input type="text" name="name" placeholder="Nama" class="form-control m-3">
                        <select name="bidang" id="" class="form-control m-3">
                            <option disabled selected value="">Pilih Bidang</option>
                            <option value="Secretary">Secretary</option>
                            <option value="HR Recruitment">HR Recruitment</option>
                            <option value="HR Development">HR Development</option>
                            <option value="Business Development">Business Development</option>
                            <option value="Branding Strategist">Branding Strategist</option>
                            <option value="Public Relation">Public Relation</option>
                            <option value="Fundraising">Fundraising</option>
                            <option value="Digital Marketing">Digital Marketing</option>
                            <option value="Social Media Specialist">Social Media Specialist</option>
                            <option value="Content Creator TikTok">Content Creator TikTok</option>
                            <option value="Creative Design">Creative Design</option>
                            <option value="Video Editor">Video Editor</option>
                            <option value="Program / Project Management">Program / Project Management</option>
                            <option value="Web Development">Web Development</option>
                        </select>
                        <input type="number" min="1" max="8" name="semester" placeholder="Semester"
                            class="form-control m-3">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input type="submit" name="tambah" value="tambah" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($_POST['tambah'])) {
        $nama = $_POST['name'];
        $bidang = $_POST['bidang'];
        $semester = $_POST['semester'];
        $insert = mysqli_query($conn, "INSERT INTO user VALUES(null, '" . $nama . "','" . $bidang . "','" . $semester . "',null)");
        if ($insert) {
            echo '<script>alert("Data berhasil ditambahkan")</script>';
            echo '<script>window.location="index.php"</script>';
        } else {
            echo 'gagal ' . mysqli_error($conn);
        }
    }
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>