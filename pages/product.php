<?php
session_start();

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$year = $_SESSION['year'];
$flavours = $_SESSION['flavours'];
$details = $_SESSION['details'];
$price = $_SESSION['price'];
$amount = $_SESSION['amount'];
$image_link = $_SESSION['image_link'];
$wine_range = $_SESSION['wine_range'];

if (isset($_POST['addToCart'])) {
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niel Joubert Wines</title>
    <link rel="icon" type="image/png" href="../images/logo-min.png">
    <link rel="stylesheet" href="../css/styles.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="productDetails.css">
</head>

<body>
    <div class="drawer bg-[#2C3136]">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col bg-white">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-300 fixed z-50">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">
                    <img src="../images/logo.png" alt="Niel Joubert Wines" class="max-h-14 my-2">
                </div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <!-- Navbar menu content here -->
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="wines.html">Our Wines</a></li>
                        <li><a href="loginRegister.php">Login</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page content here -->
            <div class="hero h-screen bg-cover bg-center" style="background-image: url(../images/redwine.jpg);">
                <!-- Start -->
                <div class="main-bg">
                    <!-- Start-Sections -->
                    <div class="sections">
                        <!-- Left-Section -->
                        <div class="left-section">
                            <div class="contain">
                                <div class="logo_image">
                                    <img class="logo" src="../images/logo-min.png">
                                </div>
                                <div class="wine_image">
                                    <img src="<?php echo $image_link; ?>" alt="" width="100%" height="100%">
                                </div>
                            </div>
                        </div>
                        <!-- right-Section -->
                        <div class="right-section">
                            <div class="darken">
                                <div class="Text">
                                    <div class="contain_wine">
                                        <div class="wine_price">
                                            <div class="but-buy">
                                                <p class="price">R<?php echo $price; ?></p>
                                            </div>
                                        </div>
                                        <div class="wine_buy">
                                            <div class="but-buy">
                                                <div class="button">
                                                    <p onclick="addToCart()">Add to cart</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wine_details">
                                            <p class="details">
                                                <?php echo $details; ?>
                                            </p>
                                            <dialog id="my_modal_3" class="modal bg-white">
                                                <form method="dialog" class="modal-box text-black">
                                                    <div class="w-full flex align-center">
                                                        <h3 class="font-cg text-4xl text-[#CDAE6A]"><?php echo $name; ?></h3>
                                                        <div class="flex-grow"></div>
                                                        <button for="my-modal-3" class="x-button btn-sm btn-circle btn-ghost">✕</button>
                                                    </div>
                                                    <h3 class="font-cg text-3xl text-[#CDAE6A]"><?php echo $wine_range; ?></h3>
                                                    <p class="py-4 font-cg">
                                                        <?php echo $details; ?>
                                                    </p>
                                                </form>
                                            </dialog>
                                            <button class="read-more read-more-trigger themeA" onclick="my_modal_3.showModal()">
                                                Read More
                                            </button>
                                        </div>
                                        <div class="wine_name">
                                            <h1><?php echo $name; ?></h1>
                                        </div>
                                        <div class="wine_range">
                                            <h2><?php echo $wine_range; ?></h2>
                                        </div>
                                        <div class="wine_flavours">
                                            <p class="flavours"><?php echo $flavours; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mobile-info">
                    <h1><?php echo $name; ?></h1>
                    <h2><?php echo $wine_range; ?></h2>
                    <p class="flavours"><?php echo $flavours; ?></p>
                    <p class="details-mobile">
                        <?php echo $details; ?>
                    </p>
                    <div class="but-buy">
                        <p class="price-mobile">R<?php echo $price; ?></p>
                    </div>
                    <div class="but-buy">
                        <div class="button-mobile">
                            <p onclick="addToCart()">Add to cart</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <footer id="contact" class="footer footer-center relative p-10 bg-white text-black bg-footer-background bg-cover bg-center">
                <div class="absolute inset-0 bg-white opacity-75 -z-1"></div>
                <div class="relative z-10">
                    <div>
                        <h2 class="font-cg text-4xl">Get In Touch</h2>
                        <p class="p-1 font-nunito text-sm">Every bottle filled with pride for your enjoyment</p>
                        <p class="m-4">
                            Klein Simonsvlei Farm
                            Klapmuts – Simondium Road, Klapmuts, 7625
                            Western Cape, South Africa
                        </p>
                        <div class="tooltip tooltip-right" data-tip="Click to Copy">
                            <a href="#" class="text-[#CDAE6A] block" onclick="copyNumber()">+27(0)21 875 5419</a>
                        </div>
                        <a href="mailto:wine@nieljoubert.co.za" class="text-[#CDAE6A] block">wine@nieljoubert.co.za</a>
                    </div>
                    <div class="grid grid-flow-col gap-4">
                        <!-- The links in the footer -->
                        <a class="link link-underline" href="about-us.html">About us</a>
                    </div>
                    <div>
                        <p>Copyright © 2023 - Created by Mathys Basson</p>
                    </div>
                </div>
            </footer>
        </div>

        <div class="drawer-side">
            <label for="my-drawer-3" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 bg-base-100">
                <!-- Sidebar content here -->
                <li><a href="index.html">Home</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="wines.html">Our Wines</a></li>
                <li><a href="loginRegister.php">Login</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>

        </div>

    </div>

    <script src="script.js"></script>
</body>

</html>