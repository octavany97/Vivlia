<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- home.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Vivlia</title>
    <?php 
        echo $style;
        //Grocery CRUD CSS
        foreach($crud['css_files'] as $file):
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $file; ?>"></link>
            <?php
        endforeach;
        echo $script;
        //Grocery CRUD JavaScript
        foreach($crud['js_files'] as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach;
    ?>
</head>
<body>
    <?php echo $header; 
    echo $menuheader;
    echo $sidebar;
    ?>
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product List</h1>
            </div>  
        </div>
        <div class="row">
            <div class="col-md-12"> <?php echo $crud['output']; ?> </div>
        </div>
    </div>
        
    
</body>
</html>
