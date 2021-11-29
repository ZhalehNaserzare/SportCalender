<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Calender</title>
    <link href="./CSS/style.css" rel="stylesheet"/>
    <script src="./frameworks/jquery/jquery-3.4.1.min.js"></script>
    <script src="./scripts/main-script.js"></script>
    <link rel="stylesheet" href="./frameworks/fancybox/jquery.fancybox.min.css" />
    <script src="./frameworks/fancybox/jquery.fancybox.min.js"></script>
    <link href="./frameworks/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="./frameworks/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0252661607.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="content">
        <?php
        $page = (isset($_GET['page'])) ? $_GET['page'] : 'home';
        switch ($page) {
            case 'Home':
                include_once('pages/home.php');
                break;
            case 'add-event':
                include_once('pages/add-event.php');
                break;
            default:
                echo '<h2 class="display-3 text-center mt-5">404</h2><h1 class="display-4 text-center mt-2">Page not found</h1>';
                break;
        }
        ?>
    </div>
    <footer class="footer font-small" id="footer">
            <div class="container">
                <div class="row text-center text-xs-center text-sm-left text-md-left">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 footer-item">
                        <h6> Social networks </h6>
                            <ul>
                                <li><a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a></li>
                                <li><a href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</a></li>
                                <li><a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</a></li>
                            </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 footer-item">
                        <h6> Kontakt </h6>
                            <ul>
                                <li> Address </li>
                                <li><a href="https://www.sportradar.com/" target="_blank">web presence</a></li>
                                <li><a href="mailto:j.naserzare@gmail.com" target="_blank">Mail</a></li>
                            </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 footer-item">
                        <h6> Terms of use </h6>
                            <ul>
                                <li>Copy right &copy; 2020</li>
                                <li><a href="?page=privacy-policy">Privacy Policy</a></li>
                                <li>Impressum</li>
                            </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 footer-item">
                        <h6> About </h6>
                            <ul> 
                                <li>Sportradar AG</li>
                                <li>Feldlistrasse 2</li>
                                <li>Switzerland</li>
                            </ul>
                    </div>
                </div>
            </div>
    </footer>

</body>
</html>