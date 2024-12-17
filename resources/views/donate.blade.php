@extends('layout.mainlayout')
@section('title', 'Donate')
@section('content')

<style>
    body {
        background-color: #122023;
        font-family: Arial, sans-serif;
    }

    .donation-container {
        max-width: 700px;
        margin: 50px auto;
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        background-color: #122023;
        color: white;
    }

    .donation-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .donation-header h1 {
        font-size: 24px;
        color: #007B34;
    }

    .donation-header img {
        width: 250px;
        height: auto;
    }

    .donation-amount {
        margin: 20px 0;
    }

    .donation-amount h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .amount-options button {
        background: #007B34;
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 5px;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .amount-options button:hover {
        background: #005a27;
    }

    .custom-amount {
        margin-top: 15px;
        display: flex;
        align-items: center;
    }

    .custom-amount input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .payment-methods {
        margin-top: 20px;
    }

    .payment-methods button {
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%;
        margin-top: 10px;
        border-radius: 4px;
        background: #f9f9f9;
        cursor: pointer;
    }

    .payment-methods button img {
        max-height: 20px;
        margin-right: 10px;
    }

    .submit-btn {
        width: 100%;
        background: #007B34;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .submit-btn:hover {
        background: #005a27;
    }

    .payment-details {
        margin-top: 20px;
    }

    .payment-form {
        margin-top: 10px;
    }

    .payment-form input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .payment-form .inline-inputs {
        display: flex;
        justify-content: space-between;
    }

    .payment-form .inline-inputs input {
        width: 48%;
    }

    .qr-code-images {
        margin-top: 10px;
        text-align: center;
    }

    .qr-code-images img {
        max-width: 100%;
        height: auto;
    }
</style>

<div class="donation-container">
    <div class="donation-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 250px; height: auto;">
        <p>Every single dollar will help the earth more than you know!</p>
    </div>

    <!-- Donation Amount Selection -->
    <div class="donation-amount">
        <h3>Select Your Donation Amount</h3>
        <div class="amount-options">
            <button data-amount="35">$35</button>
            <button data-amount="60">$60</button>
            <button data-amount="120">$120</button>
            <button data-amount="200">$200</button>
        </div>
        <div class="custom-amount">
            <span>$</span>
            <input type="number" name="custom_amount" id="custom_amount" placeholder="Enter custom amount">
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="payment-methods">
        <h3>Payment Method</h3>
        <button class="payment-option" data-method="credit-card">
            <img src="{{ asset('images/credit-card.png') }}" alt="Credit Card"> Credit Card
        </button>
        <button class="payment-option" data-method="paypal">
            <img src="{{ asset('images/paypal.png') }}" alt="PayPal"> PayPal
        </button>
        <button class="payment-option" data-method="qr-code">
            <img src="{{ asset('images/qr-code.png') }}" alt="QR Code"> QR Code
        </button>
    </div>

    <!-- Payment Details Form (Initially hidden) -->
    <div class="payment-details" style="display: none;">
        <h3>Payment Details</h3>

        <!-- PayPal Form -->
        <div id="paypal-form" class="payment-form" style="display: none;">
            <label for="paypal-email">PayPal Email:</label>
            <input type="email" id="paypal-email" name="paypal-email" placeholder="Enter PayPal Email">
            
            <div class="inline-inputs">
                <div>
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name" placeholder="First Name">
                </div>
                <div>
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Last Name">
                </div>
            </div>
        </div>

        <!-- Credit Card Form -->
        <div id="credit-card-form" class="payment-form" style="display: none;">
            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" name="card-number" placeholder="Enter Card Number">

            <label for="name-on-card">Name on Card:</label>
            <input type="text" id="name-on-card" name="name-on-card" placeholder="Enter Name on Card">

            <div class="inline-inputs">
                <div>
                    <label for="expiry-date">Expiry Date:</label>
                    <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY">
                </div>
                <div>
                    <label for="security-code">Security Code:</label>
                    <input type="text" id="security-code" name="security-code" placeholder="CVV">
                </div>
            </div>
        </div>

        <!-- QR Code Form -->
        <div id="qr-code-form" class="payment-form" style="display: none;">
            <div class="qr-code-images">
                <img src="{{ asset('images/qr-code-image1.png') }}" alt="QR Code 1">
                <img src="{{ asset('images/qr-code-image2.png') }}" alt="QR Code 2">
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <form action="{{ route('donate') }}" method="POST" class="pt-4">
        @csrf
        <input type="hidden" name="amount" id="donation-amount" value="{{ isset($amount) ? $amount : '' }}">
        <button class="submit-btn" type="submit">Donate Now</button>
    </form>
</div>

<script>
    // JavaScript to handle amount selection and custom input
    document.querySelectorAll('.amount-options button').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('custom_amount').value = button.getAttribute('data-amount');
        });
    });

    // JavaScript to handle payment method selection and form display
    document.querySelectorAll('.payment-option').forEach(button => {
        button.addEventListener('click', function() {
            // Hide all forms first
            document.querySelectorAll('.payment-form').forEach(form => form.style.display = 'none');
            // Show the form based on the selected payment method
            const method = button.getAttribute('data-method');
            const formToShow = document.getElementById(method + '-form');
            if (formToShow) {
                formToShow.style.display = 'block';
            }
            // Show the payment details section
            document.querySelector('.payment-details').style.display = 'block';
        });
    });

    // If custom amount is entered, update the hidden input
    document.getElementById('custom_amount').addEventListener('input', (event) => {
        document.getElementById('donation-amount').value = event.target.value;
    });
</script>

@endsection
