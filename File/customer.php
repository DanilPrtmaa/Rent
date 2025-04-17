<?php
session_start();

// Check if user is logged in and is customer
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Akun Saya</title>
    <style>
        /* Global Styles */
        :root {
            --primary: #4CAF50;
            --primary-dark: #2E7D32;
            --secondary: #607D8B;
            --danger: #F44336;
            --warning: #FFC107;
            --info: #2196F3;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
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
        .profile-hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/hero-car.jpg');
            background-size: cover;
            background-position: center;
            height: 250px;
            display: flex;
            align-items: center;
            color: white;
            margin-top: 80px;
            text-align: center;
        }
        
        .hero-content {
            width: 100%;
            padding: 0 20px;
        }
        
        .hero-content h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        /* Profile Section */
        .profile-section {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            margin: 40px 0;
        }
        
        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
        }
        
        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 30px;
            text-align: center;
            height: fit-content;
        }
        
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 5px solid var(--light);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-name {
            font-size: 1.5rem;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .profile-role {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .profile-info {
            text-align: left;
            margin-top: 20px;
        }
        
        .info-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--gray);
            font-size: 14px;
        }
        
        .info-value {
            color: var(--dark);
            margin-top: 5px;
        }
        
        .edit-profile {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .edit-profile:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        /* Content Section */
        .content-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 30px;
        }
        
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--dark);
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: var(--primary);
            bottom: 0;
            left: 0;
        }
        
        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid var(--light-gray);
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 600;
            color: var(--gray);
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
        }
        
        .tab.active {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
        }
        
        .tab:hover:not(.active) {
            color: var(--dark);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Rental History */
        .rental-item {
            display: flex;
            align-items: center;
            padding: 20px;
            border-radius: 5px;
            background: var(--light);
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        
        .rental-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .rental-img {
            width: 100px;
            height: 70px;
            border-radius: 5px;
            overflow: hidden;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .rental-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .rental-info {
            flex-grow: 1;
        }
        
        .rental-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .rental-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 5px;
            font-size: 14px;
            color: var(--gray);
        }
        
        .rental-price {
            font-weight: 600;
            color: var(--primary);
        }
        
        .rental-status {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-active {
            background: #e8f5e9;
            color: var(--primary-dark);
        }
        
        .status-completed {
            background: #e3f2fd;
            color: var(--info);
        }
        
        .status-canceled {
            background: #ffebee;
            color: var(--danger);
        }
        
        .rental-actions {
            margin-left: 20px;
        }
        
        .action-btn {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-weight: 600;
        }
        
        .view-btn {
            background: var(--info);
            color: white;
        }
        
        .repeat-btn {
            background: var(--primary);
            color: white;
        }
        
        /* Recommended Cars */
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .car-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }
        
        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .car-img {
            height: 150px;
            overflow: hidden;
        }
        
        .car-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .car-card:hover .car-img img {
            transform: scale(1.1);
        }
        
        .car-info {
            padding: 15px;
        }
        
        .car-title {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: var(--dark);
        }
        
        .car-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            color: var(--gray);
        }
        
        .car-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin: 10px 0;
        }
        
        .car-price span {
            font-size: 14px;
            font-weight: normal;
            color: var(--gray);
        }
        
        .rent-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: var(--primary);
            color: white;
            text-align: center;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        
        .rent-btn:hover {
            background: var(--primary-dark);
        }
        
        /* Footer */
        footer {
            background-color: #222;
            color: #fff;
            padding: 50px 0 20px;
            margin-top: 50px;
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
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="images/logo.png" alt="Rental Mobil Logo">
                <h1>Rental<span>Mobil</span></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="cars.php">Mobil</a></li>
                    <li><a href="customer.php">Akun Saya</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="profile-hero">
        <div class="hero-content">
            <h1>Akun Saya</h1>
            <p>Kelola informasi akun dan riwayat penyewaan Anda</p>
        </div>
    </section>

    <!-- Profile Section -->
    <div class="container">
        <div class="profile-section">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-img">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']['name']); ?>&background=4CAF50&color=fff" alt="Profile">
                </div>
                <h2 class="profile-name"><?php echo $_SESSION['user']['name']; ?></h2>
                <p class="profile-role">Pelanggan</p>
                
                <div class="profile-info">
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">customer@example.com</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Telepon</div>
                        <div class="info-value">08123456789</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Bergabung</div>
                        <div class="info-value">15 Oktober 2022</div>
                    </div>
                </div>
                
                <a href="#" class="edit-profile">Edit Profil</a>
            </div>
            
            <!-- Content Section -->
            <div class="content-section">
                <div class="tabs">
                    <div class="tab active" data-tab="rentals">Riwayat Penyewaan</div>
                    <div class="tab" data-tab="recommendations">Rekomendasi Mobil</div>
                    <div class="tab" data-tab="settings">Pengaturan</div>
                </div>
                
                <!-- Rentals Tab -->
                <div class="tab-content active" id="rentals">
                    <h3 class="section-title">Riwayat Penyewaan</h3>
                    
                    <div class="rental-item">
                        <div class="rental-img">
                            <img src="images/fortuner.jpg" alt="Toyota Fortuner">
                        </div>
                        <div class="rental-info">
                            <h4 class="rental-title">Toyota Fortuner</h4>
                            <div class="rental-meta">
                                <span>15/10/2023 - 20/10/2023</span>
                                <span>5 Hari</span>
                            </div>
                            <div class="rental-price">Rp 4.000.000</div>
                        </div>
                        <div class="rental-status status-completed">Selesai</div>
                        <div class="rental-actions">
                            <button class="action-btn view-btn">Detail</button>
                            <button class="action-btn repeat-btn">Sewa Lagi</button>
                        </div>
                    </div>
                    
                    <div class="rental-item">
                        <div class="rental-img">
                            <img src="images/avanza.jpg" alt="Toyota Avanza">
                        </div>
                        <div class="rental-info">
                            <h4 class="rental-title">Toyota Avanza</h4>
                            <div class="rental-meta">
                                <span>05/10/2023 - 08/10/2023</span>
                                <span>3 Hari</span>
                            </div>
                            <div class="rental-price">Rp 1.050.000</div>
                        </div>
                        <div class="rental-status status-completed">Selesai</div>
                        <div class="rental-actions">
                            <button class="action-btn view-btn">Detail</button>
                            <button class="action-btn repeat-btn">Sewa Lagi</button>
                        </div>
                    </div>
                    
                    <div class="rental-item">
                        <div class="rental-img">
                            <img src="images/brio.jpg" alt="Honda Brio">
                        </div>
                        <div class="rental-info">
                            <h4 class="rental-title">Honda Brio</h4>
                            <div class="rental-meta">
                                <span>25/09/2023 - 27/09/2023</span>
                                <span>2 Hari</span>
                            </div>
                            <div class="rental-price">Rp 600.000</div>
                        </div>
                        <div class="rental-status status-canceled">Dibatalkan</div>
                        <div class="rental-actions">
                            <button class="action-btn view-btn">Detail</button>
                        </div>
                    </div>
                </div>
                
                <!-- Recommendations Tab -->
                <div class="tab-content" id="recommendations">
                    <h3 class="section-title">Rekomendasi Untuk Anda</h3>
                    <p>Berdasarkan riwayat penyewaan Anda, kami merekomendasikan mobil-mobil berikut:</p>
                    
                    <div class="cars-grid">
                        <div class="car-card">
                            <div class="car-img">
                                <img src="images/fortuner.jpg" alt="Toyota Fortuner">
                            </div>
                            <div class="car-info">
                                <h4 class="car-title">Toyota Fortuner</h4>
                                <div class="car-meta">
                                    <span>SUV</span>
                                    <span>7 Kursi</span>
                                    <span>Automatic</span>
                                </div>
                                <div class="car-price">Rp 800.000 <span>/ hari</span></div>
                                <button class="rent-btn">Sewa Sekarang</button>
                            </div>
                        </div>
                        
                        <div class="car-card">
                            <div class="car-img">
                                <img src="images/hrv.jpg" alt="Honda HR-V">
                            </div>
                            <div class="car-info">
                                <h4 class="car-title">Honda HR-V</h4>
                                <div class="car-meta">
                                    <span>SUV</span>
                                    <span>5 Kursi</span>
                                    <span>Automatic</span>
                                </div>
                                <div class="car-price">Rp 500.000 <span>/ hari</span></div>
                                <button class="rent-btn">Sewa Sekarang</button>
                            </div>
                        </div>
                        
                        <div class="car-card">
                            <div class="car-img">
                                <img src="images/avanza.jpg" alt="Toyota Avanza">
                            </div>
                            <div class="car-info">
                                <h4 class="car-title">Toyota Avanza</h4>
                                <div class="car-meta">
                                    <span>MPV</span>
                                    <span>7 Kursi</span>
                                    <span>Automatic</span>
                                </div>
                                <div class="car-price">Rp 350.000 <span>/ hari</span></div>
                                <button class="rent-btn">Sewa Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Settings Tab -->
                <div class="tab-content" id="settings">
                    <h3 class="section-title">Pengaturan Akun</h3>
                    <p>Fitur pengaturan akun akan segera hadir. Silakan hubungi admin untuk perubahan data.</p>
                </div>
            </div>
        </div>
    </div>

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
                    <p>Jl. Raya Contoh No. 23</p>
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
            </div>
        </div>
    </footer>

    <script>
        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // Rental item hover effect
        const rentalItems = document.querySelectorAll('.rental-item');
        rentalItems.forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.style.transform = 'translateY(-3px)';
                item.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
            });
            
            item.addEventListener('mouseleave', () => {
                item.style.transform = '';
                item.style.boxShadow = '';
            });
        });
    </script>
</body>
</html>