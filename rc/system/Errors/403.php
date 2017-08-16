<?php require_once __DIR__ . '/../Setup/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>403</title>
<link rel="stylesheet" href="<?php echo baseUrl();?>rc/system/Style/style.css">
<link rel="stylesheet" href="<?php echo baseUrl(); ?>vendor/components/bootstrap/css/bootstrap.css" media="screen">
<link rel="stylesheet" href="<?php echo baseUrl(); ?>vendor/components/font-awesome/css/font-awesome.css" media="screen">
<link rel="shortcut icon" href="<?php echo baseUrl(); ?>rc/system/favicon.png" />
</head>
<body>
  <div class="container">
      <div class="row">
      <div class="error-template">
  	    <h1>Oops!</h1>
  	    <h2>403 Permission Denied</h2>
  	    <div class="error-details">
  		Sorry, You do not have permission to access this page.<br>
  	    </div>
  	    <div class="error-actions">
  		<a href="<?php echo baseUrl(); ?>" class="btn btn-primary">
  		    Take Me Home <i class='fa fa-home'></i> </a>
  	    </div>
  	</div>
      </div>
  </div>
</body>
</html>
