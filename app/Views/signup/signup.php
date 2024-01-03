<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $content_title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
	<div class="jumbotron text-center">
		<h1>Welcome to Infovistar.in</h1>
		<p>Registration Example with AJAX</p>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				
			</div>
			<div class="col-sm-6">
                <div class="message"></div>
                <form id="form-signup" method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile No." maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-signup" class="btn btn-success">Create Account</button>
                        <a href="<?php echo base_url("login"); ?>" class="btn btn-info">Go to Login</a>
                    </div>
                </form>
			</div>
		</div>
	</div>

    <script>
        $(document).ready(function() {
            $("#form-signup").on("submit", function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                $.post('<?php echo base_url("signup/create"); ?>', data, function(result) {
                    $(".message").html(result.message);
                    if(result.status) {
                        // window.location.replace(result.location);
                    } 
                }, 'json');
            });
        });
    </script>
</body>

</html>