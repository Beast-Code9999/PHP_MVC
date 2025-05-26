<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="<?php echo base_url('/css/register.css'); ?>">
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class="register-form">
                <form action="<?php echo base_url('user/register'); ?>" method="POST" class="form">
                    <div class="form-group">
                        <input type="text" name="full_name" placeholder="Full Name" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-input" required>
                    </div>
                    
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="agree_terms" class="checkbox-input" required>
                            <span class="checkbox-text">By clicking "Register" you agree to our Privacy Policy</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="register-btn">Register</button>
                </form>
                
                <div class="login-link">
                    <p>Already have an account? <a href="<?php echo base_url('user/login'); ?>">Login here</a></p>
                </div>
            </div>
        </div>
        
        <div class="register-right">
            <div class="hero-content">
                <h2 class="hero-title">Create an account</h2>
                <p class="hero-description">
                    Create an account to get unlimited access to in-depth reporting across Northern Australia and Southeast Asia.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
