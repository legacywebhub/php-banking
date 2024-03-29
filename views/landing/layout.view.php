<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from iamubaidah.com/html/oitila/live/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Oct 2021 23:49:02 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$context['title']; ?></title>
    <!-- favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='<?=STATIC_ROOT; ?>/landing/img/favicon.png' />
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/bootstrap.min.css">
    <!-- fontawesome icon  -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/fontawesome.min.css">
    <!-- flaticon css -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/fonts/flaticon.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/animate.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/modal-video.min.css">
    <!-- slick css -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/slick.css">
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/slick-theme.css">
    <!-- toastr js -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/toastr.min.css">
    <!-- stylesheet -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/landing/css/responsive.css">
    <!-- inpage styles -->
    <style>
        .newsletter-msg {
            margin: 20px 0px;
            color: #ffffff;
        }
    </style>
</head>

    <body class="homepage-3" onunload=''>

        <div class="notification-alert">
            <div class="notice-list">
                
            </div>
        </div>

        <!-- preloader begin-->
        <div class="preloader">
            <img src="<?=STATIC_ROOT; ?>/landing/img/tenor.gif" alt="">
        </div>
        <!-- preloader end -->

        <div class="mobile-navbar-wrapper">

            <!-- header begin -->
            <div class="header header-style-5" id="header">
                <div class="top">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-3">
                                <div class="welcome-text">
                                    <p>Welcome to <?=ucwords($context['setting']['name']); ?></p>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-9 d-xl-flex d-lg-flex d-block align-items-center">
                                <div class="part-right">
                                    <ul>
                                        <li>
                                            <span class="simple-text">Sever Time : </span>
                                            <div class="server-time">
                                                <div class="single-time clock-time">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">
                                                        <span id="hours"></span>
                                                        <span id="minutes"></span>
                                                        <span id="seconds"></span>
                                                    </span>
                                                </div>
                                                <div class="single-time">
                                                    <span class="icon">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </span>
                                                    <span class="text">
                                                        <span id="date"></span>
                                                        <span id="month"></span>
                                                        <span id="year"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="user-panel">
                                                <span>
                                                    <a href="login" class="login-btn">Login</a>or
                                                </span>
                                                <a href="register" class="register-btn">Register</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bottom">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-xl-3 col-lg-2 d-xl-flex d-lg-flex d-block align-items-center">
                                <div class="row">
                                    <div class="col-4 d-xl-none d-lg-none d-block">
                                        <button class="navbar-toggler" type="button">
                                            <span class="dag"></span>
                                            <span class="dag2"></span>
                                            <span class="dag3"></span>
                                        </button>    
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-8 d-xl-block d-lg-block d-flex align-items-center justify-content-end">
                                        <div class="logo">
                                            <a href="home">
                                                <img src="<?=STATIC_ROOT; ?>/landing/img/logo.png" width="150px" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-10">
                                <div class="mainmenu">
                                    <div class="d-xl-none d-lg-none d-block">
                                        <!-- <div class="user-profile">
                                            <div class="part-img">
                                                <img src="<?=STATIC_ROOT; ?>/dashboard/img/default_user.png" alt="">
                                            </div>
                                            <div class="user-info">
                                                <span class="user-name">Sadwel Eunton</span>
                                                <span class="user-balance">Bal : $202.25</span>
                                            </div>
                                        </div> -->
                                    </div>
                                    <nav class="navbar navbar-expand-lg">              

                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <ul class="navbar-nav ml-auto">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="home">home<span class="sr-only">(current)</span></a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="about">about us<span class="sr-only">(current)</span></a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="loans">Our Loans</a>
                                                </li>

                                                <li class="nav-item dropdown show">
                                                    <a class="nav-link dropdown-toggle" href="#" role="button" id="pagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        pages
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                                                        <a class="dropdown-item" href="faq">Faq</a>
                                                        <a class="dropdown-item" href="privacy-policy">Privacy Policy</a>
                                                        <a class="dropdown-item" href="tac">Terms & Conditions</a>
                                                    </div>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="contact">Contact</a>
                                                </li>

                                                <li class="nav-item join-now-btn">
                                                    <a class="nav-link" href="register">Join Now</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header end -->

            <!-- Content Goes Here -->
            <?php require("$name.view.php"); ?>
            <!-- End Content -->

             <!-- footer begin -->
             <div class="footer">
                <div class="footer-top">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
                                <div class="about-widget">
                                    <a href="home" class="logo">
                                        <img src="<?=STATIC_ROOT; ?>/landing/img/logo.png" alt="">
                                    </a>
                                    <p>Where business meets family</p>
                                    <div class="social-links">
                                        <ul>
                                            <li>
                                                <a href="#0" class="single-link">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#0" class="single-link">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#0" class="single-link">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#0" class="single-link">
                                                    <i class="fab fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-10">
                                <div class="link-widget">
                                    <h4 class="title">
                                        Useful links
                                    </h4>
                                    <ul>
                                        <li>
                                            <a href="about" class="single-link">
                                                About Us
                                            </a>
                                        </li>
                                        <li>
                                            <a href="loans" class="single-link">
                                                Our Loans
                                            </a>
                                        </li>
                                        <li>
                                            <a href="faq" class="single-link">
                                                FAQ
                                            </a>
                                        </li>
                                        <li>
                                            <a href="privacy-policy" class="single-link">
                                                Privacy Policy
                                            </a>
                                        </li>
                                        <li>
                                            <a href="tac" class="single-link">
                                                Terms & Conditions
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-10">
                                <div class="newsletter-widget">
                                    <h4 class="title">
                                        Subscribe To Our Newsletter
                                    </h4>
                                    <form class="newsletter-form" method="post">
                                        <input type="email" maxlength="60" placeholder="Enter Your Mail Address" required>
                                        <p class="newsletter-msg"></p>
                                        <button class="def-btn def-big">
                                            <span class="btn-text">Subscribe</span>
                                        </button>
                                    </form>
                                    <p>Stay in the loop on the latest finance tips, product updates, and exclusive offers. Subscribe to our newsletter today!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-area">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-8">
                                <p>Copyright © <a href="home"><?=ucwords($context['setting']['name']); ?></a> - 2020. All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer end -->
            
        </div> <!-- mobile navbar wrapper end -->

        <div class="d-xl-none d-lg-none d-block">
            <div class="mobile-navigation-bar">
                <ul>
                    <li>
                        <a href="#0">
                            <img src="<?=STATIC_ROOT; ?>/landing/img/svg/profile.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <img src="<?=STATIC_ROOT; ?>/landing/img/svg/money-transfering.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <img src="<?=STATIC_ROOT; ?>/landing/img/svg/calculator.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#header">
                            <img src="<?=STATIC_ROOT; ?>/landing/img/svg/arrow.svg" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="d-xl-block d-lg-block d-none">
            <div class="back-to-top-btn">
                <a href="#">
                    <img src="<?=STATIC_ROOT; ?>/landing/img/svg/arrow.svg" alt="">
                </a>
            </div>
        </div>
     
        <!-- jquery -->
        <script src="<?=STATIC_ROOT; ?>/landing/js/jquery.js"></script>
        <!-- popper js -->
        <script src="<?=STATIC_ROOT; ?>/landing/js/popper.min.js"></script>
        <!-- bootstrap -->
        <script src="<?=STATIC_ROOT; ?>/landing/js/bootstrap.min.js"></script>
        <!-- Sweet Alert -->
        <script src="<?=STATIC_ROOT; ?>/dashboard/bundles/sweetalert/sweetalert.min.js"></script>
        <!-- modal video js -->
        <script src="<?=STATIC_ROOT; ?>/landing/js/jquery-modal-video.min.js"></script>
        <!-- slick js -->
        <script src="<?=STATIC_ROOT; ?>/landing/js/slick.min.js"></script>
        <!-- toastr js -->
        <script src="<?=STATIC_ROOT; ?>/landing/js/toastr.min.js"></script>
        <!-- clock js -->
        <script src="<?=STATIC_ROOT; ?>/landing/js/clock.min.js"></script>
        <!-- investment profit calculator-->
        <script src="<?=STATIC_ROOT; ?>/landing/js/investment-profit-calculator.js"></script>
        <!-- main -->
        <script src="<?=STATIC_ROOT; ?>/landing/js/main.js"></script>
        <!-- InPage Js -->
        <script>
            let newsLetterForm = document.querySelector('.newsletter-form'),
            newsletterMsg = newsLetterForm.querySelector('.newsletter-msg'),
            newsLetterBtn = newsLetterForm.querySelector('.def-btn'),
            btnText = newsLetterBtn.querySelector('.btn-text');

            newsLetterForm.addEventListener('submit', (e)=> {
                e.preventDefault();

                // Loading animation
                btnText.innerHTML = `...<img width='20px' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
                newsLetterBtn.disabled = true;

                setTimeout(()=>{
                    newsLetterForm.reset();
                    btnText.innerHTML = `Subscribe`;
                    newsLetterBtn.disabled = false;
                    displayMessageElement(newsletterMsg, "success", "Subscribed successfully")
                }, 2000);
            })
        </script>

        <script>
        function displayMessageElement(element, messageType, message = "") {
            // Get all the classes of the element
            let classes = element.className.split(" ");

            // Filter out classes that start with 'text-'
            classes = classes.filter(c => !c.startsWith('text-'));

            // Join the filtered classes back and add the new class
            element.className = classes.join(" ") + " " + `text-${messageType}`;

            // Adding message to element
            element.innerText = message;

            setTimeout(()=>{
                // Hide message element after given time
                element.innerText = "";
            }, 10000); 

            // Example usage: Assuming you have an element with the id 'message'
            // displayMessageElement(document.getElementById('message'), 'success', 'Hello world');
        }
        </script>

        <script>
        // This functions enforce input fields to only accept number keystrokes
        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
                return false; 
            } else {
                return true;
            }
            // use onkeypress="return onlyNumberKey(event)" on the input field
        }
        </script>

        <script>
        // This functions enforce input fields to only accept alphabet keystrokes
        function onlyAlphabeticalKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            if ((ASCIICode >= 65 && ASCIICode <= 90) || (ASCIICode >= 97 && ASCIICode <= 122)) {
                return true; // Allow alphabetical characters
            } else {
                return false; // Block other characters
            }
            // Use onkeypress="return onlyAlphabeticalKey(event)" on the input field
        }
        </script>

        <!-- Security js-->
        <script>
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
        </script>

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/660538851ec1082f04dc5bf1/1hq269ji1';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    </body>


<!-- Mirrored from iamubaidah.com/html/oitila/live/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Oct 2021 23:51:04 GMT -->
</html>

