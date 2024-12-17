@php
    $latestPost = \App\Models\Post::latest()->first();
@endphp

@extends('layout.main')

@section("container")
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="10000">
        <!-- Carousel Indicators -->
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleFade" data-bs-slide-to="2"></li>
            <li data-bs-target="#carouselExampleFade" data-bs-slide-to="3"></li>
        </ol>

        <!-- Carousel Inner -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="gradient-overlay"></div>
                <img class="d-block w-full h-screen"  src="{{ asset('images/Carousel1-Deer.jpg') }}" alt="First slide">
                <div class="carousel-caption text-start">
                    <h1>Life On Land</h1>
                    <p>Discover the beauty of nature and wildlife that surrounds us. Explore the wonders of forests, mountains, and the creatures that call them home.</p>
                    <button class="donate-button">See More!</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="gradient-overlay"></div>
                <img class="d-block w-100" src="{{ asset('images/Carousel2-Bird.jpg') }}" alt="Second slide">
                <div class="carousel-caption text-start">
                    <h1>Be the Change: Join Our Movement</h1>
                    <p>Take an active role in preserving life on land. Participate in our upcoming events and campaigns to make a tangible difference. Together, we can create a greener, sustainable future for all.</p>
                    <button class="donate-button">Join Now!</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="gradient-overlay"></div>
                <img class="d-block w-100" src="{{ asset('images/Giraffes.jpg') }}" alt="Third slide">
                <div class="carousel-caption text-start">
                    <h1>Share Ideas, Inspire Change</h1>
                    <p>Explore stories, insights, and discussions from people passionate about protecting our planet. Share your own ideas and learn from others in our interactive forums and blogs.</p>
                    <button class="donate-button">Explore More!</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="gradient-overlay"></div>
                <img class="d-block w-100" src="{{ asset('images/Tiger.jpg') }}" alt="Fourth slide">
                <div class="carousel-caption text-start">
                    <h1>Support the Cause</h1>
                    <p>Your contribution helps us protect endangered habitats, plant trees, and educate communities about sustainable practices. Every donation, no matter the size, brings us closer to saving life on land.</p>
                    <button class="donate-button">Donate Now!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="ContainerReal">
        <div class="ContentContainer">
            <div class="content-wrapper">
                <img src="images/LifeOnLandSDG.jpg" alt="sdg" class="content-image">
    
                    <div class="content-text">
                    <h1 class="title">What is Life On Land?</h1>
    

                    <p id="shortText" class="content">
                        Life on Land is the focus of Sustainable Development Goal 15 (SDG 15), which aims to protect, restore, and promote the sustainable use of terrestrial ecosystems. It emphasizes the importance of combating deforestation...
                    </p>
    
                    <p id="fullText" class="content" style="display: none;">
                        Life on Land is the focus of Sustainable Development Goal 15 (SDG 15), which aims to protect, restore, and promote the sustainable use of terrestrial ecosystems. It emphasizes the importance of combating deforestation, desertification, and biodiversity loss while ensuring the conservation of forests, mountains, and wetlands. This goal recognizes that healthy ecosystems are vital for human well-being, providing essential resources like food, water, and medicine, while also playing a critical role in climate regulation and supporting countless species. By addressing the challenges of habitat destruction and environmental degradation, SDG 15 seeks to preserve the natural balance necessary for a sustainable future.
                    </p>
    
                    <button id="toggleButton" class="toggle-button">See More</button>
                </div>
            </div>
        </div>
    
        <div class="top-donator-card">
            <h1 class="title">Our Top Donators</h1>
    
            <div class="card-container">
                <div class="card card-2nd">
                    <img src="images/hendro.webp" alt="sdg" class="donate-image">
                    <h1>Hendro</h1>
                    <h3>$200.00</h3>
                    <p>3rd</p>
                </div>
    
                <div class="card card-1st">
                    <img src="images/johndoe.jpg" alt="sdg" class="donate-image">
                    <h1>John Doe</h1>
                    <h3>$450.00</h3>
                    <p>1st</p>
                </div>
    
                <div class="card card-3rd">
                    <img src="images/keke.webp" alt="sdg" class="donate-image">
                    <h1>Keke</h1>
                    <h3>$300.00</h3>
                    <p>2nd</p>
                </div>
            </div>
    
            <button class="donate-button">Donate Now!</button>
        </div>
    </div>


    <div class="VisionMission">
        <div class="mission-section">
            <div class="mission-text">
                <h1>Our Mission</h1>
                <p>We’re on a journey to make the world a better place for future generations. Our mission is simple: protect the planet, preserve its ecosystems, and restore its natural beauty.</p>
                <a href="/about" class="cta-btn">Discover More</a>
            </div>

            <div class="mission-image">
                <img src="images/Together.jpg.jpg" alt="Together for Nature">
            </div>
        </div>

        <div class="SloganSection">
            <h2>Your Impact Starts Here</h2>
            <p>Join us in preserving the planet for future generations.</p>
        </div>

        <section class="section3">
            <h2 class="section-title">Latest Event</h2>

            @if($latestPost)
                <div class="event-wrapper">
                    <div class="event-image">
                        <img src="{{ $latestPost->image && file_exists(public_path('storage/' . $latestPost->image)) 
                                                    ? asset('storage/' . $latestPost->image) 
                                                    : asset('images/default-image.jpg') }}" 
                            alt="Post Image" 
                            class="img-fluid">
                    </div>
                    <div class="event-content">
                        <h3>{{ $latestPost->title }}</h3>
                        <p>By <a href="/authors/{{ $latestPost->user->name }}" style="text-decoration: none; color: black;">{{ $latestPost->user->name }}</a></p>
                        <p><a href="/categories/{{ $latestPost->category->slug }}" class="event-type">Event Type: {{ $latestPost->category->name }}</a></p>
                        <p>Location: {{ $latestPost->location }}</p>
                        <p>{{ $latestPost->created_at->diffForHumans() }}</p>
                        <a href="/posts" class="cta-button">Join Community</a>
                    </div>
                </div>
            @else
                <p class="text-center text-muted">No event available right now.</p>
            @endif
        </section>

        <section class="new-slogan-section">
            <div class="new-slogan-content">
                <h2>Choose Green, Embrace Sustainability</h2>
                <p>Opt for eco-friendly products to protect our planet. Together, we can build a greener, cleaner future for generations to come.</p>
                <a href="/products" class="cta-button">Explore Our Products</a>
            </div>
            <div class="new-slogan-image">
                <img src="images/product5.jpg" alt="Earth Impact" />
            </div>
        </section>
    </div>
    
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const shortText = document.getElementById("shortText");
            const fullText = document.getElementById("fullText");
            const toggleButton = document.getElementById("toggleButton");
    
            toggleButton.addEventListener("click", function () {
                const isShortTextVisible = shortText.style.display !== "none";
    
                // Toggle visibility
                shortText.style.display = isShortTextVisible ? "none" : "block";
                fullText.style.display = isShortTextVisible ? "block" : "none";
    
                // Update button text
                toggleButton.textContent = isShortTextVisible ? "See Less" : "See More";
            });
        });
    </script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body{
        font-family: "Poppins";
    }


    .carousel-item img {
        width: 100%;
        height: 100vh;
        object-fit: cover;
    }

    .gradient-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.5) 90%);
        pointer-events: none; /* Ensures the overlay doesn't interfere with interactions */
        z-index: 1;
    }
    
    .carousel-caption {
        z-index: 2;
        color: #fff;
        left: 10%;
        bottom: 5%;
        width: 50%;
    }

    .carousel-caption h1{
        font-size: 44px;
        font-weight: bold;
    }

    .carousel-caption p{
        font-size: 24px
    }
    
    .ContentContainer {
        max-width: 800px;
        margin: 30px auto;
        padding: 24px;
        background-color:#3eae4a;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

   
    .content-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: center;
    }

    
    .content-image {
        flex: 1 1 300px;
        max-width: 300px;
        border-radius: 8px;
    }

    
    .content-text {
        flex: 2 1 400px;
    }

    
    .content-text .title{
        font-size: 32px;
        font-weight: bold;
        color: white; 
        margin-bottom: 16px;
    }

    
    .content {
        font-size: 14px;
        color: white; 
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .toggle-button {
        display: inline-block;
        padding: 10px 16px;
        background-color: white; 
        color: #3eae4a;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .toggle-button:hover {
        background-color: #3eae4a; 
        color: white;
        border: 1px solid white;
    }

   
    @media (max-width: 768px) {
        .content-wrapper {
            flex-direction: column;
        }

        .content-image {
            max-width: 100%;
        }
    }


    /* General styling */

    .top-donator-card {
        text-align: center;
        margin: 30px auto;
        max-width: 800px;
        padding: 20px;
        border-radius: 10px;
    }

    .top-donator-card .title {
        font-size: 2rem;
        color: #3eae4a;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .card-container {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        position: relative;
        margin-top: 40px;
    }

    .card {
        background-color: #f1f1f1;
        border-radius: 10px;
        width: 150px;
        padding: 10px;
        text-align: center;
        margin: 0 10px;
        transition: all 0.3s ease-in-out;
        opacity: 0;
        transform: translateY(30px);
    }

    .card img {
        max-width: 100%;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .card h1 {
        font-size: 1.2rem;
        margin: 5px 0;
        font-weight: bold;
    }

    .card h3 {
        color: #4caf50;
        margin: 5px 0;
        font-size: 18px;
    }

    .card p {
        font-weight: bold;
        color: #777;
    }

    /* Specific styles for positioning */
    .card-1st {
        position: relative;
        top: -20px;
        transform: translateY(0);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        opacity: 1;
    }

    .card-2nd, .card-3rd {
        opacity: 1;
        transform: translateY(0);
    }

    /* Button styles */
    .donate-button {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        margin-top: 40px;
        font-size: 1.1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .donate-button:hover {
        background-color: #45a049;
    }

    /* Fade-in effect */
    .card {
        animation: fadeIn 1s ease-in-out forwards;
    }

    .card:nth-child(1) {
        animation-delay: 0.2s;
    }

    .card:nth-child(2) {
        animation-delay: 0.4s;
    }

    .card:nth-child(3) {
        animation-delay: 0.6s;
    }


    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
}

.SloganSection {
    background-color: #122023; /* or use #2ECC40 for green */
    color: white;
    text-align: center;
    padding: 50px 20px;
    margin: 40px 0;
}

.SloganSection h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 20px;
}

.SloganSection p {
    font-size: 1.25rem;
    margin-top: 10px;
}

.section3 {
    background-color: #f9f9f9;
    color: #122023;
    padding: 40px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin: 40px 0;
}

.section-title {
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
    color: #3eae4a;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.event-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    max-width: 900px;
    margin: 0 auto;
}

.event-image img {
    max-width: 300px; /* Smaller image */
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.event-content {
    flex: 1;
}

.event-content h3 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #122023;
    margin-bottom: 10px;
}

.event-content p {
    margin: 5px 0;
    color: #555;
    font-size: 1rem;
}

.event-type {
    color: #3eae4a;
    text-decoration: none;
    font-weight: bold;
}

.event-type:hover {
    text-decoration: underline;
}

.cta-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3eae4a; /* Green color */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
    margin-top: 10px; /* Add spacing above the button */
    transition: background-color 0.3s ease;
}

