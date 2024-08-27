<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/ourteam.css">
</head>
<body>
    <!-- <div class="container-fluid" id="ourteam">
        <div class="container" id="innerourteam">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column align-items-center justify-content-center text-align-center">
                    <h2 class="ourteamtitle">Meet the <span class="fw-bold" style="color:#BC7E56;">Members.</span></h2>
                    <h1 class="dot">...</h1>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row" id="people">
                        <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column align-items-center justify-content-center text-align-center">
                            <div class="card" style="width: 17rem; ">
                                <img src="images/gmates/merce.png" class="card-img-top" alt="John Mark Navajas"  style="max-width: 80%; height: auto; object-fit: contain;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center text-align-center">
                                    <h5 class="fw-bold">John Mark Navajas</h5>
                                    <p class="descript">I am the Master Developer behind the seamless functionality and innovative features of our platform, ensuring a top-tier experience for all our users."</p>
                                    <p class="card-title">Main Programmer | Designer</p>
                                    <div class="div">
                                        <a href="https://www.facebook.com/merce.2dlc"><i class="fa-brands fa-facebook px-2"></i></a>
                                        <i class="fa-brands fa-google px-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column align-items-center justify-content-center text-align-center">
                            <div class="card" style="width: 17rem;;">
                                <img src="images/gmates/arlan.png" class="card-img-top" alt="Arlan Moncada" style="max-width: 80%; height: auto; object-fit: contain;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center text-align-center">
                                    <h5 class="fw-bold">Arlan Moncada</h5>
                                    <p class="descript">As an Assistant Programmer and Designer, I contribute to the team by debugging, and design, helping create functional and visually appealing software.</p>
                                    <p class="card-title">Assistant Programmer | Designer</p>
                                    <div class="div">
                                        <a href="https://www.facebook.com/moncada.arlan?mibextid=ZbWKwL"><i class="fa-brands fa-facebook px-2"></i></a>
                                        <i class="fa-brands fa-google px-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column align-items-center justify-content-center text-align-center">
                            <div class="card" style="width: 17rem;">
                                <img src="images/gmates/jade.png" class="card-img-top" alt="Jade Aaron Catindig" style="max-width: 80%; height: auto; object-fit: contain;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center text-align-center">
                                    <h5 class="fw-bold">Jade Aaron Catindig</h5>
                                    <p class="descript">As an Designer i contribute to team by creating a design and layout, also helping to document every detailed descriptions of processes, projects, or information.</p>
                                    <p class="card-title">Designer | Documenter</p>
                                    <div class="div">
                                        <a href="https://www.facebook.com/Jadeaaron14.catindig?mibextid=LQQJ4d"><i class="fa-brands fa-facebook px-2"></i></a>
                                        <i class="fa-brands fa-google px-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column align-items-center justify-content-center text-align-center">
                            <div class="card" style="width: 17rem;">
                                <img src="images/gmates/lovely.png" class="card-img-top" alt="Lovely Saguiped" style="max-width: 80%; height: auto; object-fit: contain;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center text-align-center">
                                    <h5 class="fw-bold">Lovely Saguiped</h5>
                                    <p class="descript">As an Documentator is having a strong observational skills, attention to detail, and the ability to convey complex information clearly and accurately, through written reports.</p>
                                    <p class="card-title">Documenter</p>
                                    <div class="div">
                                        <a href="https://www.facebook.com/lovelyclores.saguiped?mibextid=LQQJ4d"><i class="fa-brands fa-facebook px-2"></i></a>
                                        <i class="fa-brands fa-google px-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    
    <div class="container-fluid ">
        <!-- HEADER -->
        <div class="row g-0 mb-5" id="ultraheader">
            <div class="col-3 g-0" >
                <nav class="navbar">
                    <a href="homepagelst.php"><img src="images/logo.png" alt="" class="logo"></a>
                </nav>
                <div >
                    <p class="brand-title">Coffee Hub </p>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12 col-md=12 col-sm-12 d-flex justify-content-center align-items-center">
                <p class="title">MEET THE <u>TEAM</u></p>
            </div>
        </div>
        <!-- FIRST ROW -->
        <div class="row mt-5">
            <div class="col-lg-12 d-flex justify-content-center align-items-center">
                <div class="card mb-5" style="width: 80%; height: auto;">
                    <div class="row g-0">
                        <div class="col-lg-3 col-md-9" >
                            <img src="/images/gmates/merce.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-lg-9 col-md-4" >
                            <div class="card-body">
                                <h5 class="card-title">
                                    John Mark Navajas
                                </h5>
                                <p class="card-text">
                                    As the Master Developer, they are responsible for the seamless functionality and innovative features of the platform, ensuring a top-tier experience for all users.
                                </p>
                                <p class="card-text">
                                    <div class="div">
                                        <a href="https://www.facebook.com/merce.2dlc"><i class="fa-brands fa-facebook px-2"></i></a>
                                        <i class="fa-brands fa-google px-2"></i>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- SECOND ROW -->
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center align-items-center">
                <div class="card mb-5" style="width: 80%; height: auto;">
                    <div class="row g-0">
                        <div class="col-lg-9 col-md-4">
                            <div class="card-body" style="border-right: 2px solid black">
                                <h5 class="card-title">
                                    Arlan Moncada
                                </h5>
                                <p class="card-text">
                                    As an Assistant Programmer and Designer, I contribute to the team by debugging, and design, helping create functional and visually appealing software.
                                </p>
                                <p class="card-text">
                                    <div class="div">
                                        <a href="https://www.facebook.com/lovelyclores.saguiped?mibextid=LQQJ4d"><i class="fa-brands fa-facebook px-2"></i></a>
                                        <i class="fa-brands fa-google px-2"></i>
                                    </div>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-9">
                            <img src="/images/gmates/arlan.png" class="img-fluid rounded-start" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- THIRD ROW -->
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center align-items-center">
                <div class="card mb-5" style="width: 80%; height: auto;">
                    <div class="row g-0">
                        <div class="col-lg-3 col-md-12">
                            <img src="/images/gmates/jade.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="card-body" style="border-left: 2px solid black">
                                <h5 class="card-title">
                                   Jade Aaron Catindig
                                </h5>
                                <p class="card-text">
                                    As an Designer i contribute to team by creating a design and layout, also helping to document every detailed descriptions of processes, projects, or information.
                                </p>
                                <p class="card-text">
                                    <div class="div">
                                    <a href="https://www.facebook.com/Jadeaaron14.catindig?mibextid=LQQJ4d"><i class="fa-brands fa-facebook px-2"></i></a>
                                    <i class="fa-brands fa-google px-2"></i>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- FOURTH ROW -->
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center align-items-center">
                <div class="card mb-5">
                    <div class="row g-0">
                        <div class="col-lg-9 col-md-12">
                            <div class="card-body" style="border-right: 2px solid black">
                                <h5 class="card-title">
                                    Lovely Saguiped
                                </h5>
                                <p class="card-text">
                                    As an Documentator is having a strong observational skills, attention to detail, and the ability to convey complex information clearly and accurately, through written reports.
                                </p>
                                <p class="card-text">
                                    <div class="div">
                                        <a href="https://www.facebook.com/lovelyclores.saguiped?mibextid=LQQJ4d"><i class="fa-brands fa-facebook px-2"></i></a>
                                        <i class="fa-brands fa-google px-2"></i>
                                    </div>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <img src="/images/gmates/lovely.png" class="img-fluid rounded-start" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
    </div>
</body>
    <?php include 'admin/pages/footer.php'?>
</html>