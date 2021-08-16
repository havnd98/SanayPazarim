<?php
include_once 'connect.php';

$dbproducts = $db->prepare("SELECT * FROM products where id=:pdid");
$dbproducts->execute(array(
    'pdid' => htmlspecialchars($_GET['productid'])
));

$productsdata = $dbproducts->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Item - Start Bootstrap Template</title>
    <!--  Sweet alert  -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon3.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles3.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img width="250" height="600" class="card-img-top mb-5 mb-md-0" src="<?php echo $productsdata['productImage'] ?>" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">Product ID : <?php echo $productsdata['id'] ?></div>
                    <h1 class="display-5 fw-bolder"><?php echo $productsdata['productName'] ?></h1>
                    <div class="fs-5 mb-5">
                        <span><?php echo $productsdata['offerCreateTime'] . " - " . $productsdata['offerFinishedTime'] ?></span>
                    </div>
                    <p class="lead"><?php echo $productsdata['productSubDescription'] ?></p>

                    <form id="offer" action="" method="POST">
                        <div>
                        <input type="hidden" id="productid" value="<?php echo $productsdata['id']?>">
                        </div>
                        <div class="d-flex">
                            <label>
                                <h4>Teklif aciklamasi</h4>
                            </label>
                            <input id="aciklama" class="form-control text-center me-3" type="text" style="max-width: 50rem " />
                        </div>
                        <br>
                        <div class="d-flex">
                            <label>
                                <h4>Teklif Para Degeri :</h4>
                            </label>
                            <input id="teklifdegeri" class="form-control text-center me-3" type="num" style="max-width: 10rem" />
                        </div>
                        <input type="hidden" name="teklifver">
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Teklif ver
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts3.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#offer").submit(function() {

                var formID = $(this).attr('id');
                var formDetails = $('#' + formID);

                $.ajax({

                    type: "POST",
                    url: 'controller.php',
                    data: formDetails.serialize(),
                    success: function(data) {

                        veri = JSON.parse(data);
                        swal("Teklif Sonucu", veri.message, veri.status)
                            .then((value) => {
                                window.location.href = "kullanicipanil.php";
                            });

                    }

                });
                return false;
            });
        });
    </script>

</body>

</html>