.cta-button:hover {
    background-color: #2c8f37; /* Darker green on hover */
}


/* Responsive Design */
@media (max-width: 768px) {
    .event-wrapper {
        flex-direction: column;
        align-items: center;
    }

    .event-image img {
        max-width: 100%;
    }

    .event-content {
        text-align: center;
    }
}

.new-slogan-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #122023;  /* Greenish background to match eco-friendly theme */
    color: white;
    padding: 60px 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s ease;
}


/* Text Content for the New Slogan Section */
.new-slogan-content h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 20px;
    margin-left:30px;
    letter-spacing: 2px;
}

.new-slogan-content p {
    font-size: 1.2rem;
    line-height: 1.6;
    max-width: 600px;
    margin-bottom: 20px;
    margin-left:30px;
    color: #f4f4f4;
}

.cta-button {
    background-color: #2ECC40;
    color: #fff;
    padding: 12px 24px;
    font-size: 1rem;
    font-weight: bold;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-left:30px;
}

.cta-button:hover {
    background-color: #3498db;
    color: #fff;
}

/* Image for the New Slogan Section */
.new-slogan-image img {
    max-width: 400px;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-right:30px;
}




.no-link-styles {
    color: inherit;
    text-decoration: none;
}

.ChangeTitleColor {
        color: #3eae4a;
    }

