<!-- Main Content -->
<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Data Mahasiswa</h1>
        <p class="page-subtitle">Kelola data mahasiswa PeTIK Jombang</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-title">Total Mahasiswa</div>
                <div class="stat-icon" style="background-color: rgba(52, 152, 219, 0.2); color: #3498db;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-value"><?php echo $data['statistik']['total_mahasiswa']; ?></div>
            <div class="stat-change">Semua mahasiswa terdaftar</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-title">Mahasiswa Aktif</div>
                <div class="stat-icon" style="background-color: rgba(46, 204, 113, 0.2); color: #2ecc71;">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-value"><?php echo $data['statistik']['mahasiswa_aktif']; ?></div>
            <div class="stat-change">Status aktif kuliah</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-title">Jurusan PPL</div>
                <div class="stat-icon" style="background-color: rgba(155, 89, 182, 0.2); color: #9b59b6;">
                    <i class="fas fa-laptop-code"></i>
                </div>
            </div>
            <div class="stat-value"><?php echo $data['statistik']['mahasiswa_ppl']; ?></div>
            <div class="stat-change">Pengembangan Perangkat Lunak</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-title">Jurusan DM</div>
                <div class="stat-icon" style="background-color: rgba(241, 196, 15, 0.2); color: #f1c40f;">
                    <i class="fas fa-bullhorn"></i>
                </div>
            </div>
            <div class="stat-value"><?php echo $data['statistik']['mahasiswa_dm']; ?></div>
            <div class="stat-change">Digital Marketing</div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="content-card" style="margin-bottom: 1.5rem;">
        <form method="GET" action="index.php" class="filter-form">
            <input type="hidden" name="page" value="mahasiswa">
            
            <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: end;">
                <!-- Search -->
                <div style="flex: 1; min-width: 250px;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        <i class="fas fa-search"></i> Cari Mahasiswa
                    </label>
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Cari berdasarkan NIM atau Nama..."
                           value="<?php echo htmlspecialchars($data['search']); ?>"
                           style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-primary); color: var(--text-primary);">
                </div>

                <!-- Filter Jurusan -->
                <div style="min-width: 200px;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        <i class="fas fa-filter"></i> Filter Jurusan
                    </label>
                    <select name="jurusan" 
                            class="form-control"
                            style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-primary); color: var(--text-primary);">
                        <option value="">Semua Jurusan</option>
                        <?php foreach($data['jurusan'] as $jurusan): ?>
                            <option value="<?php echo $jurusan['id_jurusan']; ?>" 
                                    <?php echo ($data['filterJurusan'] == $jurusan['id_jurusan']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($jurusan['nama_jurusan']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Limit -->
                <div style="min-width: 120px;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        <i class="fas fa-list-ol"></i> Per Halaman
                    </label>
                    <select name="limit" 
                            class="form-control"
                            style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-primary); color: var(--text-primary);">
                        <option value="10" <?php echo ($data['limit'] == 10) ? 'selected' : ''; ?>>10</option>
                        <option value="25" <?php echo ($data['limit'] == 25) ? 'selected' : ''; ?>>25</option>
                        <option value="50" <?php echo ($data['limit'] == 50) ? 'selected' : ''; ?>>50</option>
                        <option value="100" <?php echo ($data['limit'] == 100) ? 'selected' : ''; ?>>100</option>
                    </select>
                </div>

                <!-- Button -->
                <div>
                    <button type="submit" 
                            class="btn btn-primary" 
                            style="padding: 0.75rem 1.5rem; background: var(--accent-color); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="index.php?page=mahasiswa" 
                       class="btn btn-secondary" 
                       style="padding: 0.75rem 1.5rem; background: var(--bg-secondary); color: var(--text-primary); border: 1px solid var(--border-color); border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 500;">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="content-card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <span>Daftar Mahasiswa (<?php echo $data['totalData']; ?> data)</span>
            <button class="btn btn-success" style="padding: 0.5rem 1rem; background: #38c244e3; color: white; border: none; border-radius: 8px; cursor: pointer;">
                <i class="fas fa-plus"></i> Tambah data
            </button>
        </div>

        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 12%;">NIM</th>
                        <th style="width: 25%;">Nama Lengkap</th>
                        <th style="width: 10%;">JK</th>
                        <th style="width: 18%;">Jurusan</th>
                        <th style="width: 10%;">Angkatan</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['mahasiswa'])): ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 2rem; color: var(--text-secondary);">
                                <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                                Data mahasiswa tidak ditemukan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php 
                        $no = (($data['currentPage'] - 1) * $data['limit']) + 1;
                        foreach($data['mahasiswa'] as $mhs): 
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($mhs['nim']); ?></strong></td>
                                <td><?php echo htmlspecialchars($mhs['nama_lengkap']); ?></td>
                                <td><?php echo htmlspecialchars($mhs['jenis_kelamin']); ?></td>
                                <td>
                                    <span class="badge" style="background: rgba(52, 152, 219, 0.2); color: #3498db; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem;">
                                        <?php echo htmlspecialchars($mhs['nama_jurusan']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($mhs['angkatan']); ?></td>
                                <td>
                                    <?php
                                    $statusClass = '';
                                    switch($mhs['status']) {
                                        case 'Aktif':
                                            $statusClass = 'status-success';
                                            break;
                                        case 'Cuti':
                                            $statusClass = 'status-warning';
                                            break;
                                        case 'Lulus':
                                            $statusClass = 'status-success';
                                            break;
                                        case 'DO':
                                            $statusClass = 'status-danger';
                                            break;
                                    }
                                    ?>
                                    <span class="status-badge <?php echo $statusClass; ?>">
                                        <?php echo htmlspecialchars($mhs['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="index.php?page=mahasiswa&action=detail&id=<?php echo $mhs['id_mahasiswa']; ?>" 
                                       class="btn-action btn-info" 
                                       title="Detail"
                                       style="padding: 0.4rem 0.8rem; background: #3498db; color: white; border-radius: 6px; text-decoration: none; display: inline-block; margin: 0 0.2rem;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" 
                                       class="btn-action btn-warning" 
                                       title="Edit"
                                       style="padding: 0.4rem 0.8rem; background: #f39c12; color: white; border-radius: 6px; text-decoration: none; display: inline-block; margin: 0 0.2rem;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" 
                                       class="btn-action btn-danger" 
                                       title="Hapus"
                                       onclick="return confirm('Yakin ingin menghapus data ini?')"
                                       style="padding: 0.4rem 0.8rem; background: #e74c3c; color: white; border-radius: 6px; text-decoration: none; display: inline-block; margin: 0 0.2rem;">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($data['totalPages'] > 1): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
            <div style="color: var(--text-secondary);">
                Halaman <?php echo $data['currentPage']; ?> dari <?php echo $data['totalPages']; ?>
                (Total <?php echo $data['totalData']; ?> data)
            </div>
            
            <div class="pagination" style="display: flex; gap: 0.5rem;">
                <?php if($data['currentPage'] > 1): ?>
                    <a href="index.php?page=mahasiswa&hal=<?php echo ($data['currentPage'] - 1); ?>&limit=<?php echo $data['limit']; ?>&search=<?php echo urlencode($data['search']); ?>&jurusan=<?php echo $data['filterJurusan']; ?>" 
                       class="page-link"
                       style="padding: 0.5rem 1rem; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 6px; text-decoration: none; color: var(--text-primary);">
                        <i class="fas fa-chevron-left"></i> Prev
                    </a>
                <?php endif; ?>
                
                <?php
                $startPage = max(1, $data['currentPage'] - 2);
                $endPage = min($data['totalPages'], $data['currentPage'] + 2);
                
                for($i = $startPage; $i <= $endPage; $i++):
                ?>
                    <a href="index.php?page=mahasiswa&hal=<?php echo $i; ?>&limit=<?php echo $data['limit']; ?>&search=<?php echo urlencode($data['search']); ?>&jurusan=<?php echo $data['filterJurusan']; ?>" 
                       class="page-link <?php echo ($i == $data['currentPage']) ? 'active' : ''; ?>"
                       style="padding: 0.5rem 1rem; background: <?php echo ($i == $data['currentPage']) ? 'var(--accent-color)' : 'var(--bg-secondary)'; ?>; border: 1px solid var(--border-color); border-radius: 6px; text-decoration: none; color: <?php echo ($i == $data['currentPage']) ? 'white' : 'var(--text-primary)'; ?>;">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
                
                <?php if($data['currentPage'] < $data['totalPages']): ?>
                    <a href="index.php?page=mahasiswa&hal=<?php echo ($data['currentPage'] + 1); ?>&limit=<?php echo $data['limit']; ?>&search=<?php echo urlencode($data['search']); ?>&jurusan=<?php echo $data['filterJurusan']; ?>" 
                       class="page-link"
                       style="padding: 0.5rem 1rem; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 6px; text-decoration: none; color: var(--text-primary);">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>