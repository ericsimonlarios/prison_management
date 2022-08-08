<?php
include "nav.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="latest_news.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <img src="background-image.jpg" class="img-fluid shadow-sm mb-3 bg-white rounded" alt="Responsive image" style="width: 100%; height: 45vh;">
    </div>
    <br>
    <div class="container-fluid">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-8">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger">News</button>
                    </div>
                    <div class="container-fluid m-0 p-0">

                        <!-- navbar -->
                        <div>
                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                <div class="container-fluid">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="#genral" id="genral">General</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="#business" id="business">Business</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#sports" id="sport">Sports</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="#tehnology" id="technology">Technology</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#entertainment" id="entertainment">Entertainment</a>
                                            </li>
                                        </ul>
                                        <form class="d-flex">
                                            <input class="form-control me-2" type="text" id="newsQuery" placeholder="Search news">
                                            <button class="btn btn-outline-primary" type="button" id="searchBtn">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </nav>
                        </div>

                        <!-- News  -->
                        <div>
                            <div class="row m-3" id="newsType"></div>
                            <div class="row me-2 ms-2" id="newsdetails"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger">Latest News</button>
                        <button type="button" class="btn">Most Viewed</button>
                        <br>
                    </div>
                    <div class="container p-0 m-0   ">
                        <div class="list-group">
                            <a href="https://www.aljazeera.com/news/2022/5/8/why-the-2022-philippines-election-is-so-significant" class="list-group-item list-group-item-action " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1">Why the 2022 Philippines election is so significant</h4>
                                    <small>1 day ago</small>
                                </div>
                                <p class="mb-1">The philippines goes to poll on May 9...</p>
                                <small>ALJAZEERA</small>
                            </a>
                            <a href="https://www.aljazeera.com/news/2022/5/7/our-generations-fight-the-robredo-campaign-to-stop-marcos-jr" class="list-group-item list-group-item-action " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1">‘Our generation’s fight’: Robredo’s campaign to stop Marcos Jr</h4>
                                    <small>2 days ago</small>
                                </div>
                                <p class="mb-1">This is really a good vs evil...</p>
                                <small>ALJAZEERA</small>
                            </a>
                            <a href="https://www.aljazeera.com/news/2022/5/4/leila-de-lima-release-urged-after-witnesses-retract-testimony" class="list-group-item list-group-item-action " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1">Leila de Lima release urged after witnesses retract testimony</h4>
                                    <small>2 days ago</small>
                                </div>
                                <p class="mb-1">Philippine senator and vocal Duterte critic has been imprisoned for five years over drugs charges she denies.</p>
                                <small>ALJAZEERA</small>
                            </a>
                            <a href="https://www.aljazeera.com/news/2022/3/28/us-philippines-kick-off-their-largest-ever-war-games" class="list-group-item list-group-item-action " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1">US, Philippines kick off their largest-ever military drills</h4>
                                    <small>3 days ago</small>
                                </div>
                                <p class="mb-1">Nearly 9,000 Filipino and American soldiers will take part in the 12-day joint military drills, signalling the deepening of ties.</p>
                                <small>ALJAZEERA</small>
                            </a>
                            <a href="https://www.theguardian.com/world/2022/may/14/im-disgusted-readers-in-the-philippines-on-the-2022-election-result" class="list-group-item list-group-item-action " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1">‘I’m disgusted’: readers in the Philippines on the 2022 election result</h4>
                                    <small>5 days ago</small>
                                </div>
                                <p class="mb-1">Seven Filipinos share their views on the victory of Ferdinand ‘Bongbong’ Marcos Jr and the future they see for the country</p>
                                <small>The Guardian</small>
                            </a>
                            <a href="https://news.abs-cbn.com/" class="list-group-item list-group-item-action " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1">Halalan 2022 Philippine Election Results</h4>
                                    <small>7 days ago</small>
                                </div>
                                <p class="mb-1">Voter Counts...</p>
                                <small>ABS CBN</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1">Supermajority, family ties shape new Senate</h4>
                                    <small>9 days ago</small>
                                </div>
                                <p class="mb-1">The Commission on Elections (Comelec) on Wednesday proclaimed the 12 winners...
</p>
                                <small>INQUIRER.NET</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <footer class="text-center text-lg-start bg-light text-muted">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Company name
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Angular</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">React</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Vue</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Laravel</a>
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>
                        <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>
</body>
<script src="latest_news.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>