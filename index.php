<?php
session_start();
echo "Welcome ".$_SESSION['user_name'];
$User_Profile = $_SESSION['user_name'];
if($User_Profile == true){
}
else{
    header('location:index3.html');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Crystal Saloon</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <script src="script.js" defer></script>

    <script src="index.js"></script>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- ... your other head content ... -->

    </head>

<body>
    <!-- ... your other body content ... -->
    <div id="popup" class="popup">
        <p id="popup-message"></p>
    </div>
</body>

</html>

</head>

<body style="background-color:azure;">

    <header id="top-nav">
        <ul>
            <!-- <li><a href="adminLogin.php">ADMIN</a></li> -->
            <li><a href="contact.html">Contact</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="#about">About us </a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        
    </header>
    

    <div class="imgtxt">
        <img src="Screenshot 2023-08-14 170809 (3).png" alt="" class="logo">
        <p id="p">Our Saloon is a virtual salon which is a web-based
            platform that offers a range of beauty and grooming services
            to customers through the internet. our online salon provides
            convenience and accessibility by allowing clients to book appointments,
            receive beauty treatments,
            without physically visiting a physical location.</p>
    </div>
    <br>

    <div>
        <h1>Book Your Appointment <span></span></h1>
    </div>
    <br>


    <div class="appointment-container">

        <button id="show-form-button">Book Now</button>
        <br>
        <br>
        <form id="appointment-form" class="hidden" action="#">

            <select id="State" name="state" required>
                <option value="" disabled selected>Select State</option>
                <option value="Maharashtra">Maharashtra</option>
            </select>

            <input type="text" id="name" name="name" placeholder="Name" pattern="[A-Za-z ]+" required>
            <input type="email" id="email" name="email" placeholder="Email" title="please enter a valid and correct a email." required>
            <input type="tel" id="Number" name="number" placeholder="Number" pattern="[6-9]{1}[0-9]{9}" title="please enter a valid 10-digit phone number." required>

            <select id="City" name="city" required>
                <option value="" disabled selected>Select City</option>
                <option value="Kalyan">Kalyan</option>
            </select>

            <select id="service" name="service" required>
                <option value="" disabled selected>Select Service</option>
                <option value="Haircut">Haircut</option>
                <option value="Shaving">Shaving</option>
                <option value="Face Massage">Face Massage</option>
            </select>

            <input type="date" id="date" name="date" required>
            <button type="submit" value="register" name="register">Book Now</button>
            <br>

            <p><a href="cancel_appointment.html" style="text-decoration: none; font-weight: solid;">Having any issues... cancel the appointment</a></p>

        </form>
        <div id="confirmation-container" class="hidden"></div>
    </div>
    <br>
    <div class="container">
        <h2><u>Our Services</u></h2>

        <div class="services">
            <div class="service">
                <img src="d09729dec12f60ed29f651a7639cee41.jpg" alt="Haircut">
                <h3>Haircuts</h3>
                <p>Expert haircuts for all styles.</p>
            </div>
            <div class="service">
                <img src="pexels-thgusstavo-santana-2521978 (1).jpg" alt="Nails">
                <h3>Shaving</h3>
                <p>we have trending shaving styles</p>
            </div>
            <div class="service">
                <img src="Facial-Massage.jpg" alt="Styling">
                <h3>Facial Massage</h3>
                <p>Trending Styles.</p>
            </div>
        </div>
    </div>
    <br>
    <div class="inventory-section">
        <h2>Our Quality Products</h2>
        <div class="inventory-content">
            <p>We take pride in using the best products available to deliver top-quality services to our customers. Our commitment to excellence extends to the products we use, ensuring that you receive the best results for your beauty and grooming needs.</p>
            <p>From premium haircare products to luxurious skincare items, every product in our inventory is carefully selected to enhance your experience at CrystalSaloon.</p>
        </div>
        <div class="inventory-images">
            <img src="pexels-mídia-897271.jpg" alt="Premium Haircare Products">
            <img src="ls.jpg" alt="Luxurious Skincare Items">
        </div>
        <br>
        
    <footer>
        <div class="about-us-section" id="about">
            <h2 style="text-align: center;"> About Us</h2>
            <Br></Br>
            <div class="about-content">
                <img src="0Y9A7215-1200x800.webp" alt="Salon Image">
                <div class="about-details">
                    <h3>CrystalSaloon</h3>
                    <p>421301 opposite to MahavirJain school Thankar pada kalyan(W)</p>
                    <p>Phone: +91 9867464545</p>
                    <p>Email: Crystalsaloon45@gmail.com</p>
                    <p>Discover the ultimate beauty experience at CrystalSaloon.
                        We're dedicated to providing you with the best beauty and grooming services
                        through our innovative online platform.
                        Book an appointment today and experience luxury from the comfort of your home.</p>
                </div>
            </div>
        </div>

    </footer>

    <script>
    const appointmentForm = document.getElementById('appointment-form');
    const dateField = document.getElementById('date');

    const currentDate = new Date();
    currentDate.setDate(currentDate.getDate() + 1); 
    const maxDate = new Date();
    maxDate.setDate(currentDate.getDate() + 9); 

    const minDate = currentDate.toISOString().split('T')[0];
    const maxDateStr = maxDate.toISOString().split('T')[0];

    console.log(minDate);
    console.log(maxDateStr);

    dateField.setAttribute('min', minDate);
    dateField.setAttribute('max', maxDateStr);

    appointmentForm.onsubmit = (e) => {
        e.preventDefault();

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend/appointment.php');

        xhr.onload = () => {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    let data = xhr.response;
                    console.log(data);
                }
            }
        }

        const formData = new FormData(e.target);
        console.log(formData);
        xhr.send(formData);
    }
</script>



</body>

</html>

