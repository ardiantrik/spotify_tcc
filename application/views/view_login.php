<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="assets/style/style.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</head>

<body>
	<form action="<?php echo base_url('index.php/Main_controller/do_login'); ?> " method="POST">
	  <div class="container" style="padding-top: 10%;">
	    <div class="row">
	      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
	        <div class="card card-signin my-5">
	          <div class="card-body">
	            <h5 class="card-title text-center">Sign In</h5>
	            <form class="form-signin">
	              <div class="form-label-group">
	                <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
	                <label for="inputEmail">Username</label>
	              </div>

	              <div class="form-label-group">
	                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
	                <label for="inputPassword">Password</label>
	              </div>

	              <div class="custom-control custom-checkbox mb-3">
	                <input type="checkbox" class="custom-control-input" id="customCheck1">
	                <label class="custom-control-label" for="customCheck1">Remember password</label>
	              </div>
	              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
	             
	              
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
  </form>
</body>

</html>