<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <center>
            <a href="<?php echo base_url("index.php/main_controller/viewTampilData"); ?>"><button>Output</button></a>
        </center>
    </div>
    <div>
        <center>
            <table width="100%">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Artist</th>
                    <th>Opsi</th>
                </tr>
                <?php
                    $no=1;
                    foreach ($data as $data) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['title']; ?></td>
                            <td><?= $data['artist']; ?></td>
                            <td>
                                <audio controls="" preload="auto" style="width: 100%;">
                                    <source src="<?php echo base_url("assets/$data[file_name]"); ?>" type="audio/mpeg">
                                </audio>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </center>
    </div>
</body>
</html>