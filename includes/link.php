<?php
    $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $base_url .= $_SERVER['HTTP_HOST'];
    $base_url .= str_replace(basename($_SERVER['DOCUMENT_ROOT']), "", dirname($_SERVER['SCRIPT_NAME']));
    define('BASE_URLS', $base_url);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="<?php echo BASE_URLS; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo BASE_URLS; ?>/assets/css/bootstrap-icons.css" rel="stylesheet">
<link href="<?php echo BASE_URLS; ?>/assets/css/style.css" rel="stylesheet">
<?php print_r($base_url); ?>