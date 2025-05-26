<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('/css/contact.css'); ?>">
</head>
<body>
    <div class="contact-container">
        <div class="contact-info">
            <h1>Contact Us</h1>
            <p>Feel free to use this form or drop us an email. Old-fashioned phone calls work too</p>

            <div class="info-item">
                <span>📞</span>
                <p>480 009 0452</p>
            </div>
            <div class="info-item">
                <span>📧</span>
                <p>example@gmail.com</p>
            </div>
            <div class="info-item">
                <span>📍</span>
                <p>15 Street 3rd Darwin<br>NT 0810</p>
            </div>
        </div>

        <div class="contact-form">
            <form action="#" method="post">
                <div class="form-group double">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <textarea name="message" placeholder="Message" rows="5" required></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
