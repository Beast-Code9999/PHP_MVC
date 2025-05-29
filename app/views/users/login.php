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

                <!-- Show error messages if present -->
                <?php if (!empty($errors)): ?>
                    <div class="error-messages">
                        <ul style="color: red;">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo base_url('user/login'); ?>" method="POST" class="form">
                    <div class="form-group">
                        <label for="email" class="floating-label">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Email Address" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="floating-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember_me" class="checkbox-input">
                            <span class="checkbox-text">Remember Me</span>
                        </label>
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
