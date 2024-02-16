<?php
// Start session if it has not been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "nj_wines");

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // The session variable has been initialized and its value is true

    // Get the Order that is associated with the user (Get the order_id)
    $sql = "SELECT id FROM orders WHERE customer_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = mysqli_fetch_assoc($result);
    if ($rows) {
        $order_id = $rows["id"];
        $_SESSION['order_id'] = $order_id;

        // Get the items inside that order
        $sql = "SELECT oi.wine_id, oi.quantity, w.name, w.price, w.image_link, w.wine_range FROM order_items AS oi JOIN wines AS w ON oi.wine_id = w.id WHERE oi.order_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $jsonData = json_encode($rows);
    }



    $stmt->close();
} else {
    // The session variable is not initialized or its value is not true
    header('Location: loginRegister.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="cart.css">
</head>

<body>
    <div class="drawer bg-[#2C3136]">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content block bg-white text-black">
            <div class="w-full navbar bg-base-300 fixed z-50">
                <div class="flex-none lg:hidden text-white">
                    <label for="my-drawer-3" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                            </path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">
                    <img src="../images/logo.png" alt="Niel Joubert Wines" class="max-h-14 my-2">
                </div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="wines.html">Our Wines</a></li>
                        <li><a href="loginRegister.php">Login</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>

            <div class="master-container">
                <div class="form-container cart-container">
                    <div class="cart">
                        <label class="title"></label>
                        <div id="products" class="products">
                            <!-- Put other products here -->
                        </div>
                    </div>
                </div>
                <div class="form-container checkout-container">
                    <div class="checkout">
                        <label class="title">Checkout</label>
                        <div class="details">
                            <div class="subtotal">
                                <h3>Your cart subtotal</h3>
                                <p><span class="rand">R </span><span id="subtotal">0</span></p>
                            </div>
                            <div class="shipping">
                                <h3>Shipping fees</h3>
                                <p><span class="rand">R </span><span id="shipping">0</span></p>
                            </div>
                            <div class="shipping">
                                <h3>VAT (15%)</h3>
                                <p><span class="rand">R </span><span id="vat">0</span></p>
                            </div>
                        </div>
                        <div class="checkout--footer">
                            <h3>Grand Total</h3>
                            <h3><span class="rand">R </span><span id="grandtotal">0</span></h3>
                        </div>
                        <div class="check-btn-container">
                            <button class="checkout-btn" onclick="my_modal_1.showModal()">Checkout</button>
                        </div>
                        <!-- Open the modal using ID.showModal() method -->
                        <dialog id="my_modal_1" class="modal">
                            <form method="dialog" class="modal-box">
                                <h3 class="font-bold text-lg">Hi There!</h3>
                                <p class="py-4">Please note this website was built purely for a research project and is in no way, shape or form associated with Niel Joubert Wines. All information stored in the database of this website will be wiped after my lecturer has concluded the marking stage of my project. <br>
                                    If, instead, you meant to go to the actual Niel Joubert Wines website, I apologize for the inconvenience. Please click on the redirect button to be redirected to the official website.</p>
                                <div class="modal-action">
                                    <button class="btn">Close</button>
                                </div>
                            </form>
                            <a class="btn" href="https://nieljoubert.co.za">Redirect</a>
                        </dialog>
                    </div>
                </div>
            </div>
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
    <script>
        // Assuming you have the JSON data stored in a variable called jsonData
        var jsonData = <?php echo $jsonData; ?>;
        var subtotal = 0;
        var grandtotal = 0;

        function updateTotals() {
            let vat = (subtotal + 150) * 15 / 100;
            let shipping = 0;

            console.log("VAT: ", vat);

            if (subtotal === 0) {
                vat = 0;
                document.getElementById("shipping").innerHTML = 0;
            } else {
                document.getElementById("shipping").innerHTML = 150;
                shipping = 150;
            }

            grandtotal = subtotal + shipping + vat;
            console.log("Grand Total: ", grandtotal);

            let parsedRoundedSub = parseFloat(subtotal.toFixed(2));
            let parsedRoundedGrand = parseFloat(grandtotal.toFixed(2));
            let parsedRoundedVat = parseFloat(vat.toFixed(2));

            console.log("Parsed Rounded Subtotal:", parsedRoundedSub);
            console.log("Parsed Rounded Grand total:", parsedRoundedGrand);
            console.log("Parsed Rounded VAT:", parsedRoundedVat);

            document.getElementById('subtotal').innerHTML = parsedRoundedSub;
            document.getElementById('grandtotal').innerHTML = parsedRoundedGrand;
            document.getElementById('vat').innerHTML = parsedRoundedVat;
        }

        function updateQuantity(wineID, quantity) {
            // Get the necessary data for the update statement
            var orderID = <?php echo $_SESSION['order_id'] ?> // Obtain the order ID;
            var wineID = wineID; // Obtain the wine ID;
            var quantity = quantity; // Obtain the updated quantity;

            // Create a new XHR object
            var xhttp = new XMLHttpRequest();

            // Set up the request
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Request completed successfully
                    console.log(this.responseText);
                }
            };

            // Open the request
            xhttp.open('POST', 'update_quantity.php', true);

            // Set the request headers (if necessary)
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Prepare the data to be sent
            var data = 'orderID=' + orderID + '&wineID=' + wineID + '&quantity=' + quantity;

            // Send the request with the data
            xhttp.send(data);
            console.log("Data:",data)
        }

        if (jsonData.length === 0) {
            // jsonData is empty or contains no rows
            console.log("No data found.");
            var product = `
    <img src="../images/empty-cart.png" alt="">
  `;
            document.getElementById('products').innerHTML += product;
        } else {
            // jsonData has rows
            console.log("Data found.");
            // Iterate over the JSON data using forEach
            jsonData.forEach(function(item) {
                // Access individual columns
                var wineId = item.wine_id;
                var quantity = parseInt(item.quantity); // Parse quantity as an integer
                var name = item.name;
                var price = parseFloat(item.price); // Parse price as a float
                var imageLink = item.image_link;
                var wineRange = item.wine_range;

                console.log('Quantity:', quantity);
                console.log('Price:', price);

                // Do something with the values
                console.log('Wine ID:', wineId);
                console.log('Quantity:', quantity);
                console.log('Name:', name);
                console.log('Price:', price);
                console.log('Image Link:', imageLink);
                console.log('Wine Range:', wineRange);

                var product = `
      <div class="product" id="${wineId}">
          <div class="name">
              <div class="image">
                  <img src="${imageLink}" alt="" height="30px" width="30px">
              </div>
              <div class="name-inner">
                  <h3>${name}</h3>
                  <p>${wineRange}</p>
              </div>
          </div>
          <div class="amount">
              <button class="btn quan btn-circle btn-outline items-center minusButton">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none" viewBox="0 0 24 24" stroke="#fff">
                      <path class="smaller-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12"></path>
                  </svg>
              </button>
              <p class="quantityText">${quantity}</p>
              <button class="btn quan btn-circle btn-outline items-center plusButton">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none" viewBox="0 0 24 24" stroke="#fff">
                      <path class="smaller-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12M6 12h12"></path>
                  </svg>
              </button>
          </div>
          <div class="pricing">
              <p><span class="rand">R </span>${price}</p>
          </div>
          <div class="pricing flex items-center">
              <button class="btn btn-circle btn-outline items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none" viewBox="0 0 24 24" stroke="#fff"><path class="smaller-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
              </button>
          </div>
      </div>
    `;
                document.getElementById('products').innerHTML += product;
                subtotal += quantity * parseFloat(price);
                console.log("Subtotal: ", subtotal);
            });

            updateTotals(); // Calculate and update totals initially

            // Handle the minus and plus buttons
            const minusButtons = document.querySelectorAll('.minusButton');
            const plusButtons = document.querySelectorAll('.plusButton');

            minusButtons.forEach(function(minusButton) {
                minusButton.addEventListener('click', () => {
                    const quantityElement = minusButton.nextElementSibling;
                    let quantity = parseInt(quantityElement.textContent);
                    console.log("Quantity Inside Minus:", quantity);

                    if (quantity > 6) {
                        quantity -= 6;
                        quantityElement.textContent = quantity.toString();
                        price = parseFloat(minusButton.parentNode.nextElementSibling.querySelector('p').textContent.substring(2));
                        let wineID = minusButton.parentNode.parentNode.id;
                        console.log(wineID);
                        //This is supposed to be price
                        subtotal -= 6 * price;
                        console.log("Subtotal Inside Minus:", subtotal);
                        updateQuantity(wineID, quantity)
                        updateTotals();
                    }
                });
            });

            plusButtons.forEach(function(plusButton) {
                plusButton.addEventListener('click', () => {
                    const quantityElement = plusButton.previousElementSibling;
                    let quantity = parseInt(quantityElement.textContent);
                    console.log("Quantity Inside Plus:", quantity);

                    quantity += 6;
                    quantityElement.textContent = quantity.toString();
                    price = parseFloat(plusButton.parentNode.nextElementSibling.querySelector('p').textContent.substring(2));
                    let wineID = plusButton.parentNode.parentNode.id;
                    console.log(wineID);
                    //This is supposed to be price
                    subtotal += 6 * price;
                    console.log("Subtotal Inside Plus:", subtotal);
                    updateQuantity(wineID, quantity)
                    updateTotals();
                });
            });
        }
    </script>
</body>

</html>