<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --bg-sidebar: #ffffff;
            --text-primary: #2c3e50;
            --text-secondary: #6c757d;
            --text-sidebar: #2c3e50;
            --border-color: #dee2e6;
            --accent-color: #3498db;
            --accent-hover: #2980b9;
            --card-shadow: 0 2px 4px rgba(0,0,0,0.1);
            --sidebar-hover: rgba(52, 152, 219, 0.1);
            --transition: 0.3s ease;
        }

        [data-theme="dark"] {
            --bg-primary: #1a1a1a;
            --bg-secondary: #2d2d2d;
            --bg-sidebar: #2d2d2d;
            --text-primary: #e0e0e0;
            --text-secondary: #a0a0a0;
            --text-sidebar: #e0e0e0;
            --border-color: #404040;
            --accent-color: #3498db;
            --accent-hover: #5dade2;
            --card-shadow: 0 2px 8px rgba(0,0,0,0.3);
            --sidebar-hover: rgba(52, 152, 219, 0.2);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            transition: background-color var(--transition), color var(--transition);
        }

        /* Header/Navbar */
        .header {
            background-color: var(--bg-primary);
            border-bottom: 1px solid var(--border-color);
            padding: 0 2rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            transition: background-color var(--transition);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-primary);
            display: none;
            padding: 0.5rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-color);
        }

        .logo-image {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-color);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .theme-toggle {
            background: none;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition);
            color: var(--text-primary);
        }

        .theme-toggle:hover {
            background-color: var(--bg-secondary);
            transform: scale(1.1);
        }

        .user-profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background-color var(--transition);
        }

        .user-profile:hover {
            background-color: var(--bg-secondary);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .dropdown-icon {
            margin-left: 0.5rem;
            font-size: 0.8rem;
            transition: transform var(--transition);
        }

        .user-profile.active .dropdown-icon {
            transform: rotate(180deg);
        }

        /* Profile Dropdown */
        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background-color: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            min-width: 250px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all var(--transition);
            z-index: 1001;
        }

        .profile-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile-dropdown-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .profile-dropdown-info h4 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .profile-dropdown-info p {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .profile-dropdown-menu {
            list-style: none;
            padding: 0.5rem 0;
        }

        .profile-dropdown-menu li {
            padding: 0;
        }

        .profile-dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1.5rem;
            color: var(--text-primary);
            text-decoration: none;
            transition: background-color var(--transition);
            font-size: 0.9rem;
        }

        .profile-dropdown-menu a:hover {
            background-color: var(--bg-secondary);
        }

        .profile-dropdown-menu .icon {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .profile-dropdown-footer {
            padding: 0.5rem;
            border-top: 1px solid var(--border-color);
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem 1.5rem;
            background: none;
            border: none;
            color: #e74c3c;
            text-align: left;
            cursor: pointer;
            transition: background-color var(--transition);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-radius: 8px;
        }

        .logout-btn:hover {
            background-color: rgba(231, 76, 60, 0.1);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            bottom: 0;
            width: 260px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            padding: 2rem 0;
            overflow-y: auto;
            transition: transform var(--transition), background-color var(--transition);
            z-index: 999;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 2rem;
            color: var(--text-sidebar);
            text-decoration: none;
            transition: all var(--transition);
            font-size: 0.95rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--sidebar-hover);
            border-left: 4px solid var(--accent-color);
            padding-left: calc(2rem - 4px);
        }

        .menu-icon {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 2rem;
            min-height: calc(100vh - 70px - 60px);
            transition: margin-left var(--transition);
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
        }

        /* Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            transition: all var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-title {
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-change {
            font-size: 0.85rem;
            color: #27ae60;
        }

        .stat-change.negative {
            color: #e74c3c;
        }

        /* Content Cards */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
        }

        .content-card {
            background-color: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        .card-header {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table th {
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-success {
            background-color: rgba(39, 174, 96, 0.2);
            color: #27ae60;
        }

        .status-warning {
            background-color: rgba(243, 156, 18, 0.2);
            color: #f39c12;
        }

        .status-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }

        /* Footer */
        .footer {
            background-color: var(--bg-primary);
            border-top: 1px solid var(--border-color);
            padding: 1.5rem 2rem;
            margin-left: 260px;
            margin-top: 2rem;
            text-align: center;
            color: var(--text-secondary);
            transition: margin-left var(--transition), background-color var(--transition);
        }

        /* Responsive */
                    @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content,
            .footer {
                margin-left: 0;
            }

            .header {
                padding: 0 1rem;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .user-info {
                display: none;
            }

            .dropdown-icon {
                display: none;
            }

            .profile-dropdown {
                right: -1rem;
            }

            .logo-text {
                display: none;
            }
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 998;
        }

        .overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="logo">
                <img src="google-wallet.png" alt="Logo" class="logo-image">
                <span class="logo-text">Akademik PeTIK Jombang</span>
            </div>
        </div>
        <div class="header-right">
            <button class="theme-toggle" id="themeToggle">
                <i class="fas fa-moon"></i>
            </button>
            <div class="user-profile" id="userProfile">
                <div class="user-avatar">AD</div>
                <div class="user-info">
                    <span class="user-name">Admin User</span>
                    <span class="user-role">Administrator</span>
                </div>
                <span class="dropdown-icon">
                    <i class="fas fa-chevron-down"></i>
                </span>
                
                <!-- Profile Dropdown -->
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="profile-dropdown-header">
                        <div class="profile-dropdown-avatar">AD</div>
                        <div class="profile-dropdown-info">
                            <h4>Admin User</h4>
                            <p>admin@example.com</p>
                        </div>
                    </div>
                    <ul class="profile-dropdown-menu">
                        <li><a href="#"><span class="icon"><i class="fas fa-user"></i></span>My Profile</a></li>
                        <li><a href="#"><span class="icon"><i class="fas fa-cog"></i></span>Account Settings</a></li>
                        <li><a href="#"><span class="icon"><i class="fas fa-bell"></i></span>Notifications</a></li>
                        <li><a href="#"><span class="icon"><i class="fas fa-credit-card"></i></span>Billing</a></li>
                        <li><a href="#"><span class="icon"><i class="fas fa-question-circle"></i></span>Help & Support</a></li>
                    </ul>
                    <div class="profile-dropdown-footer">
                        <button class="logout-btn">
                            <span class="icon"><i class="fas fa-sign-out-alt"></i></span>Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>