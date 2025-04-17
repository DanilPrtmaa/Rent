<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Daftar Mobil</title>
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
        
        /* Page Title */
        .page-header {
            padding: 60px 0 30px;
            text-align: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        .page-header p {
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Filter Section */
        .filter-section {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 40px;
        }
        
        .filter-title {
            margin-bottom: 20px;
            font-size: 1.3rem;
            color: #333;
            display: flex;
            align-items: center;
        }
        
        .filter-title i {
            margin-right: 10px;
            color: #4CAF50;
        }
        
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .filter-group {
            margin-bottom: 0;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        
        .filter-group select, 
        .filter-group input {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .filter-group select:focus, 
        .filter-group input:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }
        
        .filter-btn {
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
        }
        
        .apply-btn {
            padding: 10px 25px;
            background: linear-gradient(to right, #4CAF50, #2E7D32);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .apply-btn:hover {
            background: linear-gradient(to right, #43A047, #1B5E20);
            transform: translateY(-2px);
        }
        
        /* Cars Grid */
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }
        
        .car-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .car-img {
            height: 200px;
            overflow: hidden;
            position: relative;
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
        
        .car-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .car-info {
            padding: 20px;
        }
        
        .car-title {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        .car-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            color: #666;
            font-size: 14px;
        }
        
        .meta-item i {
            margin-right: 5px;
            color: #4CAF50;
        }
        
        .car-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4CAF50;
            margin: 15px 0;
        }
        
        .car-price span {
            font-size: 14px;
            font-weight: normal;
            color: #999;
        }
        
        .rent-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #4CAF50, #2E7D32);
            color: white;
            text-align: center;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .rent-btn:hover {
            background: linear-gradient(to right, #43A047, #1B5E20);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-bottom: 50px;
        }
        
        .pagination a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            margin: 0 5px;
            background-color: #fff;
            color: #555;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .pagination a:hover, 
        .pagination a.active {
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
            
            .filter-grid {
                grid-template-columns: 1fr;
            }
            
            .cars-grid {
                grid-template-columns: 1fr;
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

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Daftar Mobil Tersedia</h1>
            <p>Temukan mobil impian Anda untuk perjalanan yang nyaman dan menyenangkan</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="container">
        <div class="filter-section">
            <h2 class="filter-title"><i>🔍</i> Filter Mobil</h2>
            <form>
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="car-type">Tipe Mobil</label>
                        <select id="car-type">
                            <option value="">Semua Tipe</option>
                            <option value="mpv">MPV</option>
                            <option value="suv">SUV</option>
                            <option value="sedan">Sedan</option>
                            <option value="hatchback">Hatchback</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="transmission">Transmisi</label>
                        <select id="transmission">
                            <option value="">Semua</option>
                            <option value="automatic">Automatic</option>
                            <option value="manual">Manual</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="price-range">Range Harga</label>
                        <select id="price-range">
                            <option value="">Semua Harga</option>
                            <option value="0-300000">Rp 0 - 300.000/hari</option>
                            <option value="300000-500000">Rp 300.000 - 500.000/hari</option>
                            <option value="500000-1000000">Rp 500.000 - 1.000.000/hari</option>
                            <option value="1000000">> Rp 1.000.000/hari</option>
                        </select>
                    </div>
                    
                    <div class="filter-group filter-btn">
                        <button type="submit" class="apply-btn">Terapkan Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Cars Grid -->
    <section class="container">
        <div class="cars-grid">
            <!-- Car 1 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="Avanza.jpg" alt="Toyota Avanza">
                    <span class="car-badge">Tersedia</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Toyota Avanza</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 7 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Automatic</span>
                        <span class="meta-item"><i>⛽</i> Bensin</span>
                    </div>
                    <div class="car-price">Rp 350.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn">Sewa Sekarang</a>
                </div>
            </div>
            
            <!-- Car 2 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="Fortuner.jpg" alt="Toyota Fortuner">
                    <span class="car-badge">Tersedia</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Toyota Fortuner</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 7 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Automatic</span>
                        <span class="meta-item"><i>⛽</i> Diesel</span>
                    </div>
                    <div class="car-price">Rp 800.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn">Sewa Sekarang</a>
                </div>
            </div>
            
            <!-- Car 3 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="Brio.jpg" alt="Honda Brio">
                    <span class="car-badge">Tersedia</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Honda Brio</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 5 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Automatic</span>
                        <span class="meta-item"><i>⛽</i> Bensin</span>
                    </div>
                    <div class="car-price">Rp 300.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn">Sewa Sekarang</a>
                </div>
            </div>
            
            <!-- Car 4 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="Xenia.jpg" alt="Daihatsu Xenia">
                    <span class="car-badge">Tersedia</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Daihatsu Xenia</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 7 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Manual</span>
                        <span class="meta-item"><i>⛽</i> Bensin</span>
                    </div>
                    <div class="car-price">Rp 320.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn">Sewa Sekarang</a>
                </div>
            </div>

            <!-- Car 4 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="Pajero.jpg" alt="Daihatsu Xenia">
                    <span class="car-badge">Tersedia</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Mitsubishi Pajero</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 7 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Automatic</span>
                        <span class="meta-item"><i>⛽</i> Diesel</span>
                    </div>
                    <div class="car-price">Rp 800.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn">Sewa Sekarang</a>
                </div>
            </div>

            <!-- Car 4 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="Sigra.jpg" alt="Daihatsu Xenia">
                    <span class="car-badge">Tersedia</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Daihatsu Sigra</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 7 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Automatic</span>
                        <span class="meta-item"><i>⛽</i> Bensin</span>
                    </div>
                    <div class="car-price">Rp 200.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn">Sewa Sekarang</a>
                </div>
            </div>

            <!-- Car 4 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="Innova.jpg" alt="Daihatsu Xenia">
                    <span class="car-badge">Tersedia</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Toyota Innova</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 7 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Automatic</span>
                        <span class="meta-item"><i>⛽</i> Diesel</span>
                    </div>
                    <div class="car-price">Rp 550.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn">Sewa Sekarang</a>
                </div>
            </div>
            
            <!-- Car 4 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="Agya.jpg" alt="Toyota Agya">
                    <span class="car-badge">Tersedia</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Toyota Agya</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 5 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Automatic</span>
                        <span class="meta-item"><i>⛽</i> Bensin</span>
                    </div>
                    <div class="car-price">Rp 200.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn">Sewa Sekarang</a>
                </div>
            </div>

            <!-- Car 5 -->
            <div class="car-card">
                <div class="car-img">
                    <img src="HR-V.jpg" alt="Honda HR-V">
                    <span class="car-badge">Disewa</span>
                </div>
                <div class="car-info">
                    <h3 class="car-title">Honda HR-V</h3>
                    <div class="car-meta">
                        <span class="meta-item"><i>👥</i> 5 Kursi</span>
                        <span class="meta-item"><i>⚙️</i> Automatic</span>
                        <span class="meta-item"><i>⛽</i> Bensin</span>
                    </div>
                    <div class="car-price">Rp 500.000 <span>/ hari</span></div>
                    <a href="#" class="rent-btn disabled">Tidak Tersedia</a>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">&raquo;</a>
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