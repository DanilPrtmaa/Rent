<?php
session_start();

// Simulate form submission
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // In a real app, you would process the form data here
    $success = true; // Simulate successful submission
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Kontak Kami</title>
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
        .contact-hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/hero-car.jpg');
            background-size: cover;
            background-position: center;
            height: 300px;
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
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        /* Contact Section */
        .contact-section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h2 {
            font-size: 2rem;
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
        
        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }
        
        /* Contact Form */
        .contact-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
            outline: none;
        }
        
        .form-group textarea {
            height: 150px;
            resize: vertical;
        }
        
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
        }
        
        .submit-btn:hover {
            background: linear-gradient(to right, #43A047, #1B5E20);
            transform: translateY(-2px);
        }
        
        /* Success Message */
        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            border-left: 4px solid #3c763d;
            display: <?php echo $success ? 'block' : 'none'; ?>;
        }
        
        /* Contact Info */
        .contact-info {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            background-color: #f1f8e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #4CAF50;
            font-size: 20px;
            flex-shrink: 0;
        }
        
        .info-content h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: #333;
        }
        
        .info-content p, 
        .info-content a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .info-content a:hover {
            color: #4CAF50;
        }
        
        /* Map */
        .map-container {
            margin-top: 40px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
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
            
            .contact-hero {
                height: 250px;
            }
            
            .hero-content h1 {
                font-size: 2rem;
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
                <h1>DND Car<span>Rent   </span></h1>
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
    <section class="contact-hero">
        <div class="hero-content">
            <h1>Hubungi Kami</h1>
            <p>Kami siap membantu Anda dengan segala pertanyaan tentang layanan kami</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-title">
                <h2>Kontak Rental Mobil</h2>
                <p>Silakan isi form berikut atau hubungi kami langsung melalui informasi kontak di bawah</p>
            </div>
            
            <div class="contact-container">
                <!-- Contact Form -->
                <div class="contact-form">
                    <?php if($success): ?>
                        <div class="success-message">
                            Terima kasih telah menghubungi kami! Pesan Anda telah terkirim dan akan segera kami tanggapi.
                        </div>
                    <?php endif; ?>
                    
                    <form action="contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <select id="subject" name="subject" required>
                                <option value="">Pilih subjek</option>
                                <option value="Pertanyaan">Pertanyaan</option>
                                <option value="Pemesanan">Pemesanan</option>
                                <option value="Keluhan">Keluhan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">Kirim Pesan</button>
                    </form>
                </div>
                
                <!-- Contact Info -->
                <div class="contact-info">
                    <div class="info-item">
                        <div class="info-icon">📍</div>
                        <div class="info-content">
                            <h3>Alamat Kantor</h3>
                            <p>Jl. Ahmad Yani No. 23<br>Samarinda Utara, 12345</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">📞</div>
                        <div class="info-content">
                            <h3>Telepon</h3>
                            <p><a href="tel:+62211234567">(021) 123-4567</a></p>
                            <p><a href="https://wa.me/6281234567890">0812-3456-7890 (WhatsApp)</a></p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">✉️</div>
                        <div class="info-content">
                            <h3>Email</h3>
                            <p><a href="mailto:info@rentalmobil.com">info@dndcarrental.com</a></p>
                            <p><a href="mailto:cs@rentalmobil.com">cs@dndcarrental.com</a></p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">⏱️</div>
                        <div class="info-content">
                            <h3>Jam Operasional</h3>
                            <p>Senin - Jumat: 08.00 - 17.00 WIB</p>
                            <p>Sabtu: 08.00 - 15.00 WIB</p>
                            <p>Minggu & Hari Libur: Tutup</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map -->
            <div class="map-container">
                <iframe src="https://www.google.com/maps?q=-0.477391,117.178876&hl=id&z=18&output=embed" allowfullscreen="" loading="lazy"></iframe>
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