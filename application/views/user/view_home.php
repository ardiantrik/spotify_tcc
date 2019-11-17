<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <?php $this->load->view('style'); ?>
</head>
<body>
    <div class="container">
        <center>
            <h1>Winamp Onlen</h1>
        </center>
    </div>
    <div>
        <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Categories</th>
                    <th>Enjoy!</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $temp_loc = sys_get_temp_dir();
                    $temp_loc= str_replace("\\", "/", $temp_loc);
                    $no=1;
                    foreach ($data as $data) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['title']; ?></td>
                            <td><?= $data['artist']; ?></td>
                            <td><?= $data['categories']; ?></td>
                            <td>
                                <audio controls="" preload="auto" style="width: 100%;">
                                    <source src="<?= base_url("assets/$data[file_name]");
                                    //$temp_loc.'/'.$data['file_name']; ?>" type="audio/mpeg">
                                </audio>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Categories</th>
                    <th>Enjoy!</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
<footer>
    <div align="right">
        Anda Admin? Login di <a href="<?= base_url("index.php/main_controller/login"); ?>">sini</a>!
    </div>
</footer>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</html>