.ContainerReal {
    display: flex;
    justify-content: space-between;
    gap: 20px; /* Adjust spacing between the containers */
    max-width: 1200px; /* Set a max width for the entire container */
    margin: 0 auto; /* Center the container on the page */
    padding: 20px;
}

.ContentContainer, .top-donator-card {
    flex: 1; /* Equal width for both containers */
}

.ContentContainer {
    background-color: #3eae4a;
    border-radius: 8px;
    padding: 24px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.top-donator-card {
    background-color: #fff;
    border-radius: 8px;
    padding: 24px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
}

@media (max-width: 768px) {
    .ContainerReal {
        flex-direction: column;
        align-items: center;
    }

    .ContentContainer, .top-donator-card {
        width: 100%; /* Full width for smaller screens */
    }
}

.content-container{
    gap: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    padding: 20px;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
}

.MissionContainer, .note {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    padding: 20px;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
}

.VisionContainer {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    max-width: 1200px; /* Optional: set a max width for the container */
    margin: 0 auto; /* Center the container horizontally */
    padding: 20px;
}

/* Text Styling */
.MissionText, .note .VisionText {
    flex: 2;
    padding-left: -3px;
    width: 50%;
    padding: 20px;
}

.VisionText h1, .MissionText h1, .note .VisionText h1 {
    font-size: 28px;
    color: #2c3e50;
    margin-bottom: 10px;
}

.VisionText{
    flex: 2;
    text-align: right;  /* Add this line to right-align the text */
    width: 50%;
    padding: 20px;
}

.vision-menu h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #16a085;
    font-weight: bold;
}

