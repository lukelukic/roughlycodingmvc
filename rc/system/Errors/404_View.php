<?php require_once __DIR__ . '/../config/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>404</title>
<link rel="stylesheet" href="<?php echo baseUrl();?>rc/system/Style/style.css">
<link rel="stylesheet" href="<?php echo baseUrl(); ?>vendor/components/bootstrap/css/bootstrap.css" media="screen">
<link rel="stylesheet" href="<?php echo baseUrl(); ?>vendor/components/font-awesome/css/font-awesome.css" media="screen">
</link>
</head>
<body>
  <div class="container">
      <div class="row">
      <div class="error-template">
  	    <h2>View Not Found</h2>
  	    <div class="error-details">
  		Sorry, an error has occured, requested view <strong><i><?php echo isset($view) ? $view : ""; ?></i></strong> not found!<br>
  	    </div>
  	</div>
      </div>
  </div>
</body>
</html>
