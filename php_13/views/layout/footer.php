 <!-- Footer -->
 <footer class="footer">
        <p>&copy; 2026 Akademik PeTIK Jombang. All rights reserved.</p>
    </footer>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        
        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            const icon = themeToggle.querySelector('i');
            if (theme === 'light') {
                icon.className = 'fas fa-moon';
            } else {
                icon.className = 'fas fa-sun';
            }
        }

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Profile Dropdown Toggle
        const userProfile = document.getElementById('userProfile');
        const profileDropdown = document.getElementById('profileDropdown');

        userProfile.addEventListener('click', (e) => {
            e.stopPropagation();
            userProfile.classList.toggle('active');
            profileDropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userProfile.contains(e.target)) {
                userProfile.classList.remove('active');
                profileDropdown.classList.remove('active');
            }
        });

        // Prevent dropdown from closing when clicking inside
        profileDropdown.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        // Logout button
        const logoutBtn = document.querySelector('.logout-btn');
        logoutBtn.addEventListener('click', () => {
            if(confirm('Are you sure you want to logout?')) {
                alert('Logging out...');
                // Add your logout logic here
            }
        });

        // Active menu item
        const menuItems = document.querySelectorAll('.sidebar-menu a');
        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                menuItems.forEach(link => link.classList.remove('active'));
                item.classList.add('active');
            });
        });
    </script>
</body>
</html>