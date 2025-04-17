<?php
session_start();

// Simulated user data
$users = [
    'admin' => [
        'password' => 'admin123',
        'role' => 'admin',
        'name' => 'Administrator'
    ],
    'staff' => [
        'password' => 'staff123',
        'role' => 'staff',
        'name' => 'Staff Rental'
    ],
    'customer' => [
        'password' => 'customer123',
        'role' => 'customer',
        'name' => 'Pelanggan'
    ]
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';
    
    if (isset($users[$username])) {
        $user = $users[$username];
        if ($password === $user['password'] && $role === $user['role']) {
            $_SESSION['user'] = [
                'username' => $username,
                'name' => $user['name'],
                'role' => $user['role']
            ];
            
            switch ($user['role']) {
                case 'admin':
                    header('Location: admin.php');
                    exit;
                case 'staff':
                    header('Location: staff.php');
                    exit;
                case 'customer':
                    header('Location: customer.php');
                    exit;
            }
        }
    }
    
    $error = 'Username, password, atau role salah!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Login</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }
        
        /* Login Header */
        .login-header {
            background: linear-gradient(to right, #4CAF50, #2E7D32);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .login-header h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .login-header p {
            opacity: 0.9;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .logo img {
            width: 80px;
            height: 80px;
        }
        
        /* Login Form */
        .login-form {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-group input:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
            outline: none;
        }
        
        .form-group input::placeholder {
            color: #aaa;
        }
        
        /* Role Selection */
        .role-selection {
            margin-bottom: 25px;
        }
        
        .role-selection h3 {
            margin-bottom: 15px;
            color: #555;
            font-size: 16px;
        }
        
        .role-options {
            display: flex;
            gap: 15px;
        }
        
        .role-option {
            flex: 1;
        }
        
        .role-option input {
            display: none;
        }
        
        .role-option label {
            display: block;
            padding: 12px;
            background-color: #f5f5f5;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            color: #666;
        }
        
        .role-option input:checked + label {
            background-color: #4CAF50;
            color: white;
        }
        
        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, #4CAF50, #2E7D32);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .submit-btn:hover {
            background: linear-gradient(to right, #43A047, #1B5E20);
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }
        
        /* Error Message */
        .error-message {
            color: #e53935;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
            background-color: #ffebee;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #e53935;
        }
        
        /* Footer Links */
        .login-footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #eee;
            background-color: #f9f9f9;
        }
        
        .login-footer a {
            color: #4CAF50;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .login-footer a:hover {
            color: #2E7D32;
            text-decoration: underline;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                border-radius: 0;
                box-shadow: none;
            }
            
            .role-options {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <img src="CarRent.png" alt="Rental Mobil Logo">
            </div>
            <h2>Selamat Datang</h2>
            <p>Silakan login untuk mengakses akun Anda</p>
        </div>
        
        <div class="login-form">
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                </div>
                
                <div class="role-selection">
                    <h3>Login Sebagai:</h3>
                    <div class="role-options">
                        <div class="role-option">
                            <input type="radio" id="admin" name="role" value="admin" required>
                            <label for="admin">Admin</label>
                        </div>
                        <div class="role-option">
                            <input type="radio" id="staff" name="role" value="staff">
                            <label for="staff">Staff</label>
                        </div>
                        <div class="role-option">
                            <input type="radio" id="customer" name="role" value="customer">
                            <label for="customer">Pelanggan</label>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">Login</button>
            </form>
        </div>
        
        <div class="login-footer">
            <p>Belum punya akun? <a href="contact.php">Hubungi kami</a></p>
            <p><a href="index.php">Kembali ke Beranda</a></p>
        </div>
    </div>
</body>
</html>