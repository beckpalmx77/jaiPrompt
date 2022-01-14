<?php
include('includes/Header.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {

    ?>

    <!DOCTYPE html>
    <html lang="th">

<body id="page-top">
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"><span id="title"></span></h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $_SESSION['dashboard_page'] ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item"><span id="main_menu"></li>
                        <li class="breadcrumb-item active"
                            aria-current="page"><span id="sub_menu"></li>
                    </ol>
                </div>

                <div class="bg-light border-bottom shadow-sm sticky-top">

                </div>


                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="ml-2 col-sm-4">
                            <div id="msg"></div>
                            <form method="post" id="image-form" enctype="multipart/form-data"
                                  onSubmit="return false;">
                                <div class="form-group">
                                    <input type="file" name="file" class="file">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" class="browse disabled placeholder="
                                               Upload File" id="file">
                                        <input type="submit" name="submit" value="Upload" class="btn btn-danger">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <img src="gallery/80x80.png" id="preview" class="img-thumbnail">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!--Only these JS files are necessary-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

<script>
    $(document).on("click", ".browse", function () {
        let file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
        file.trigger("click");
    });
    $('input[type="file"]').change(function (e) {
        let fileName = e.target.files[0].name;
        $("#file").val(fileName);

        let reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });


    $(document).ready(function (e) {
        $("#image-form").on("submit", function () {
            $("#msg").html('<div class="alert alert-info"><i class="fa fa-spin fa-spinner"></i> Please wait...!</div>');
            $.ajax({
                type: "POST",
                url: "ajax/action.ajax.php",
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data) {
                    if (data == 1 || parseInt(data) == 1) {
                        $("#msg").html(
                            '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Data updated successfully.</div>'
                        );
                    } else {
                        $("#msg").html(
                            '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Extension not good only try with <strong>GIF, JPG, PNG, JPEG</strong>.</div>'
                        );
                    }
                },
                error: function (data) {
                    $("#msg").html(
                        '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong.</div>'
                    );
                }
            });
        });
    });
</script>
</body>


<?php } ?>