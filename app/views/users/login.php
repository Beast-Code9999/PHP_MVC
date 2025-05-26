<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('/css/login.css'); ?>">
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="login-form">
                <form action="<?php echo base_url('user/login'); ?>" method="POST" class="form">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-input" required>
                    </div>
                    
                    <button type="submit" class="login-btn">Login</button>
                </form>
                
                <div class="register-link">
                    <p>Don't have an account? <a href="<?php echo base_url('user/register'); ?>">Register here</a></p>
                </div>
            </div>
        </div>
        
        <div class="login-right">
            <div class="hero-content">
                <h2 class="hero-title">Welcome Back</h2>
                <p class="hero-description">
                    Sign in to access your account and enjoy unlimited access to in-depth reporting across Northern Australia and Southeast Asia.
                </p>
            </div>
        </div>
    </div>
</body>
</html>