<?php
    include_once 'connect.php';
    ob_start();
    session_start();

    if(!isset($_SESSION['userkullanici_mail'])){
        Header("Location:login.php?durum=fakegiris");
    }

    if($_SESSION['userkullanici_mail']=="admin@gmail.com"){
        Header("Location:adminpanil.php?durum=admingiris");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
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
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">DEMİR ÇELİK</a></li>
                                <li><a class="dropdown-item" href="#!">ELEKTRONİK MALZEMELERİ</a></li>
                                <li><a class="dropdown-item" href="#!">ELEKTRİK MOTORLARI</a></li>
                                <li><a class="dropdown-item" href="#!">REDÜKTÖR</a></li>
                                <li><a class="dropdown-item" href="#!">RULMAN, KEÇE VE KAYIŞ</a></li>
                                <li><a class="dropdown-item" href="#!">HIRDAVAT</a></li>
                                <li><a class="dropdown-item" href="#!">LAZER KESİM VE PLAZMA </a></li>
                                <li><a class="dropdown-item" href="#!">SANAYİ MAKİNALARI</a></li>
                                <li><a class="dropdown-item" href="#!">KALIP SANAYİ</a></li>
                                <li><a class="dropdown-item" href="#!">DİŞLİ SANAYİ</a></li>
                                <li><a class="dropdown-item" href="#!">ALÜMİNYUM</a></li>
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
                    <div class="d-flex">
                        <button class="btn btn-outline-dark">
                            <li class="nav-item">
                                <a href="logout.php">
                                <span class="nav-link-inner--text">Logout</span>
                                </a>
                                
                            </li>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                        
                        $dbproducts=$db->prepare("SELECT * FROM products");
                        $dbproducts->execute();

                        while($productsdata=$dbproducts->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img width="150" height="250" class="card-img-top" src="<?php echo $productsdata['productImage'] ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $productsdata['productName'] ?></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <p class="lead"><?php echo $productsdata['productDescription']?></p>
                                    <!-- Product Time -->
                                    <strong>Time</strong><br>
                                    <?php echo $productsdata['offerCreateTime']." - ". $productsdata['offerFinishedTime'] ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="productdata.php?productid=<?php echo $productsdata['id']?>">Read About</a></div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
