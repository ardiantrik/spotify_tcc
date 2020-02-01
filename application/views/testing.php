<!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
    <script src="main.js"></script>
    <?php $this->load->view('style'); ?>
</head>
<body>
	<div>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
	        <thead>
	            <tr>
	                <th>Title</th>
	                <th>Artist</th>
	                <th>Categories</th>
	                <th>Enjoy!</th>
	                <th>Option</th>
	            </tr>
	        </thead>
	        <tbody>
	            <tr>
	                <td>Tiger Nixon</td>
	                <td>System Architect</td>
	                <td>Edinburgh</td>
	                <td>61</td>
	                <td>2011/04/25</td>
	                
	            </tr>
	            <tr>
	                <td>Garrett Winters</td>
	                <td>Accountant</td>
	                <td>Tokyo</td>
	                <td>63</td>
	                <td>2011/07/25</td>
	                
	            </tr>
	        </tbody>
	        <tfoot>
	            <tr>
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