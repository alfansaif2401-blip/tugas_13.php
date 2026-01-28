</div> <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        function toggleTheme() {
            document.body.classList.toggle('dark');
            localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
        }
        if(localStorage.getItem('theme') === 'dark') document.body.classList.add('dark');

        // Charts
        const ctxBar = document.getElementById('mainChart').getContext('2d');
        const gradient = ctxBar.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, '#6366f1'); gradient.addColorStop(1, 'rgba(99, 102, 241, 0.1)');

        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($fakultas); ?>,
                datasets: [{ data: <?php echo json_encode($dataFakultas); ?>, backgroundColor: gradient, borderRadius: 8 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });

        const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Aktif', 'Cuti', 'Lulus'],
                datasets: [{ data: [1100, 30, 120], backgroundColor: ['#6366f1', '#f59e0b', '#10b981'], borderWidth: 0, cutout: '75%' }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });

        function openModal() {
            Swal.fire({ title: 'Input Data Baru', html: '<input id="swal-input1" class="swal2-input" placeholder="Nama Mahasiswa">', confirmButtonColor: '#6366f1' });
        }

        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.querySelector('.menu-btn');
            if (window.innerWidth <= 768 && sidebar && !sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>