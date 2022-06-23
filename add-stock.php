<?php
session_start();

if (isset($_SESSION['name'])) {
} else {
    header('location:login.php');
}
include('class/database.php');
class profile extends database
{
    protected $link;
    public function showProfile()
    {

        # code...
    }
}
$obj = new profile;
$objShow = $obj->showProfile();
$row = mysqli_fetch_assoc($objShow);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <link rel="stylesheet" href="./css/site.css">
    <link rel="stylesheet" href="./css/richtext.min.css">
    <style>
    .profileImage {
        height: 200px;
        width: 200px;
        object-fit: cover;
        border-radius: 50%;
        margin: 10px auto;
        cursor: pointer;

    }



    .upload_btn {
        background-color: #EEA11D;
        color: #05445E;
        transition: 0.7s;
    }

    .upload_btn:hover {
        background-color: #05445E;
        color: #EEA11D;
    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }

    .gap {
        margin-bottom: 95px;
    }

    body {
        font-family: 'Raleway', sans-serif;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                            class="text-secondary font-weight-light">Welcome |</span>
                        <?php echo $row['full_name'] ?>
                    </h3>

                    <div class="account bg-white mt-5 p-5 rounded">

                        <h3 class="font-weight-bold mb-5" style="color: #05445E">Inventory</h3>
                        <form action="" id="myForm" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <label for="name" class="font-weight-bold">Name</label>
                                    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"
                                        class="form-control bg-light">

                                    <label for="barcode" class="font-weight-bold mt-4 mb-0">Barcode</label>
                                    <input type="text" id="barcode" name="barcode"
                                        value="<?php echo $row['barcode']; ?>" class="form-control bg-light">





                                </div>
                                <div class="col-md-5 text-center">

                                    <img class="profileImage" onclick="triggerClick()" id="profileDisplay"
                                        src="user_img/<?php echo $row['image']; ?>" alt="">
                                    <input type="file" accept="image/*" name="image" id="profileImage"
                                        onchange="displayImage(this)" style="display: none;">
                                    <p class="lead gap">Tap to upload image</p>
                                    <!-- <input class="btn font-weight-bold log_btn btn-lg mt-5" type="submit"
                                        value="Confirm Changes">
                                    </input> -->

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="qualification" class="font-weight-bold mt-4 mb-0">Qualification</label>
                                    <textarea class="content2 mt-0"
                                        name="qualification"><?php echo $row['qualification']; ?></textarea>

                                </div>
                                <div class="col-md-6">
                                    <label for="Skill" class="font-weight-bold mt-4 mb-0">Skill</label>
                                    <textarea class="content3 mt-0" name="skill"><?php echo $row['skill']; ?></textarea>
                                </div>
                            </div>
                            <input class="btn font-weight-bold log_btn btn-lg mt-5 mb-3" type="submit"
                                value="Confirm Changes">
                            </input>
                        </form>
                        <div id="output"></div>

                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script>
    //This ajax call will take the user info to update.php
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "update.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#output').fadeIn().html(response);
                    setTimeout(() => {
                        $('#output').fadeOut('slow');
                    }, 2000);
                }
            });

        });
    })
    </script>


</body>

</html>