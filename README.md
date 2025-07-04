
# 💳 PayByLink Integration (ACI OPP)

This project demonstrates how to integrate with the **ACI Worldwide's PayByLink API** using PHP and HTML. It allows merchants to generate a secure hosted payment link that customers can use to complete transactions.

DEMO: https://paymentintegration.ct.ws/PayByLink-main/

---

## Features

- Creates a PayByLink using ACI's test API
- Displays detailed payment response
- Opens the payment page in a new tab or iframe
- Prepopulates customer and cart details
- Includes sample layout customization

---

## Project Structure

```
PayByLink-main/
│
├── index.php              # Main integration logic (provided HTML/PHP)
├── status.php             # Handle shopper return URL (to be implemented)
├── styles.css             # Optional styling for the UI
└── README.md              # Project documentation
```

---

##  Requirements

- PHP 7.3 or above
- CURL enabled in `php.ini`
- Local server (XAMPP/WAMP/LAMP)
- Internet access (for API and font-awesome)

---

## Setup Instructions

1. **Clone or Download** the repo to your server root:
   ```
   git clone https://github.com/yourusername/PayByLink-main.git
   ```

2. **Configure PHP & CURL**:
   Ensure the `curl` extension is enabled in your `php.ini`:
   ```
   extension=curl
   ```

3. **Run Locally**:
   Navigate to `http://localhost/PayByLink-main/index.php` in your browser.

4. **Click** the **"Generate a Payment Link"** button to create a hosted payment link.

---

## Authentication

The API uses a **Bearer token** for authentication:

```php
'Authorization:Bearer OGFjN2E0Y...'
```

> ⚠️ Replace the demo token with your actual one for production.

---

## Sample Payload

The script sends cart, customer, and layout parameters:

```php
$cart = [
  "cart.items[0].name=Premium Soccer Shoes",
  "cart.items[1].name=Blue-White Fan Trikot",
  ...
];
```

> Modify these fields as needed based on your product and branding.

---

## 📦 Output

On success, the script returns:

- `Result Code`
- `Build Number`
- `Timestamp`
- `Payment Link` (clickable and iframe option)

---

## 📄 status.php

Update the `shopperResultUrl` to point to your `status.php`, which should handle post-payment status and updates.

Example:
```php
"shopperResultUrl=http://localhost/PayByLink-main/status.php"
```

---

##  Notes

- This example **uses ACI test credentials and sandbox endpoint**.
- For **production**, ensure:
  - `CURLOPT_SSL_VERIFYPEER` is set to `true`
  - All sensitive tokens are secured
  - HTTPS is enforced

---

## Contact

For any issues or help with this integration, feel free to reach out to your ACI account manager or [ACI Developer Docs](https://docs.oppwa.com/).

---

## License

This project is for demonstration purposes. No commercial use is permitted without appropriate licenses from ACI Worldwide.
