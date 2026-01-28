<!-- Main Content -->
<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 class="page-title">Detail Mahasiswa</h1>
                <p class="page-subtitle">Informasi lengkap mahasiswa</p>
            </div>
            <a href="index.php?page=mahasiswa" 
               class="btn btn-secondary"
               style="padding: 0.75rem 1.5rem; background: var(--bg-secondary); color: var(--text-primary); border: 1px solid var(--border-color); border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 500;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem;">
        <!-- Profile Card -->
        <div class="content-card">
            <div style="text-align: center; padding: 2rem 1rem;">
                <!-- Avatar -->
                <div style="width: 150px; height: 150px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, var(--accent-color), var(--accent-hover)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem; font-weight: 700; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    <?php echo strtoupper(substr($data['mahasiswa']['nama_lengkap'], 0, 1)); ?>
                </div>

                <!-- Nama & NIM -->
                <h2 style="margin-bottom: 0.5rem; font-size: 1.5rem;">
                    <?php echo htmlspecialchars($data['mahasiswa']['nama_lengkap']); ?>
                </h2>
                <p style="color: var(--text-secondary); margin-bottom: 1rem; font-size: 1.1rem;">
                    <i class="fas fa-id-card"></i> <?php echo htmlspecialchars($data['mahasiswa']['nim']); ?>
                </p>

                <!-- Status Badge -->
                <?php
                $statusClass = '';
                $statusIcon = '';
                switch($data['mahasiswa']['status']) {
                    case 'Aktif':
                        $statusClass = 'status-success';
                        $statusIcon = 'fa-check-circle';
                        break;
                    case 'Cuti':
                        $statusClass = 'status-warning';
                        $statusIcon = 'fa-pause-circle';
                        break;
                    case 'Lulus':
                        $statusClass = 'status-success';
                        $statusIcon = 'fa-graduation-cap';
                        break;
                    case 'DO':
                        $statusClass = 'status-danger';
                        $statusIcon = 'fa-times-circle';
                        break;
                }
                ?>
                <span class="status-badge <?php echo $statusClass; ?>" style="font-size: 1rem; padding: 0.5rem 1.5rem;">
                    <i class="fas <?php echo $statusIcon; ?>"></i> <?php echo htmlspecialchars($data['mahasiswa']['status']); ?>
                </span>

                <hr style="margin: 1.5rem 0; border: none; border-top: 1px solid var(--border-color);">

                <!-- Quick Info -->
                <div style="text-align: left;">
                    <div style="margin-bottom: 1rem;">
                        <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.25rem;">Jurusan</div>
                        <div style="font-weight: 600;">
                            <i class="fas fa-graduation-cap" style="color: var(--accent-color);"></i>
                            <?php echo htmlspecialchars($data['mahasiswa']['nama_jurusan']); ?>
                        </div>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.25rem;">Angkatan</div>
                        <div style="font-weight: 600;">
                            <i class="fas fa-calendar" style="color: var(--accent-color);"></i>
                            <?php echo htmlspecialchars($data['mahasiswa']['angkatan']); ?>
                        </div>
                    </div>
                    <div>
                        <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.25rem;">Tanggal Masuk</div>
                        <div style="font-weight: 600;">
                            <i class="fas fa-sign-in-alt" style="color: var(--accent-color);"></i>
                            <?php echo date('d F Y', strtotime($data['mahasiswa']['tanggal_masuk'])); ?>
                        </div>
                    </div>
                </div>

                <hr style="margin: 1.5rem 0; border: none; border-top: 1px solid var(--border-color);">

                <!-- Action Buttons -->
                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                    <button class="btn" style="flex: 1; padding: 0.75rem; background: var(--accent-color); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn" style="flex: 1; padding: 0.75rem; background: #e74c3c; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div>
            <!-- Biodata Section -->
            <div class="content-card" style="margin-bottom: 1.5rem;">
                <div class="card-header">
                    <i class="fas fa-user"></i> Biodata Diri
                </div>
                <div style="padding: 1.5rem;">
                    <div class="info-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                        <div class="info-item">
                            <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-venus-mars"></i> Jenis Kelamin
                            </div>
                            <div style="font-weight: 600; font-size: 1rem;">
                                <?php echo htmlspecialchars($data['mahasiswa']['jenis_kelamin']); ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-map-marker-alt"></i> Tempat Lahir
                            </div>
                            <div style="font-weight: 600; font-size: 1rem;">
                                <?php echo htmlspecialchars($data['mahasiswa']['tempat_lahir']); ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-birthday-cake"></i> Tanggal Lahir
                            </div>
                            <div style="font-weight: 600; font-size: 1rem;">
                                <?php echo date('d F Y', strtotime($data['mahasiswa']['tanggal_lahir'])); ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-hourglass-half"></i> Usia
                            </div>
                            <div style="font-weight: 600; font-size: 1rem;">
                                <?php 
                                $birthDate = new DateTime($data['mahasiswa']['tanggal_lahir']);
                                $today = new DateTime();
                                $age = $today->diff($birthDate)->y;
                                echo $age . ' tahun';
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <hr style="margin: 1.5rem 0; border: none; border-top: 1px solid var(--border-color);">
                    
                    <div class="info-item">
                        <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-home"></i> Alamat Lengkap
                        </div>
                        <div style="font-weight: 600; font-size: 1rem; line-height: 1.6;">
                            <?php echo nl2br(htmlspecialchars($data['mahasiswa']['alamat'])); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="content-card" style="margin-bottom: 1.5rem;">
                <div class="card-header">
                    <i class="fas fa-address-book"></i> Informasi Kontak
                </div>
                <div style="padding: 1.5rem;">
                    <div class="info-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                        <div class="info-item">
                            <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-phone"></i> No. Telepon
                            </div>
                            <div style="font-weight: 600; font-size: 1rem;">
                                <?php echo htmlspecialchars($data['mahasiswa']['no_telepon']); ?>
                            </div>
                            <a href="tel:<?php echo $data['mahasiswa']['no_telepon']; ?>" 
                               style="display: inline-block; margin-top: 0.5rem; padding: 0.4rem 1rem; background: #27ae60; color: white; border-radius: 6px; text-decoration: none; font-size: 0.85rem;">
                                <i class="fas fa-phone-alt"></i> Hubungi
                            </a>
                        </div>
                        <div class="info-item">
                            <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-envelope"></i> Email
                            </div>
                            <div style="font-weight: 600; font-size: 1rem; word-break: break-all;">
                                <?php echo htmlspecialchars($data['mahasiswa']['email']); ?>
                            </div>
                            <a href="mailto:<?php echo $data['mahasiswa']['email']; ?>" 
                               style="display: inline-block; margin-top: 0.5rem; padding: 0.4rem 1rem; background: #3498db; color: white; border-radius: 6px; text-decoration: none; font-size: 0.85rem;">
                                <i class="fas fa-envelope"></i> Kirim Email
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Section -->
            <div class="content-card">
                <div class="card-header">
                    <i class="fas fa-university"></i> Informasi Akademik
                </div>
                <div style="padding: 1.5rem;">
                    <div class="info-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                        <div class="info-item">
                            <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-bookmark"></i> Kode Jurusan
                            </div>
                            <div style="font-weight: 600; font-size: 1rem;">
                                <?php echo htmlspecialchars($data['mahasiswa']['kode_jurusan']); ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-user-tie"></i> Ketua Jurusan
                            </div>
                            <div style="font-weight: 600; font-size: 1rem;">
                                <?php echo htmlspecialchars($data['mahasiswa']['ketua_jurusan']); ?>
                            </div>
                        </div>
                    </div>
                    
                    <hr style="margin: 1.5rem 0; border: none; border-top: 1px solid var(--border-color);">
                    
                    <div style="display: flex; gap: 1rem;">
                        <a href="index.php?page=nilai&id=<?php echo $data['mahasiswa']['id_mahasiswa']; ?>" 
                           class="btn" 
                           style="flex: 1; padding: 0.75rem; background: var(--accent-color); color: white; border: none; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 500;">
                            <i class="fas fa-chart-line"></i> Lihat Nilai
                        </a>
                        <a href="index.php?page=absensi&id=<?php echo $data['mahasiswa']['id_mahasiswa']; ?>" 
                           class="btn" 
                           style="flex: 1; padding: 0.75rem; background: #9b59b6; color: white; border: none; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 500;">
                            <i class="fas fa-clipboard-check"></i> Lihat Absensi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .main-content > div {
        grid-template-columns: 1fr !important;
    }
    
    .info-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>