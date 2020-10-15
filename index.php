<?php
    ini_set('display_errors', 'on');
    session_start(); 
    require 'classes/Validation.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <title>U&D</title>
    </head>
    <body>

        <div class="container">
            <h1 class="text-center mt-5">Upload and Download files</h1>

            <?php echo Validation::showMessage(); ?>

            <form action="proccess.php" method="post" enctype="multipart/form-data" class="mt-5">
                <div class="form-group">
                    <p class="text-muted lead text-center">Choose files for upload</p>
                </div>
                <div style="width: 500px; margin: 0 auto" class="form-group text-center">
                    <input style="width: 400px" type="file" name="files[]" class="form-control-file float-left" id="file" multiple>
                    <input style="width: 100px" type="submit" class="form-control-file float-right" value="Upload">
                </div>
                <div class="clearfix"></div>
                
            </form>

            <div class="row mt-5">
                <div class="col-md-8 col-lg-8 mx-auto">
                    <ul class="list-group mt-5">
                        <li class="list-group-item">File one for downloading content</li>
                        <li class="list-group-item">File two for downloading content</li>
                        <li class="list-group-item">File three for downloading content</li>
                        <li class="list-group-item">File four for downloading content</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

        <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        -->
    </body>
</html>