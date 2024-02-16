const animatedImage = document.getElementById('animated-image');

const observer = new IntersectionObserver(entries => {
    const image = document.getElementById('animated-image');
    entries.forEach(entry => {

        if (entry.isIntersecting) {
            image.classList.add('animate-fly-in-from-right');
            return; // if we added the class, exit the function
        }

        // We're not intersecting, so remove the class!
        image.classList.remove('animate-fly-in-from-right');
    });
});

observer.observe(animatedImage);

function copyNumber() {
    navigator.clipboard.writeText("+27(0)21 875 5419");
}


// Function to fetch data from the PHP function
function fetchData(productID) {
    console.log("Fetching data");
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById("test").innerHTML = this.responseText;
    }
    xhttp.open("GET", "productData.php?q=" + productID);
    xhttp.send();
}

function addToCart() {
    console.log("Adding to Cart");
    window.open('addToCart.php', '_self');
}