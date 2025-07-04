<?php session_start(); function getSafeInput($data) { return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8'); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Contact Max's Möbel for custom furniture inquiries, showroom visits, or customer support">
    <meta name="author" content="Max Lämmler">
    <link rel="icon" href="../assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Contact Us - Max's Möbel</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <!-- EmailJS SDK -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            // Initialize EmailJS with your User ID
            emailjs.init("YOUR_USER_ID"); // Replace with your actual EmailJS User ID
        })();
    </script>
</head>
<body>
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php"><h2>Max's Möbel <em>Store</em></h2></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="checkout.php">Checkout</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                        <?php if(isset($_SESSION['username'])): ?>
                            <!-- Greeting for logged in user -->
                            <li class="nav-item">
                                <span class="nav-link" style="pointer-events: none; color: #FFFFFF;">Hello, <?php echo getSafeInput($_SESSION['username']); ?>!</span>
                            </li>
                            <!-- Logout button -->
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-secondary btn-sm" href="../controller/logout.php">Logout</a>
                            </li>
                            <?php if(strtolower($_SESSION['username']) === 'admin'): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin.php">Admin Panel</a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="page-heading contact-heading header-text" style="background-image: url(../assets/images/heading-4-1920x500.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Get in touch with our team</h4>
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="find-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Our Location on Maps</h2>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2701.463987302323!2d8.53255207706644!3d47.383379203364505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47900a0dbefe6253%3A0x588e0183e4f1d537!2sTechnische%20Berufsschule%20Z%C3%BCrich%20TBZ!5e0!3m2!1sde!2sch!4v1743509877844!5m2!1sde!2sch" width="100%" height="330px" style="border:0;" allowfullscreen="" loading="lazy" frameborder="0" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="left-content">
                        <h4>Visit Our Showroom</h4>
                        <p>Our main showroom and workshop is conveniently located in Zürich, where you can see our craftsmanship firsthand and discuss your furniture needs with our design team.<br><br>We're open Monday through Friday from 9:00 to 18:00, and Saturdays from 10:00 to 16:00. Free parking is available for our customers.</p>
                        <ul class="social-icons">
                            <li><a href="Facebook.com"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="X.com"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="instagram.com"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="send-message">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Send us a Message</h2>
                    </div>
                </div>
                <!-- This div will display the response message -->
                <div id="mailMessage"></div>
                <div class="col-md-8">
                    <div class="contact-form">
                        <form id="contact">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="email" class="form-control" id="email" placeholder="E-Mail Address" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="filled-button">Send Message</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="../assets/images/maxImage.jpg" class="img-fluid" alt="max-image">
                    <h5 class="text-center" style="margin-top: 15px;">Max Lämmler</h5>
                    <p class="text-center">Founder & Master Craftsman</p>
                    <p class="text-center"><strong>Email:</strong> laemmler.max@gmail.com<br><strong>Phone:</strong> +41 78 226 76 33</p>
                </div>
            </div>
        </div>
    </div>

    <div class="happy-clients">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Our Services</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-item">
                        <div class="icon">
                            <i class="fa fa-pencil"></i>
                        </div>
                        <div class="down-content">
                            <h4>Custom Design</h4>
                            <p>Work with our designers to create custom furniture pieces tailored to your specific needs and taste.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-item">
                        <div class="icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="down-content">
                            <h4>Delivery & Installation</h4>
                            <p>We offer professional white-glove delivery and installation services throughout Switzerland.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-item">
                        <div class="icon">
                            <i class="fa fa-wrench"></i>
                        </div>
                        <div class="down-content">
                            <h4>Furniture Repair</h4>
                            <p>Our skilled craftsmen can restore and repair your furniture to extend its life and beauty.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Questions or special requirements?</h4>
                                <p>Our team is ready to assist you with any questions about our products or services. Feel free to call us directly at +41 78 226 76 33.</p>
                            </div>
                            <div class="col-lg-4 col-md-6 text-right">
                                <a href="products.php" class="filled-button">Browse Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <p>Copyright &copy; 2025 Max's Furniture</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/owl.js"></script>

    <!-- EmailJS script to handle the contact form submission -->
    <script>
    $(document).ready(function() {
        $("#contact").submit(function(e) {
            e.preventDefault();
            
            // Show loading state
            $("#form-submit").prop("disabled", true).text("Sending...");
            
            // Prepare template parameters
            const templateParams = {
                from_name: $("#name").val(),
                from_email: $("#email").val(),
                subject: $("#subject").val(),
                message: $("#message").val()
            };
            
            // Send email using EmailJS
            emailjs.send("service_y15d61q", "YOUR_TEMPLATE_ID", templateParams)
                .then(function(response) {
                    console.log("SUCCESS!", response.status, response.text);
                    
                    // Show success message
                    const msgHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        'Your message has been sent successfully. We will get back to you soon!' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button></div>';
                    
                    $("#mailMessage").html(msgHtml);
                    
                    // Reset form
                    $("#contact")[0].reset();
                }, function(error) {
                    console.log("FAILED...", error);
                    
                    // Show error message
                    const msgHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Failed to send message. Please try again later.' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button></div>';
                    
                    $("#mailMessage").html(msgHtml);
                })
                .finally(function() {
                    // Reset button state
                    $("#form-submit").prop("disabled", false).text("Send Message");
                });
        });
    });
    </script>
</body>
</html>