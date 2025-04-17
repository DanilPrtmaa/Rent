<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Admin Dashboard</title>
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
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: var(--dark);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
        }
        
        .sidebar-header img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .sidebar-menu ul {
            list-style: none;
        }
        
        .sidebar-menu li a {
            display: block;
            padding: 12px 20px;
            color: #bbb;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left: 3px solid var(--primary);
        }
        
        .sidebar-menu li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        /* Top Navigation */
        .top-nav {
            background: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .menu-toggle {
            font-size: 20px;
            cursor: pointer;
            color: var(--gray);
        }
        
        .user-area {
            display: flex;
            align-items: center;
        }
        
        .user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
        }
        
        .user-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .user-name {
            font-weight: 600;
            margin-right: 10px;
        }
        
        /* Content Area */
        .content-area {
            padding: 30px;
        }
        
        .page-title {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title h2 {
            font-size: 1.8rem;
            color: var(--dark);
            position: relative;
            padding-bottom: 10px;
        }
        
        .page-title h2::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: var(--primary);
            bottom: 0;
            left: 0;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        
        .btn i {
            margin-right: 5px;
        }
        
        /* Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }
        
        .stat-info h3 {
            font-size: 1.8rem;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .stat-info p {
            color: var(--gray);
            font-size: 14px;
        }
        
        /* Tables */
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .card-header {
            padding: 20px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h3 {
            font-size: 1.2rem;
            color: var(--dark);
        }
        
        .card-body {
            padding: 0;
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }
        
        table th {
            background: var(--light);
            font-weight: 600;
            color: var(--dark);
        }
        
        table tr:hover {
            background: rgba(0,0,0,0.02);
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-available {
            background: #e8f5e9;
            color: var(--primary-dark);
        }
        
        .status-rented {
            background: #fff3e0;
            color: #E65100;
        }
        
        .status-maintenance {
            background: #ffebee;
            color: var(--danger);
        }
        
        .action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            margin-right: 5px;
        }
        
        .edit-btn {
            background: var(--info);
            color: white;
        }
        
        .delete-btn {
            background: var(--danger);
            color: white;
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--light-gray);
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
            outline: none;
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background: white;
            width: 90%;
            max-width: 600px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            padding: 20px;
            background: var(--primary);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h3 {
            font-size: 1.3rem;
        }
        
        .close-modal {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .modal-footer {
            padding: 15px 20px;
            background: var(--light);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            
            .sidebar.active {
                width: 250px;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="CarRent.png" alt="Logo">
            <h3>Rental Mobil</h3>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="admin.php" class="active"><i>📊</i> Dashboard</a></li>
                <li><a href="#"><i>🚗</i> Manajemen Mobil</a></li>
                <li><a href="#"><i>📝</i> Transaksi</a></li>
                <li><a href="#"><i>👥</i> Pelanggan</a></li>
                <li><a href="#"><i>👨‍💼</i> Staff</a></li>
                <li><a href="#"><i>⚙️</i> Pengaturan</a></li>
                <li><a href="logout.php"><i>🚪</i> Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            <div class="menu-toggle">
                <i>☰</i>
            </div>
            <div class="user-area">
                <span class="user-name"><?php echo $_SESSION['user']['name']; ?></span>
                <div class="user-img">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']['name']); ?>&background=4CAF50&color=fff" alt="User">
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="page-title">
                <h2>Admin Dashboard</h2>
                <a href="#" class="btn" id="addCarBtn"><i>➕</i> Tambah Mobil</a>
            </div>

            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #e8f5e9; color: var(--primary-dark);">
                        <i>🚗</i>
                    </div>
                    <div class="stat-info">
                        <h3>42</h3>
                        <p>Total Mobil</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" style="background: #e3f2fd; color: var(--info);">
                        <i>📝</i>
                    </div>
                    <div class="stat-info">
                        <h3>18</h3>
                        <p>Penyewaan Aktif</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" style="background: #fff8e1; color: var(--warning);">
                        <i>💰</i>
                    </div>
                    <div class="stat-info">
                        <h3>Rp 25.7jt</h3>
                        <p>Pendapatan Bulan Ini</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" style="background: #f1f8e9; color: var(--primary-dark);">
                        <i>👥</i>
                    </div>
                    <div class="stat-info">
                        <h3>156</h3>
                        <p>Pelanggan</p>
                    </div>
                </div>
            </div>

            <!-- Recent Rentals Table -->
            <div class="card">
                <div class="card-header">
                    <h3>Penyewaan Terbaru</h3>
                    <a href="#" class="btn">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Tgl Sewa</th>
                                <th>Tgl Kembali</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#TRX-001</td>
                                <td>Budi Santoso</td>
                                <td>Toyota Fortuner</td>
                                <td>15/10/2025</td>
                                <td>20/10/2025</td>
                                <td>Rp 4.000.000</td>
                                <td><span class="status-badge status-available">Berjalan</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#TRX-002</td>
                                <td>Puspita Sari</td>
                                <td>Honda HR-V</td>
                                <td>16/10/2025</td>
                                <td>18/10/2025</td>
                                <td>Rp 1.000.000</td>
                                <td><span class="status-badge status-available">Berjalan</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#TRX-003</td>
                                <td>Rudi Hermawan</td>
                                <td>Toyota Avanza</td>
                                <td>17/10/2025</td>
                                <td>19/10/2025</td>
                                <td>Rp 700.000</td>
                                <td><span class="status-badge status-rented">Selesai</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Detail</button>
                                </td>
                            </tr>
                            <tr>
                            <td>#TRX-004</td>
                                <td>Willy Wongka</td>
                                <td>Mitsubishi Pajero</td>
                                <td>17/10/2025</td>
                                <td>19/10/2025</td>
                                <td>Rp 2.000.000</td>
                                <td><span class="status-badge status-rented">Selesai</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#TRX-005</td>
                                <td>Agung Kurniawan</td>
                                <td>Honda Brio</td>
                                <td>18/10/2025</td>
                                <td>20/10/2025</td>
                                <td>Rp 600.000</td>
                                <td><span class="status-badge status-maintenance">Dibatalkan</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cars Table -->
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Mobil</h3>
                    <a href="#" class="btn">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mobil</th>
                                <th>Tipe</th>
                                <th>Harga/Hari</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Toyota Avanza</td>
                                <td>MPV</td>
                                <td>Rp 350.000</td>
                                <td><span class="status-badge status-available">Tersedia</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                            <td>2</td>
                                <td>Toyota Agya</td>
                                <td>Hatchback</td>
                                <td>Rp 255.000</td>
                                <td><span class="status-badge status-available">Tersedia</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                            <td>3</td>
                                <td>Mitsubishi Pajero</td>
                                <td>SUV</td>
                                <td>Rp 800.000</td>
                                <td><span class="status-badge status-available">Tersedia</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                            <td>4</td>
                                <td>Toyota Innova Reborn</td>
                                <td>MPV</td>
                                <td>Rp 550.000</td>
                                <td><span class="status-badge status-available">Tersedia</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Toyota Fortuner</td>
                                <td>SUV</td>
                                <td>Rp 800.000</td>
                                <td><span class="status-badge status-rented">Disewa</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Honda Brio</td>
                                <td>Hatchback</td>
                                <td>Rp 300.000</td>
                                <td><span class="status-badge status-available">Tersedia</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                            <td>7</td>
                                <td>Daihatsu Sigra</td>
                                <td>MPV</td>
                                <td>Rp 200.000</td>
                                <td><span class="status-badge status-available">Tersedia</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                            <td>8</td>
                                <td>Honda HR-V</td>
                                <td>SUV</td>
                                <td>Rp 500.000</td>
                                <td><span class="status-badge status-available">Tersedia</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Daihatsu Xenia</td>
                                <td>MPV</td>
                                <td>Rp 320.000</td>
                                <td><span class="status-badge status-maintenance">Perawatan</span></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Car Modal -->
    <div class="modal" id="addCarModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Mobil Baru</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="carForm">
                    <div class="form-group">
                        <label for="carName">Nama Mobil</label>
                        <input type="text" id="carName" class="form-control" placeholder="Contoh: Toyota Avanza" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="carType">Tipe Mobil</label>
                        <select id="carType" class="form-control" required>
                            <option value="">Pilih Tipe</option>
                            <option value="mpv">MPV</option>
                            <option value="suv">SUV</option>
                            <option value="sedan">Sedan</option>
                            <option value="hatchback">Hatchback</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="carPrice">Harga per Hari (Rp)</label>
                        <input type="number" id="carPrice" class="form-control" placeholder="350000" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="carStatus">Status</label>
                        <select id="carStatus" class="form-control" required>
                            <option value="available">Tersedia</option>
                            <option value="rented">Disewa</option>
                            <option value="maintenance">Perawatan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="carImage">Gambar Mobil</label>
                        <input type="file" id="carImage" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="carDesc">Deskripsi</label>
                        <textarea id="carDesc" class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn">Simpan</button>
                <button class="btn" style="background: var(--gray);">Batal</button>
            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.main-content').classList.toggle('active');
        });

        // Modal Toggle
        document.getElementById('addCarBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('addCarModal').style.display = 'flex';
        });

        document.querySelector('.close-modal').addEventListener('click', function() {
            document.getElementById('addCarModal').style.display = 'none';
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            if (e.target === document.getElementById('addCarModal')) {
                document.getElementById('addCarModal').style.display = 'none';
            }
        });
    </script>
</body>
</html>