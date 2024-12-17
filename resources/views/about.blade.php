@extends("layout.main")

@section("container")

<div class="AboutContainer">
    <!-- About Us Text -->
    <div class="AboutText"> 
        <h1 class="fw-bold">About Us</h1>
        <p>
            Life on Land is at the heart of our mission. We strive to protect and restore terrestrial ecosystems, promote sustainable land use, and combat deforestation and biodiversity loss. Through donations, blogs, and action-oriented campaigns, we work hand in hand with communities to create a sustainable future for all.
        </p>
        <p>
            Join us on this journey to make a tangible difference for the planet. Together, we can ensure a thriving environment for generations to come.
        </p>
        <!-- Call-to-Action Button -->
        <a href="/posts" class="cta-button">Take Action Now</a>
    </div>

    <!-- About Us Image -->
    <img src="images/red-panda.jpg" alt="Life on Land" class="AboutImage">
</div>

<!-- Vision and Mission Section -->
<div class="VisionMissionContainer">
    <!-- Vision Box -->
    <div class="Card VisionBox">
        <h1>Our Vision</h1>
        <p>
            To preserve freshwater and terrestrial ecosystems, encourage sustainable lifestyles, and spur international action to save the planet's biodiversity. In our ideal future, wildlife will flourish, forests will thrive, and degraded areas will transform into thriving, life-sustaining environments.
        </p>
    </div>

    <!-- Mission Box -->
    <div class="Card MissionBox">
        <h1>Our Mission</h1>
        <ul>
            <li>Support efforts to protect and rejuvenate forests, wetlands, and critical ecosystems.</li>
            <li>Advocate for policies and practices to halt deforestation worldwide.</li>
            <li>Provide education and tools for sustainable land management.</li>
            <li>Build a global space to connect eco-conscious individuals and ideas.</li>
        </ul>
    </div>
</div>

<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
    }

    /* About Container */
    .AboutContainer {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        align-items: center;
        justify-content: center;
        max-width: 1200px;
        margin: 50px auto;
        padding: 40px 20px;
        border-radius: 12px;
        background: linear-gradient(to right, #e8f5e9, #f1f8f6);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .AboutText {
        flex: 1;
        max-width: 600px;
        text-align: left;
    }

    .AboutText h1 {
        font-size: 2.8rem;
        color: #2e7d32;
        margin-bottom: 20px;
    }

    .AboutText p {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 20px;
    }

    .cta-button {
        display: inline-block;
        padding: 12px 24px;
        background-color: #43a047;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .cta-button:hover {
        background-color: #388e3c;
        transform: translateY(-3px);
    }

    .AboutImage {
        flex: 1;
        max-width: 500px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }

    /* Vision and Mission Section */
    .VisionMissionContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 40px;
        margin: 50px auto;
        max-width: 1200px;
        padding: 20px;
    }

    .Card {
        flex: 1;
        min-width: 300px;
        padding: 30px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .Card:hover {
        transform: translateY(-8px);
    }

    .Card h1 {
        font-size: 2.2rem;
        color: #2e7d32;
        margin-bottom: 15px;
        text-align: center;
    }

    .Card p, .Card ul {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.6;
    }

    .Card ul {
        padding-left: 20px;
    }

    /* Social Media Section */
    .SocialMediaContainer {
        text-align: center;
        margin: 50px 0;
    }

    .SocialMediaContainer h2 {
        font-size: 2rem;
        color: #2e7d32;
    }

    .SocialMediaLinks a {
        display: inline-block;
        margin: 10px;
        padding: 10px 20px;
        font-size: 1.1rem;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        transition: opacity 0.3s;
    }

    .instagram {
        background-color: #e4405f;
    }

    .facebook {
        background-color: #1877f2;
    }

    .x {
        background-color: #1d9bf0;
    }

    .SocialMediaLinks a:hover {
        opacity: 0.8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .AboutContainer, .VisionMissionContainer {
            flex-direction: column;
        }
    }
</style>

@endsection
