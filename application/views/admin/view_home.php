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
<body class="body">
    <div align="right">
        <button><a href="<?= base_url("index.php/main_controller/do_logout"); ?>">LOG OUT</a></button>
    </div>
    <div class="container">
        <center>
            <h1>Winamp Onlen</h1>
        </center>
    </div>
    <div>
        <center>
            <table class="table">
                <tr>
                    <td width="240 px"><img src="<?php echo base_url('assets/cover_winamp.png'); ?>" height="100%" width="100%"></td>
                    <td>
                        <form method="POST" action="<?php echo base_url('index.php/main_controller/testUpData'); ?>" enctype="multipart/form-data">
                            <table class="table">
				<tr>
                                    <td>Song</td>
                                    <td><input type="file" name="song" accept=".mp3,.mp4"></td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td><input type="text" name="title"></td>
                                </tr>
                                <tr>
                                    <td>Artist</td>
                                    <td><input type="text" name="artist"></td>
                                </tr>
                                <tr>
                                    <td>Categories</td>
                                    <td><input type="text" name="categories"></td>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name="submit" value="INPUT"><input type="reset" name="reset" value="RESET"></td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
        </center>
    </div>
    <p><p><center><h3>Song List</h3></center><p>
    <div>
        <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Categories</th>
                    <th>Enjoy!</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    foreach ($data as $data) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['title']; ?></td>
                            <td><?= $data['artist']; ?></td>
                            <td><?= $data['categories']; ?></td>
                            <td>
                                <audio controls="" preload="auto" style="width: 100%;">
                                    <source src="<?php echo base_url("assets/$data[file_name]"); ?>" type="audio/mpeg">
                                </audio>
                            </td>
                            <td>
                                <!--<button><a href="">EDIT</a></button>-->
                                <button><a href="<?php echo base_url('index.php/main_controller/do_delete/'.$data['id']); ?>">DELETE</a></button>
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
                    <th>Option</th>
                </tr>
            </tfoot>
        </table>
    </div>
    
</body>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</html>