.vision-menu ul {
    list-style-type: disc;
    padding: 0;
}

.vision-menu ul li {
    font-size: 16px;
    margin: 5px 0;
    color: #555;
}

/* Image Section */
.vissionImage, .visionImage {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.vissionImage img, .visionImage img {
    max-width: 100%;
    max-height: 250px;
    width: auto;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}


.note {
    flex-direction: row;
}

.note .vision-menu {
    margin-top: 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .VisionContainer, .MissionContainer, .note {
        flex-direction: column;
        align-items: flex-start;
    }

    .VisionText, .MissionText, .note .VisionText, .vissionImage, .visionImage {
        flex: unset;
        width: 100%;
    }

    .vissionImage img, .visionImage img {
        max-height: 200px; 
    }
}

/* Mission Section */
.mission-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: white;
    border-radius: 10px;
    margin: 20px 60px 0px 60px;
}


/* Mission Text Styling */
.mission-text {
    flex: 1;
    padding: 20px;
    color: #2ECC40;
    text-align: left;
}

.mission-text h1 {
    font-size: 2.5rem;
    font-weight: 600;
    color: #2ECC40;
    margin-bottom: 20px;
}

.mission-text p {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 30px;
    line-height: 1.8;
    max-width: 500px;
}

.cta-btn {
    display: inline-block;
    padding: 12px 30px;
    background-color: #2ECC40;
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 50px;
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.cta-btn:hover {
    background-color: #3498db;
    transform: scale(1.05);
}

/* Mission Image Styling */
.mission-image {
    flex: 1;
    padding: 20px;
}

.mission-image img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.mission-image img:hover {
    transform: scale(1.05);
}

/* Responsive Design */
@media (max-width: 768px) {
    .mission-section {
        flex-direction: column;
        text-align: center;
    }

    .mission-text {
        margin-bottom: 20px;
    }

    .mission-image img {
        max-width: 100%;
        height: auto;
    }
}

.eco-green-products {
    padding: 40px 20px;
    background-color: #f9f9f9;
    color: #122023;
    text-align: center;
}

.eco-green-products .section-title {
    font-size: 2rem;
    font-weight: bold;
    color: #3eae4a;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.eco-green-products .section-description {
    font-size: 1.25rem;
    color: #555;
    margin-bottom: 30px;
}

.products-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.product-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 240px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.product-image {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

.product-title {
    font-size: 1.25rem;
    color: #122023;
    margin-bottom: 10px;
}

.product-price {
    font-size: 1.1rem;
    color: #4caf50;
    margin-bottom: 20px;
}

.product-button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.product-button:hover {
    background-color: #45a049;
}




</style>
    

@endsection
