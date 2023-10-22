<?php

// $cookie_name = "user_id";
// $cookie_value = "user1";
// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

require_once 'includess/db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebApp</title>
    <link rel="stylesheet" href="./stylesheets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
        <div class="container">
            <a href="#" class="navbar-brand"><img src=".\img\logoo.svg" alt="logo" class="img-fluid">WebApp</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="Courses.php" class="nav-link">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Instructors" class="nav-link">Our Team</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Questions" class="nav-link">FAQ's</a>
                    </li>

                    <?php
                        if (!isset($_COOKIE['user_id'])) {
                        // User is not logged in, display login and register links
                         echo '<li class="nav-item">
                                <a href="Registration.php" class="nav-link">Register</a>
                                    </li>';
                        echo '<li class="nav-item">
                             <a href="login.php" class="nav-link">Login</a>
                                </li>';

                            }
                         else {
                         // User is logged in, display logout link
                         echo '<li class="nav-item">
                        <a href="mycourse.php" class="nav-link">My Courses</a>
                           </li>';
                         echo '<li class="nav-item">
                         <a href="logout.php" class="nav-link">Logout</a>
                            </li>';
                        }
                    ?>



                </ul>
            </div>
        </div>

    </nav>

    
    <!-- Search
    <section class="bg-dark text-light p-4">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center">
                <div class="input-group news-input">
                    <input type="email" class="form-control" placeholder="Explore the courses"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </section> -->
    <!-- showcase -->
    <section class="bg-dark text-light p-4 text-center text-sm-start">
        <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div> 
                    <h1>Enhance Your Skills As a </h1>
                    <div class="scroller text-start text-warning h1">
                        <span class="scrolling-text-responsive">Student<br>Developer<br/>Analyst<br/>Founder<br>
                        </span>
                      </div>
                    <p class="lead my-4">We focus on the teaching fundamentals to our students and greatest technologies
                        to prepare for the new advanced technologies and trends
                    </p>
                    <a href="Courses.php"><button class="btn btn-primary btn-lg">Get Courses</button></a>
                    
                </div>
                <img src=".\img\showcase.png" alt="showcase" class="img-fluid w-50 d-none d-sm-block">
            </div>
        </div>
    </section>



    <!-- Courses Slider
    <div id="carouselExampleControls" class="carousel carousel-dark slide mt-5" data-bs-ride="carousel">
        <div class="container p-4">
            <h2 class="courses-heading">Our Courses</h2>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card-wrapper container-sm d-flex  justify-content-around">
                   <a href="CourseDescription.php" class="nav-link"> <div class="card  " style="width: 18rem;">
                    <img src="https://source.unsplash.com/collection/190727/1600x900" class="card-img-top"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-bold">Ultimate Raspberry Pi Course: Learn in the way of creating Prototypes</h5>
                        <p class="card-text font-weight-lighter">Jonas Peter</p>
                        <p class="h6 font-weight-bold">₹ 4,299</p>
                    </div></a>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/collection/190727/1600x900" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Introduction to Robotics: Learn Robotics from Scratch</h5>
                            <p class="card-text font-weight-lighter">James Gosling</p>
                            <p class="h6 font-weight-bold">₹ 9,997</p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/collection/190727/1600x900" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">IIoT: An Introduction to Industrial Automation</h5>
                            <p class="card-text font-weight-lighter">George Robert</p>
                            <p class="h6 font-weight-bold">₹ 3,699</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card-wrapper container-sm d-flex   justify-content-around">
                    <div class="card  " style="width: 18rem;">
                        <img src="https://source.unsplash.com/collection/190727/1600x900" class="card-img-top"
                            alt="...">
                            <a href="CourseDescription.php" class="nav-link"><div class="card-body">
                            <h5 class="card-title">Frontend Master: Create amazing projects with HTML5 and CSS3</h5>
                            <p class="card-text font-weight-lighter">Peter Thiel</p>
                            <p class="h6 font-weight-bold">₹ 3,999</p>
                        </div></a>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/collection/190727/1600x900" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Advanced JavaScript Course: Complete Course from Beginner to Expert</h5>
                            <p class="card-text font-weight-lighter">James Chadwick</p>
                            <p class="h6 font-weight-bold">₹ 7,999</p>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/collection/190727/1600x900" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Java Comple Course: Practical Java from beginner to Advanced</h5>
                            <p class="card-text font-weight-lighter">James Gosling</p>
                            <p class="h6 font-weight-bold">₹ 6,999</p>
                        </div>
                    </div>
                </div>
            </div>
           
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> -->

        <!-- Learn Section -->
        <section class="p-5 bg-light">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md">
                        <img src=".\img\learning.png" alt="fundamentals" class="img-fluid">
                    </div>
                    <div class="col-md">
                        <h2>Enhance your career</h2>
                        <p class="lead">New skills help you to boost your career</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam eaque voluptas magni sint
                            praesentium blanditiis eius mollitia, corporis maxime cum repudiandae eos nulla consequatur
                            itaque minima? Minima commodi adipisci totam?</p>
                        <a href="Courses.php" class="btn btn-primary mt-3">Start Learning</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Courses Instructors  -->
        <section class="p-5">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md">
                        <h2>Become an Instructor</h2>
                        <p class="lead">Create courses and help others to learn</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam eaque voluptas magni sint
                            praesentium blanditiis eius mollitia, corporis maxime cum repudiandae eos nulla consequatur
                            itaque minima? Minima commodi adipisci totam?</p>
                        <a href="Registration.php" class="btn btn-warning mt-3">Register As an Instructor</a>
                    </div>
                    <div class="col-md">
                        <img src=".\img\fundamentals.svg" alt="instructor" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Team -->
        <section class="p-5 bg-primary" id="Instructors">
            <h2 class="text-center text-white">Our Team: Homies Web</h2>
            <p class="lead text-center text-white mb-3">Working towards making Education Reachable</p>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src=".\img\harsh.jpeg" alt="mens"
                                class="rounded-circle mb-3">
                            <h3 class="card-title mb-1">Harsh Kamde</h3>
                            <p class="card-text mb-3">Team Leader</p>
                            <p class="card-text">Currently pursuing B.Tech degree <br> Sagar Institute of Science Technology and Research Ratibad-Campus</p>
                            <a href="#"><i class="bi bi-twitter text-dark text-bold  mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark text-bold  mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark text-bold  mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark text-bold  mx-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src=".\img\joshi.JPG" alt="mens"
                                class="rounded-circle mb-3">
                            <h3 class="card-title mb-1">Harsh Joshi</h3>
                            <p class="card-text mb-3">Team Member</p>
                            <p class="card-text">Currently pursuing B.Tech degree <br> Sagar Institute of Science Technology and Research Ratibad-Campus</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src=".\img\kapil.jpg" alt="mens"
                                class="rounded-circle mb-3">
                            <h3 class="card-title mb-1">Kapil Mahar</h3>
                            <p class="card-text mb-3">Team Member</p>
                            <p class="card-text">Currently pursuing B.Tech degree <br> Sagar Institute of Science Technology and Research Ratibad-Campus</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src=".\img\sourabh.jpg" alt="mens"
                                class="rounded-circle mb-3">
                            <h3 class="card-title mb-1">Sourabh Mishra</h3>
                            <p class="card-text mb-3">Team Member</p>
                            <p class="card-text">Currently pursuing B.Tech degree <br> Sagar Institute of Science Technology and Research Ratibad-Campus</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div>
              <!--  <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src=".\img\ashu.jpeg" alt="mens"
                                class="rounded-circle mb-3">
                            <h3 class="card-title mb-1">Ashu patel</h3>
                            <p class="card-text mb-3">Team Member</p>
                            <p class="card-text">Currently pursuing B.Tech degree <br> Sagar Institute of Science Technology and Research Ratibad-Campus</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div>   -->

                <!-- <div class="col-md-6 col-lg-3">
                    <div class="card bg-light col-lg-12">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="mens"
                                class="rounded-circle mb-3">
                            <h3 class="card-title mb-1">Ashu Patel</h3>
                            <p class="card-text mb-3">Team Member</p>
                            <p class="card-text">Sccusamus alias dolorum
                                dolor rerum magnam ullam autem ea excepturi modi nam dicta deserunt!</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div> -->


            </div>
        </section>

    
     <!-- About Us -->
     <section class="p-5 bg-light" id="about">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md">
                    <img src=".\img\about.png" alt="fundamentals" class="img-fluid">
                </div>
                <div class="col-md">
                    <h2 class="pb-2">About Us</h2>
                    <p class="lead">TrySoft: The leading software company in the India</p>
                    <p>We are the leading software company providing solutions to the businesses. We help businesses to grow and make their digital presence</p>
                    <a href="https://trysoft.tech/" target="_blank" class="btn btn-primary mt-3">Know More</a>
                </div>
            </div>
        </div>
    </section> 

        <!-- Question Accordion -->
        <section class="p-5">
            <div class="container">
                <h2 class="text-center mb-4">Frequently Asked Questions</h2>
                <div class="accordion accordion-flush" id="Questions">
                    <!-- Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Where exactly are you located ?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion
                                body.</div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                                How much does it cost to attend ?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                                body. Let's imagine this being filled with some actual content.</div>
                        </div>
                    </div>
                    
                     <!-- Item 6 -->
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseSix" aria-expanded="false"
                                aria-controls="flush-collapseSix">
                                Classes will be recorded or Live ? 
                            </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                body. Nothing more exciting happening here in terms of content, but just filling up the
                                space to make it look, at least at first glance, a bit more representative of how this
                                would look in a real-world application.</div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFour" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                                Do you help me in finding a job ?
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                body. Nothing more exciting happening here in terms of content, but just filling up the
                                space to make it look, at least at first glance, a bit more representative of how this
                                would look in a real-world application.</div>
                        </div>
                    </div>
                    <!-- Item 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFive" aria-expanded="false"
                                aria-controls="flush-collapseFive">
                                What will be the format of learning ? 
                            </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                body. Nothing more exciting happening here in terms of content, but just filling up the
                                space to make it look, at least at first glance, a bit more representative of how this
                                would look in a real-world application.</div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                                Would I get a certificate ?
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion
                                body.</div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </section>



    <!-- footer -->

        <!-- Footer -->
        <footer class=" bg-dark text-white p-2 position-relative text-center">
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="Courses.php" class="nav-link px-2 text-muted">Courses</a></li>
                <li class="nav-item"><a href="#Instructors" class="nav-link px-2 text-muted">Instructors</a></li>
                <li class="nav-item"><a href="#Questions" class="nav-link px-2 text-muted">FAQ's</a></li>
                <li class="nav-item"><a href="#about" class="nav-link px-2 text-muted">About</a></li>
              </ul>
            <div class="container">
                <p class="lead">Copyright &copy; 2023 WebApp. All rights reserved. </p>
            </div>
        </footer>


        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
</body>

</html>