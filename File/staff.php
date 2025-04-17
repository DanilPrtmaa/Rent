<?php
session_start();

// Check if user is logged in and is staff
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Staff Dashboard</title>
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
        
        /* Rental Form */
        .rental-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 0;
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
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
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
        
        .action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            margin-right: 5px;
        }
        
        .view-btn {
            background: var(--info);
            color: white;
        }
        
        .process-btn {
            background: var(--primary);
            color: white;
        }
        
        .cancel-btn {
            background: var(--danger);
            color: white;
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
            
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="images/logo.png" alt="Logo">
            <h3>Rental Mobil</h3>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="staff.php" class="active"><i>📊</i> Dashboard</a></li>
                <li><a href="#"><i>📝</i> Proses Sewa</a></li>
                <li><a href="#"><i>🚗</i> Daftar Mobil</a></li>
                <li><a href="#"><i>👥</i> Pelanggan</a></li>
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
                <h2>Staff Dashboard</h2>
                <a href="#" class="btn" id="newRentalBtn"><i>➕</i> Proses Sewa Baru</a>
            </div>

            <!-- Rental Form -->
            <div class="rental-form">
                <h3 style="margin-bottom: 20px; color: var(--dark);">Form Penyewaan Mobil</h3>
                <form id="rentalForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="customerName">Nama Pelanggan</label>
                            <input type="text" id="customerName" class="form-control" placeholder="Masukkan nama pelanggan" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="customerPhone">No. Telepon</label>
                            <input type="tel" id="customerPhone" class="form-control" placeholder="Masukkan nomor telepon" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="carSelect">Pilih Mobil</label>
                            <select id="carSelect" class="form-control" required>
                                <option value="">-- Pilih Mobil --</option>
                                <option value="1">Toyota Avanza - Rp 350.000/hari (Tersedia)</option>
                                <option value="2">Toyota Fortuner - Rp 800.000/hari (Tersedia)</option>
                                <option value="3">Honda Brio - Rp 300.000/hari (Tersedia)</option>
                                <option value="4">Daihatsu Xenia - Rp 320.000/hari (Tersedia)</option>
                                <option value="5">Honda HR-V - Rp 500.000/hari (Disewa)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="rentalDate">Tanggal Sewa</label>
                            <input type="date" id="rentalDate" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="returnDate">Tanggal Kembali</label>
                            <input type="date" id="returnDate" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="paymentMethod">Metode Pembayaran</label>
                            <select id="paymentMethod" class="form-control" required>
                                <option value="">-- Pilih Pembayaran --</option>
                                <option value="cash">Tunai</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="credit">Kartu Kredit</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="reset" class="btn" style="background: var(--gray);">Reset</button>
                        <button type="submit" class="btn">Proses Sewa</button>
                    </div>
                </form>
            </div>

            <!-- Active Rentals Table -->
            <div class="card">
                <div class="card-header">
                    <h3>Penyewaan Aktif</h3>
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
                                <td>15/10/2023</td>
                                <td>20/10/2023</td>
                                <td>Rp 4.000.000</td>
                                <td><span class="status-badge status-active">Aktif</span></td>
                                <td>
                                    <button class="action-btn view-btn">Detail</button>
                                    <button class="action-btn process-btn">Proses</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#TRX-002</td>
                                <td>Ani Wijaya</td>
                                <td>Honda HR-V</td>
                                <td>16/10/2023</td>
                                <td>18/10/2023</td>
                                <td>Rp 1.000.000</td>
                                <td><span class="status-badge status-active">Aktif</span></td>
                                <td>
                                    <button class="action-btn view-btn">Detail</button>
                                    <button class="action-btn process-btn">Proses</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#TRX-003</td>
                                <td>Rudi Hermawan</td>
                                <td>Toyota Avanza</td>
                                <td>17/10/2023</td>
                                <td>19/10/2023</td>
                                <td>Rp 700.000</td>
                                <td><span class="status-badge status-active">Aktif</span></td>
                                <td>
                                    <button class="action-btn view-btn">Detail</button>
                                    <button class="action-btn process-btn">Proses</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="card">
                <div class="card-header">
                    <h3>Transaksi Terakhir</h3>
                    <a href="#" class="btn">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Tgl Transaksi</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#TRX-004</td>
                                <td>Dewi Lestari</td>
                                <td>Honda Brio</td>
                                <td>18/10/2023</td>
                                <td>Rp 600.000</td>
                                <td><span class="status-badge status-completed">Selesai</span></td>
                                <td>
                                    <button class="action-btn view-btn">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#TRX-005</td>
                                <td>Fajar Setiawan</td>
                                <td>Daihatsu Xenia</td>
                                <td>15/10/2023</td>
                                <td>Rp 960.000</td>
                                <td><span class="status-badge status-completed">Selesai</span></td>
                                <td>
                                    <button class="action-btn view-btn">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#TRX-006</td>
                                <td>Gita Permata</td>
                                <td>Toyota Avanza</td>
                                <td>12/10/2023</td>
                                <td>Rp 1.050.000</td>
                                <td><span class="status-badge status-canceled">Batal</span></td>
                                <td>
                                    <button class="action-btn view-btn">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.main-content').classList.toggle('active');
        });

        // Form validation
        document.getElementById('rentalForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add form processing logic here
            alert('Penyewaan berhasil diproses!');
            this.reset();
        });
    </script>
</body>
</html>