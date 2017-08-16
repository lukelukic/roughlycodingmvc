<?php require_once __DIR__ . '/../config/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Exception!</title>
<link rel="stylesheet" href="<?php echo baseUrl();?>rc/system/Style/style.css">
<link rel="stylesheet" href="<?php echo baseUrl(); ?>vendor/components/bootstrap/css/bootstrap.css" media="screen">
<link rel="stylesheet" href="<?php echo baseUrl(); ?>vendor/components/font-awesome/css/font-awesome.css" media="screen">
<link rel="shortcut icon" href="<?php echo baseUrl(); ?>rc/system/favicon.png" />
</link>
</head>
<body>
    <div class="alert alert-danger">
      <p class="lead"><?php echo isset($exType) ? $exType : ""; ?> has occured.</p>
      <p>Message: <?php echo isset($exMessage) ? $exMessage : ""; ?></p>
      <p><strong>File</strong>: <?php echo isset($exFile) ? $exFile : ""; ?><strong> Line</strong>: <?php echo isset($exLine) ? $exLine : ""; ?></p>
    </div>
</body>
</html>
