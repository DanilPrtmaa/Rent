<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Tentang Kami</title>
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
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
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
        }
        
        nav ul li a:hover {
            color: #4CAF50;
        }
        
        /* Hero Section */
        .about-hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/hero-car.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
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
        
        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            animation: fadeInUp 1s ease;
        }
        
        /* About Content */
        .about-section {
            padding: 80px 0;
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
        
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            margin-bottom: 60px;
        }
        
        .about-text h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #333;
        }
        
        .about-text p {
            margin-bottom: 15px;
            color: #555;
        }
        
        .about-image {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .about-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s;
        }
        
        .about-image:hover img {
            transform: scale(1.05);
        }
        
        /* Features Section */
        .features {
            background-color: #f1f8e9;
            padding: 60px 0;
            margin-bottom: 60px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .feature-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        
        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        .feature-card p {
            color: #666;
        }
        
        /* Team Section */
        .team-section {
            margin-bottom: 80px;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .team-member {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
        }
        
        .member-image {
            height: 250px;
            overflow: hidden;
        }
        
        .member-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .team-member:hover .member-image img {
            transform: scale(1.1);
        }
        
        .member-info {
            padding: 20px;
        }
        
        .member-info h3 {
            font-size: 1.3rem;
            margin-bottom: 5px;
            color: #333;
        }
        
        .member-info p {
            color: #4CAF50;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .member-social {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .member-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background-color: #f1f8e9;
            border-radius: 50%;
            color: #4CAF50;
            transition: all 0.3s;
        }
        
        .member-social a:hover {
            background-color: #4CAF50;
            color: white;
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
        
        .footer-column p, 
        .footer-column a {
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
                flex-wrap: wrap;
                justify-content: center;
            }
            
            nav ul li {
                margin: 5px 10px;
            }
            
            .about-content {
                grid-template-columns: 1fr;
            }
            
            .about-image {
                order: -1;
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
    <section class="about-hero">
        <div class="hero-content">
            <h1>Tentang Perusahaan Kami</h1>
            <p>Menyediakan solusi transportasi terbaik sejak 2010</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h3>Sejarah Kami</h3>
                    <p>Rental Mobil didirikan pada tahun 2010 dengan visi untuk menyediakan layanan penyewaan mobil yang berkualitas dan terjangkau. Dimulai dengan hanya 5 unit mobil, kami telah berkembang menjadi salah satu perusahaan rental mobil terkemuka di Indonesia dengan lebih dari 100 armada.</p>
                    <p>Komitmen kami terhadap kualitas pelayanan dan kepuasan pelanggan telah membuat kami dipercaya oleh ribuan pelanggan, mulai dari perorangan hingga perusahaan besar.</p>
                    <p>Kami terus berinovasi untuk memberikan pengalaman terbaik dalam setiap perjalanan Anda.</p>
                </div>
                <div class="about-image">
                    <img src="Sejarah.jpg" alt="Sejarah Rental Mobil">
                </div>
            </div>
            
            <div class="about-content">
                <div class="about-image">
                    <img src="Buggati.jpg" alt="Visi Misi">
                </div>
                <div class="about-text">
                    <h3>Visi & Misi</h3>
                    <p><strong>Visi:</strong> Menjadi penyedia jasa rental mobil terdepan yang memberikan solusi transportasi berkualitas dengan pelayanan prima.</p>
                    <p><strong>Misi:</strong></p>
                    <ul style="list-style-type: none; color: #555; margin-bottom: 15px;">
                        <li>✓ Menyediakan armada terbaik dengan kondisi prima</li>
                        <li>✓ Memberikan harga kompetitif dan transparan</li>
                        <li>✓ Menjamin kenyamanan dan keamanan pelanggan</li>
                        <li>✓ Mengutamakan profesionalisme dan integritas</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Keunggulan Kami</h2>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🚗</div>
                    <h3>Armada Terawat</h3>
                    <p>Semua mobil kami melalui pemeriksaan rutin untuk memastikan kondisi prima dan siap pakai</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Harga Kompetitif</h3>
                    <p>Kami menawarkan harga terbaik dengan kualitas pelayanan yang tidak kompromi</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">⏱️</div>
                    <h3>Proses Cepat</h3>
                    <p>Proses sewa yang mudah dan cepat dengan dokumentasi yang sederhana</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>24/7 Support</h3>
                    <p>Tim kami siap membantu Anda kapan saja selama masa sewa</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="container team-section">
        <div class="section-title">
            <h2>Tim Kami</h2>
            <p>Orang-orang profesional yang siap melayani Anda</p>
        </div>
        
        <div class="team-grid">
            <div class="team-member">
                <div class="member-image">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Direktur">
                </div>
                <div class="member-info">
                    <h3>Muhammad Danil Pratama</h3>
                    <p>Direktur Utama</p>
                    <div class="member-social">
                        <a href="#">FB</a>
                        <a href="#">IG</a>
                        <a href="#">LI</a>
                    </div>
                </div>
            </div>
            
            <div class="team-member">
                <div class="member-image">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Manajer">
                </div>
                <div class="member-info">
                    <h3>Delia Apriliani</h3>
                    <p>Manajer Operasional</p>
                    <div class="member-social">
                        <a href="#">FB</a>
                        <a href="#">IG</a>
                        <a href="#">LI</a>
                    </div>
                </div>
            </div>
            
            <div class="team-member">
                <div class="member-image">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Supervisor">
                </div>
                <div class="member-info">
                    <h3>Rudi Hermawan</h3>
                    <p>Supervisor Lapangan</p>
                    <div class="member-social">
                        <a href="#">FB</a>
                        <a href="#">IG</a>
                        <a href="#">LI</a>
                    </div>
                </div>
            </div>
            
            <div class="team-member">
                <div class="member-image">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Customer Service">
                </div>
                <div class="member-info">
                    <h3>Dewi Lestari</h3>
                    <p>Customer Service</p>
                    <div class="member-social">
                        <a href="#">FB</a>
                        <a href="#">IG</a>
                        <a href="#">LI</a>
                    </div>
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
                    <p>Jl. Ahmad Yani. 23</p>
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
                <p>&copy; 2023 Rental Mobil. All Rights Reserved.</p>
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