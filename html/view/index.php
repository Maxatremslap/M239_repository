<?php
session_start();

// Database connection parameters
$host   = 'localhost';
$dbname = 'furnitureshop_db';
$dbUser = 'sadmin';
$dbPass = 'Sadminpassword1!';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    die('Database Connection Error: ' . $exception->getMessage());
}

// Retrieve featured products from the "products" table (limit to 6 for featured section)
$sql = "SELECT * FROM products ORDER BY id ASC LIMIT 6";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$featuredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getSafeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Helper function to format CHF currency with apostrophe as thousands separator
function formatCHF($amount) {
    return number_format($amount, 2, '.', '\'');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Max's Möbel - Quality furniture for your home">
    <meta name="author" content="Max Laemmler">
    <link rel="icon" href="../assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Max's Möbel</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

    <style>
        .chat-widget-button {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            border-radius: 50%;
            color: white;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 1000;
        }
        .chat-widget-button svg {
            width: 32px;
            height: 32px;
        }
        .chat-widget-window {
            display: none;
            position: fixed;
            bottom: 100px;
            right: 25px;
            width: 350px;
            height: 450px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            flex-direction: column;
            z-index: 1000;
            border: 1px solid #eee;
        }
        .chat-widget-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-weight: bold;
        }
        .chat-widget-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
        }
        .chat-widget-input {
            display: flex;
            border-top: 1px solid #eee;
        }
        .chat-widget-input input {
            flex-grow: 1;
            border: none;
            padding: 15px;
            outline: none;
        }
        .chat-widget-input button {
            border: none;
            background-color: #007bff;
            color: white;
            padding: 0 20px;
            cursor: pointer;
        }
        .chat-message {
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 18px;
            margin-bottom: 8px;
            word-wrap: break-word;
        }
        .chat-message.user {
            background-color: #007bff;
            color: white;
            align-self: flex-end;
        }
        .chat-message.admin {
            background-color: #e9e9eb;
            color: #333;
            align-self: flex-start;
        }
        .chat-message strong {
            font-weight: bold;
            display: block;
            margin-bottom: 2px;
            font-size: 0.8em;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php"><h2>Max's Möbel <em>Store</em></h2></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <!-- Standard Navigation Items -->
                        <li class="nav-item active">
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
                        <li class="nav-item">
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

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
            <div class="banner-item-01">
                <div class="text-content">
                    <h4>Find your dream furniture today!</h4>
                    <h2>Transform your living space</h2>
                </div>
            </div>
            <div class="banner-item-02">
                <div class="text-content">
                    <h4>Quality Craftsmanship</h4>
                    <h2>Elegant designs for modern homes</h2>
                </div>
            </div>
            <div class="banner-item-03">
                <div class="text-content">
                    <h4>Special Offers</h4>
                    <h2>Affordable luxury for every budget</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Featured Products</h2>
                        <a href="products.php">view more <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                
                <?php foreach ($featuredProducts as $product): ?>
                <div class="col-md-4">
                    <div class="product-item">
                        <a href="product-details.php?id=<?php echo getSafeInput($product['id']); ?>">
                            <img src="../assets/images/product-<?php echo getSafeInput($product['id']); ?>-370x270.jpg" alt="<?php echo getSafeInput($product['name']); ?>">
                        </a>
                        <div class="down-content">
                            <a href="product-details.php?id=<?php echo getSafeInput($product['id']); ?>">
                                <h4><?php echo getSafeInput($product['name']); ?></h4>
                            </a>
                            <h6>
                                <small><del>CHF <?php echo formatCHF($product['price'] * 1.25); ?></del></small>
                                CHF <?php echo formatCHF($product['price']); ?>
                            </h6>
                            <p><?php echo getSafeInput($product['description']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>

    <div class="best-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>About Us</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="left-content">
                        <p>At Max's Möbel, we believe that <a href="#">beautiful furniture</a> should be accessible to everyone. We've been crafting and curating quality pieces since 2005, focusing on <a href="#">sustainable materials</a> and timeless designs that make your home feel special.</p>
                        <ul class="featured-list">
                            <li><a href="#">Handcrafted quality furniture</a></li>
                            <li><a href="#">Eco-friendly materials and processes</a></li>
                            <li><a href="#">Custom sizing and design options</a></li>
                            <li><a href="#">Swiss craftsmanship guarantee</a></li>
                        </ul>
                        <a href="about-us.php" class="filled-button">Read More</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-image">
                        <img src="../assets/images/about-1-570x350.jpg" alt="Our workshop">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="services" style="background-image: url(../assets/images/other-image-fullscren-1-1920x900.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Latest blog posts</h2>
                        <a href="blog.php">read more <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <a href="#" class="services-item-image">
                            <img src="../assets/images/blog-1-370x270.jpg" class="img-fluid" alt="">
                        </a>
                        <div class="down-content">
                            <h4><a href="#">How to choose the perfect dining table for your space</a></h4>
                            <p style="margin: 0;">Max Laemmler&nbsp;&nbsp;|&nbsp;&nbsp;15/04/2025 10:30&nbsp;&nbsp;|&nbsp;&nbsp;124</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <a href="#" class="services-item-image">
                            <img src="../assets/images/blog-2-370x270.jpg" class="img-fluid" alt="">
                        </a>
                        <div class="down-content">
                            <h4><a href="#">5 interior design trends for summer 2025</a></h4>
                            <p style="margin: 0;">Sarah Miller&nbsp;&nbsp;|&nbsp;&nbsp;10/04/2025 14:45&nbsp;&nbsp;|&nbsp;&nbsp;96</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <a href="#" class="services-item-image">
                            <img src="../assets/images/blog-3-370x270.jpg" class="img-fluid" alt="">
                        </a>
                        <div class="down-content">
                            <h4><a href="#">Sustainable furniture: Why it matters for your home</a></h4>
                            <p style="margin: 0;">Thomas Huber&nbsp;&nbsp;|&nbsp;&nbsp;05/04/2025 09:15&nbsp;&nbsp;|&nbsp;&nbsp;78</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="happy-clients">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Happy Clients</h2>
                        <a href="testimonials.php">read more <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-clients owl-carousel text-center">
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="down-content">
                                <h4>Emma Schmidt</h4>
                                <p class="n-m"><em>"The dining set we purchased is absolutely stunning! The quality is exceptional and it arrived earlier than expected. Max's team was professional from start to finish."</em></p>
                            </div>
                        </div>
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="down-content">
                                <h4>Daniel Berger</h4>
                                <p class="n-m"><em>"We ordered a custom sofa and couldn't be happier with the result. The attention to detail and craftsmanship makes Max's Möbel stand out from other furniture stores."</em></p>
                            </div>
                        </div>
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="down-content">
                                <h4>Laura Müller</h4>
                                <p class="n-m"><em>"The bedroom set transformed our master bedroom. The sustainable materials were important to us, and Max's team went above and beyond to meet our needs."</em></p>
                            </div>
                        </div>
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="down-content">
                                <h4>Martin Weber</h4>
                                <p class="n-m"><em>"I've furnished my entire apartment with pieces from Max's Möbel. The quality is consistent, and the designs are timeless. Worth every franc!"</em></p>
                            </div>
                        </div>
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="down-content">
                                <h4>Sofia Klein</h4>
                                <p class="n-m"><em>"The customer service is as impressive as the furniture. They helped me choose pieces that worked perfectly in my small apartment. I'll definitely be back!"</em></p>
                            </div>
                        </div>
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="down-content">
                                <h4>Lukas Fischer</h4>
                                <p class="n-m"><em>"As an interior designer, I regularly recommend Max's Möbel to my clients. The craftsmanship is exceptional and the designs complement various styles."</em></p>
                            </div>
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
                                <h4>Transform your home with quality furniture.</h4>
                                <p>Visit our showroom or browse online to discover our full collection of handcrafted furniture for every room in your home.</p>
                            </div>
                            <div class="col-lg-4 col-md-6 text-right">
                                <a href="contact.php" class="filled-button">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Starts -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <p>Copyright &copy; 2025 Max's Möbel - Design: <a rel="nofollow noopener" href="https://www.templateflip.com" target="_blank">TemplateFlip</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Ends -->

    <?php if(isset($_SESSION['username'])): ?>
    <!-- Chat Widget Button -->
    <button class="chat-widget-button" id="chat-toggle-button">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
            <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </svg>
    </button>

    <!-- Chat Widget Window -->
    <div class="chat-widget-window" id="chat-widget">
        <div class="chat-widget-header">Live Chat Support</div>
        <div class="chat-widget-messages" id="chat-messages">
            <!-- Messages will be loaded here -->
        </div>
        <div class="chat-widget-input">
            <input type="text" id="chat-input" placeholder="Type your message...">
            <button id="chat-send-button">Send</button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/owl.js"></script>

    <?php if(isset($_SESSION['username'])): ?>
    <script>
        $(document).ready(function() {
            const chatWidget = $('#chat-widget');
            const chatToggleButton = $('#chat-toggle-button');
            const chatMessages = $('#chat-messages');
            const chatInput = $('#chat-input');
            const chatSendButton = $('#chat-send-button');

            let lastMessageId = 0;
            let pollingInterval;

            function fetchMessages() {
                $.ajax({
                    url: '../controller/chat_handler.php',
                    type: 'GET',
                    data: { action: 'fetch', last_id: lastMessageId },
                    dataType: 'json',
                    success: function(messages) {
                        if (messages.length > 0) {
                            messages.forEach(function(msg) {
                                const messageClass = msg.sender.toLowerCase() === 'admin' ? 'admin' : 'user';
                                const messageElement = $(
                                    '<div class="chat-message ' + messageClass + '">' +
                                        '<strong>' + $('<div />').text(msg.sender).html() + '</strong>' +
                                        $('<div />').text(msg.message).html() +
                                    '</div>'
                                );
                                chatMessages.append(messageElement);
                                lastMessageId = msg.id;
                            });
                            // Scroll to the bottom
                            chatMessages.scrollTop(chatMessages[0].scrollHeight);
                        }
                    },
                    error: function() {
                        console.error('Failed to fetch chat messages.');
                    }
                });
            }

            function sendMessage() {
                const message = chatInput.val().trim();
                if (message === '') {
                    return;
                }

                $.ajax({
                    url: '../controller/chat_handler.php',
                    type: 'POST',
                    data: { action: 'send', message: message },
                    success: function() {
                        chatInput.val('');
                        fetchMessages(); // Fetch immediately after sending
                    },
                    error: function() {
                        console.error('Failed to send message.');
                    }
                });
            }

            chatToggleButton.on('click', function() {
                const isVisible = chatWidget.is(':visible');
                chatWidget.css('display', isVisible ? 'none' : 'flex');
                
                if (!isVisible) {
                    lastMessageId = 0; // Reset on open to get full history
                    chatMessages.html(''); // Clear previous messages
                    fetchMessages();
                    pollingInterval = setInterval(fetchMessages, 3000); // Poll every 3 seconds
                } else {
                    clearInterval(pollingInterval);
                }
            });

            chatSendButton.on('click', sendMessage);

            chatInput.on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    sendMessage();
                }
            });
        });
    </script>
    <?php endif; ?>

  </body>
</html>