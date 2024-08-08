<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="test.css">
    </script>
    <style>
        #caour {
            font-family: 'Times New Roman', Times, serif;
            color: #49271D;
            background-image: url('images/caroubg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        #serv{
            padding-bottom: 5rem;
            font-family: "Lora", serif;
        }
        #para{
            text-align: center;
            padding-right: 4%;
            padding-left: 4%;
        }
        #aboutus{
            padding-bottom: 8%;
        }
    </style>
    </head>
    
    <body>
        <!-- NAVIGATION BAR -->
        <div class="container-fluid" id="hometxt">
            <nav class="navbar navbar-expand-md bg-transparent">
                <div class="container">
                    <a href="home.php" class="navbar-brand"><img src="images/logo.png" alt="" class="logo"> </a>
                    <button class="navbar-toggler shadow-none border-0" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-label="Expand Navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="nav">
                        <ul class="navbar-nav fs-6 fw-bold">
                            <li class="nav-item ">
                                <a href="home.php" class="nav-link" role="button">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a href="product.php" class="nav-link">PRODUCT</a>
                            </li>
                            <li class="nav-item">
                                <a href="#aboutus" class="nav-link">ABOUT US</a>
                            </li>
                            <li class="nav-item">
                                <a href="#ourteam" class="nav-link">OUR TEAM</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- HOME -->
        <div class="container-fluid pb-5 py-3 px-5" id="hometxt">
            <div class="row">
                <div class="col col-3">
                    <div class="text-light fw-light fs-5">Hello There, Welcome!</div>
                </div>
            </div>
            <div class="row">
                <div class="col col-8" id="titletxt">
                    <h1 class="title-h1"> <span class="titlehome">COFFEE HUB</span></h1>  
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h3 class="text-light"> <i>BEST COFFEE AT <span class="highlight "><u>CVSU TANZA</i></u></span></h3>
                </div>
            </div>
            <div class="row py-4">
                <div class="col col-6">
                    <p class="text-light">Welcome to <span class="highlight">Coffee hub</span>, your ultimate destination for premium ready-to-drink coffee. Discover our exquisite range of perfectly crafted <span class="highlight">coffee beverages</span>, designed for <span class="highlight">coffee lovers</span> who crave convenience without compromising on flavor.</p>
                </div>
            </div>
            <div class="row " id="btgroup">
                <div class="col col-2">
                    <a href="" class="btn btn-outline-secondary btn-lg text-nowrap rounded-pill" role="button" id="btnlink">Purchase Now</a>
                </div>
                <div class="col col-2" id="">
                    <a href="" class="btn btn-outline-secondary btn-lg rounded-pill"role="button" id="btnlink">More Info</a>
                </div>
            </div>
        </div>

        <!-- CAROUSEL -->
        <div class="container-fluid" id="caour">
            <p class="carouseltitle align-items-center d-flex justify-content-center my-4 " id="carouseltitle">Best Seller</p>
            <p class="d-flex justify-content-center fs-5 fw-light" >These our Best Seller Products</p>
            <div id="carouselExampleDark" class="carousel mx-4" data-bs-ride="carousel">
                <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                <div class="carousel-inner">
                    <div class="carousel-item active ">
                        <div class="card align-items-center justify-content-center bg-transparent" >
                            <div class="img-wrapper border-1 ">
                                <img src="images/products/1.png"  alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex align-items-center justify-content-center">Classic Coffee</h3>
                                <p class="card-text d-flex align-items-center justify-content-center mx-3" style="text-align:center;">Classic Coffee is our best-selling ready-to-drink coffee that embodies the rich and timeless essence of a perfect coffee blend</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" >
                        <div class="card bg-transparent" >
                            <div class="img-wrapper">
                                <img src="images/products/2.png"  alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex align-items-center justify-content-center">Dalgona Coffee</h3>
                                <p class="card-text d-flex align-items-center justify-content-center mx-3" style="text-align:center;">Dalgona Coffee is a trendy, best-selling ready-to-drink beverage that brings the café experience to your home.</p>
                            </div>
                        </div>
                    
                    </div>
                    <div class="carousel-item">
                        <div class="card bg-transparent" >
                            <div class="img-wrapper">
                                <img src="images/products/3.png"  alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex align-items-center justify-content-center">Iced Coffee</h3>
                                <p class="card-text d-flex align-items-center justify-content-center mx-3" style="text-align:center;">Iced coffee is a popular and refreshing beverage made by brewing coffee and then cooling it down, typically served over ice.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card bg-transparent" >
                            <div class="img-wrapper">
                                <img src="images/products/4.png"  alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex align-items-center justify-content-center">Latte Coffee</h3>
                                <p class="card-text d-flex align-items-center justify-content-center mx-3" style="text-align:center;">The Latte Coffee is a classic favorite and best-seller in our e-commerce shop. It features a harmonious combination of strong espresso and velvety steamed milk. </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card bg-transparent" >
                            <div class="img-wrapper">
                                <img src="images/products/5.png"  alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex align-items-center justify-content-center">Caramelized Latte Coffee</h3>
                                <p class="card-text d-flex align-items-center justify-content-center mx-3" style="text-align:center;">Our Caramelized Latte is a top-seller, celebrated for its perfect blend of rich espresso and creamy steamed milk, topped with a sweet caramel drizzle</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card bg-transparent" >
                            <div class="img-wrapper">
                                <img src="images/products/6.png"  alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex align-items-center justify-content-center">Affogato</h3>
                                <p class="card-text d-flex align-items-center justify-content-center mx-3" style="text-align:center;">Affogato is a delightful and elegant ready-to-drink coffee treat that merges the boldness of espresso with the creaminess of vanilla ice cream. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev btn btn-light" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next btn btn-light" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- ABOUT US-->
        <div class="container-fluid  pt-4 px-4" id="aboutus">
            <div class="row pt-5 ">
                <div class="col col-12 d-flex justify-content-center align-content-center">
                    <p style="color:#49271D " class="fs-6">About Us</p>
                </div>
            </div>
            <div class="row">
                <div class="col col-12 d-flex justify-content-center align-content-center" id="serv">
                    <h1 style="color:#49271D; font-weight:600;">Serving since 2023</h1>
                </div>
            </div>
            <div class="row ">
                <div class="col col-6 d-flex justify-content-center align-content-center"style="color:#49271D; font-family: 'Times New Roman', Times, serif; font-weight:600;">
                    <h1>Our Story</h1>
                </div>
                <div class="col col-6 d-flex justify-content-center align-content-center"style="color:#49271D; font-family: 'Times New Roman', Times, serif; font-weight:600;">
                    <h1>Our Vision</h1>
                </div>
            </div>
            <div class="row">
                <div class="col col-6  d-flex justify-content-center align-content-center text-align-justify px-5">
                    <p class="text-align-center d-flex justify-content-center align-content-center" id="para">Our journey began with a simple idea: to make premium coffee accessible to everyone, anywhere, at any time. As passionate coffee aficionados, we were often frustrated by the limited options available when we craved a great cup of coffee on the go. The bustling coffee shops, long waits, and inconsistent brews were far from ideal. We wanted something better—a coffee experience that was both convenient and uncompromising in quality.</p>
                </div>
                <div class="col col-6  d-flex justify-content-center align-content-center ">
                    <p class="text-align-center d-flex justify-content-center align-content-center px-5" id="para">At Coffee Hub, our vision is to brew a world where every coffee lover can experience the rich, diverse flavors of café-quality coffee in the comfort of their own home. We believe in the power of coffee to inspire, energize, and bring people together. That's why we are committed to crafting exceptional ready-to-drink beverages that not only satisfy your taste buds but also elevate your everyday moments. We aim to be the go-to brand for coffee enthusiasts who seek convenience without compromising on quality.</p>
                </div>
            </div>

            <div class="row">
                <div class="col">

                </div>
            </div>
            <!-- <div class="row">
                <div class="col col-6 d-flex justify-content-center align-content-center">
                    <a href="" role="button" class="btn btn-outline-secondary btn-lg "  style="background-color: #49271D; border-color:#ECB176 ; color: white; font-family: "Josefin Sans", sans-serif;font-weight: 400;"> Learn More</a>
                </div>
                <div class="col col-6 d-flex justify-content-center align-content-center">
                    <a href="" role="button" class="btn btn-outline-secondary btn-lg " style="background-color: #BC7E56; border-color:#ECB176 ; color: white; font-family: "Josefin Sans, sans-serif;font-weight: 400;"> Learn More</a>
                </div>
            </div> -->
        </div>

        <!-- OUR TEAM-->
         <div class="container-fluid">
                
         </div>

        <script src="jquery.js"> </script>
        <script>
            var carouselWidth = $('.carousel-inner')[0].scrollWidth;
            var cardWidth = $('.carousel-item').width();
            var scrollPosition = 0;
            $('.carousel-control-next').on('click', function(){
                if(scrollPosition < (carouselWidth - (cardWidth * 4))){
                    console.log('next');
                    scrollPosition = scrollPosition + cardWidth;
                    $('.carousel-inner').animate({scrollLeft:scrollPosition},600)
                }
            })
            $('.carousel-control-prev').on('click', function(){
                if(scrollPosition > 0){
                    console.log('prev');
                    scrollPosition = scrollPosition - cardWidth;
                    $('.carousel-inner').animate({scrollLeft:scrollPosition},600)
                }
            })
        </script>
    </body>
</html>