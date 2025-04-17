<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DND Car Rental - Beranda</title>
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
            color: #333;
            line-height: 1.6;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #3e8e41;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 50px;
            margin-right: 10px;
        }
        
        .logo h1 {
            font-size: 1.8rem;
            color: #333;
            font-weight: 700;
        }
        
        .logo span {
            color: #4CAF50;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 25px;
        }
        
        nav ul li a {
            font-weight: 600;
            color: #555;
            transition: color 0.3s;
            position: relative;
        }
        
        nav ul li a:hover {
            color: #4CAF50;
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: #4CAF50;
            bottom: -5px;
            left: 0;
            transition: width 0.3s;
        }
        
        nav ul li a:hover::after {
            width: 100%;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/hero-car.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            margin-top: 80px;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .hero h2 {
            font-size: 3rem;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease;
        }
        
        .hero .btn {
            animation: fadeIn 1.5s ease;
        }
        
        /* Features Section */
        .features {
            padding: 80px 0;
            background-color: #fff;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        
        .section-title h2::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: #4CAF50;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .section-title p {
            color: #777;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .feature-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .feature-img {
            height: 200px;
            overflow: hidden;
        }
        
        .feature-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .feature-card:hover .feature-img img {
            transform: scale(1.1);
        }
        
        .feature-content {
            padding: 20px;
        }
        
        .feature-content h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        .feature-content p {
            color: #777;
            margin-bottom: 15px;
        }
        
        .price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #4CAF50;
        }
        
        /* Why Choose Us Section */
        .why-us {
            padding: 80px 0;
            background-color: #f8f9fa;
        }
        
        .benefits {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .benefit {
            text-align: center;
            padding: 30px 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .benefit:hover {
            transform: translateY(-10px);
        }
        
        .benefit-icon {
            font-size: 3rem;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        
        .benefit h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        .benefit p {
            color: #777;
        }
        
        /* Footer */
        footer {
            background-color: #222;
            color: #fff;
            padding: 50px 0 20px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 2px;
            background: #4CAF50;
            bottom: 0;
            left: 0;
        }
        
        .footer-column p, .footer-column a {
            color: #bbb;
            margin-bottom: 10px;
            display: block;
            transition: color 0.3s;
        }
        
        .footer-column a:hover {
            color: #4CAF50;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: #333;
            border-radius: 50%;
            transition: background 0.3s;
        }
        
        .social-links a:hover {
            background: #4CAF50;
        }
        
        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #bbb;
            font-size: 0.9rem;
        }
        
        /* Login Status */
        .login-status {
            text-align: center;
            margin-top: 10px;
            color: #bbb;
            font-size: 0.9rem;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                padding: 15px;
            }
            
            nav ul {
                margin-top: 15px;
            }
            
            nav ul li {
                margin: 0 10px;
            }
            
            .hero h2 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="CarRent.png" alt="Rental Mobil Logo">
                <h1>DND Car<span>Rent</span></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="cars.php">Mobil</a></li>
                    <li><a href="about.php">Tentang Kami</a></li>
                    <li><a href="contact.php">Kontak</a></li>
                    <?php if(isset($_SESSION['user'])): ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Sewa Mobil Berkualitas dengan Harga Terbaik</h2>
            <p>Temukan berbagai pilihan mobil terbaik untuk kebutuhan perjalanan Anda. Nikmati pengalaman berkendara yang nyaman dan aman bersama kami.</p>
            <a href="cars.php" class="btn">Lihat Mobil Tersedia</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Mobil Populer</h2>
                <p>Berbagai pilihan mobil terbaik dengan kondisi prima dan harga kompetitif</p>
            </div>
            
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-img">
                        <img src="Avanza.jpg" alt="Toyota Avanza">
                    </div>
                    <div class="feature-content">
                        <h3>Toyota Avanza</h3>
                        <p>MPV 7-seater dengan kenyamanan maksimal untuk keluarga</p>
                        <p class="price">Rp 350.000 / hari</p>
                        <a href="#" class="btn">Sewa Sekarang</a>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-img">
                        <img src="Fortuner.jpg" alt="Toyota Fortuner">
                    </div>
                    <div class="feature-content">
                        <h3>Toyota Fortuner</h3>
                        <p>SUV tangguh dengan performa luar biasa di segala medan</p>
                        <p class="price">Rp 800.000 / hari</p>
                        <a href="#" class="btn">Sewa Sekarang</a>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-img">
                        <img src="Pajero.jpg" alt="Toyota Fortuner">
                    </div>
                    <div class="feature-content">
                        <h3>Mitsubishi Pajero</h3>
                        <p>SUV tangguh dengan performa luar biasa di segala medan</p>
                        <p class="price">Rp 800.000 / hari</p>
                        <a href="#" class="btn">Sewa Sekarang</a>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-img">
                        <img src="Agya.jpg" alt="Toyota Fortuner">
                    </div>
                    <div class="feature-content">
                        <h3>Toyota Agya</h3>
                        <p>City car ekonomis dengan desain modern dan irit bahan bakar</p>
                        <p class="price">Rp 255.000 / hari</p>
                        <a href="#" class="btn">Sewa Sekarang</a>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-img">
                        <img src="Innova.jpg" alt="Toyota Fortuner">
                    </div>
                    <div class="feature-content">
                        <h3>Toyota Innova reborn</h3>
                        <p>City car ekonomis dengan desain modern dan irit bahan bakar</p>
                        <p class="price">Rp 255.000 / hari</p>
                        <a href="#" class="btn">Sewa Sekarang</a>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-img">
                        <img src="Brio.jpg" alt="Honda Brio">
                    </div>
                    <div class="feature-content">
                        <h3>Honda Brio</h3>
                        <p>City car ekonomis dengan desain modern dan irit bahan bakar</p>
                        <p class="price">Rp 300.000 / hari</p>
                        <a href="#" class="btn">Sewa Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-us">
        <div class="container">
            <div class="section-title">
                <h2>Mengapa Memilih Kami?</h2>
                <p>Kami memberikan pelayanan terbaik untuk kenyamanan Anda</p>
            </div>
            
            <div class="benefits">
                <div class="benefit">
                    <div class="benefit-icon">🚗</div>
                    <h3>Armada Terawat</h3>
                    <p>Semua mobil kami dalam kondisi prima dan selalu diperiksa rutin</p>
                </div>
                
                <div class="benefit">
                    <div class="benefit-icon">💰</div>
                    <h3>Harga Kompetitif</h3>
                    <p>Harga sewa terjangkau dengan kualitas pelayanan terbaik</p>
                </div>
                
                <div class="benefit">
                    <div class="benefit-icon">⏱️</div>
                    <h3>Proses Cepat</h3>
                    <p>Proses sewa mudah dan cepat hanya dengan beberapa langkah</p>
                </div>
                
                <div class="benefit">
                    <div class="benefit-icon">📱</div>
                    <h3>24/7 Support</h3>
                    <p>Layanan pelanggan siap membantu Anda kapan saja</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Tentang Kami</h3>
                    <p>Rental Mobil adalah perusahaan penyewaan mobil terpercaya dengan pengalaman lebih dari 10 tahun melayani pelanggan.</p>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <a href="index.php">Beranda</a>
                    <a href="cars.php">Mobil</a>
                    <a href="about.php">Tentang Kami</a>
                    <a href="contact.php">Kontak</a>
                </div>
                
                <div class="footer-column">
                    <h3>Kontak Kami</h3>
                    <p>Jl. Ahmad Yani No. 23</p>
                    <p>Samarinda Utara</p>
                    <p>Phone: (021) 1234567</p>
                    <p>Email: info@dndcarrental.com</p>
                </div>
                
                <div class="footer-column">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="#">FB</a>
                        <a href="#">IG</a>
                        <a href="#">TW</a>
                        <a href="#">YT</a>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 DND Car Rental. All Rights Reserved.</p>
                <?php if(isset($_SESSION['user'])): ?>
                    <div class="login-status">
                        Logged in as: <?php echo $_SESSION['user']['username']; ?> (<?php echo $_SESSION['user']['role']; ?>)
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</body>
</html>