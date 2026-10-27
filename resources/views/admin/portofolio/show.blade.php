<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Volt - Detail Portofolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets-admin/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-admin/img/favicon/favicon-32x32.png') }}">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .cv-sidebar {
            background-color: #1f2937;
            color: #ffffff;
        }
        .cv-sidebar a {
            color: #9ca3af;
            text-decoration: none;
        }
        .cv-sidebar a:hover {
            color: #ffffff;
        }
        .text-teal {
            color: #10b981;
        }
    </style>
</head>

<body class="bg-light">
    <main class="content container-fluid p-4">

        <!-- Header Bar -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h4 fw-bold mb-1">Detail Portofolio</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portofolio.index') }}">Portofolio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('portofolio.index') }}" class="btn btn-primary text-white">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card border-0 shadow">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">{{ $portofolio->title }}</h5>
            </div>
            <div class="card-body p-0">
                <div class="row g-0">

                    <!-- Sidebar Informasi -->
                    <div class="col-lg-4 cv-sidebar p-4">
                        
                        <!-- Gambar Portofolio (Hanya Tampil Jika Ada di Database) -->
                        @if($portofolio->image)
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/' . $portofolio->image) }}" class="rounded img-fluid border mb-3" style="max-height: 250px; object-fit: cover;" alt="{{ $portofolio->title }}">
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <h4 class="h5 fw-bold text-white mb-1">{{ $portofolio->title }}</h4>
                            <p class="text-muted small">ID: #{{ $portofolio->portofolio_id }}</p>
                        </div>

                        <!-- Informasi Metadata dari Database -->
                        <div class="mb-4 small">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-link me-3 text-muted"></i>
                                <div>
                                    <div class="fw-bold text-white">Link Proyek</div>
                                    @if($portofolio->link)
                                        <a href="{{ $portofolio->link }}" target="_blank" class="text-break">{{ $portofolio->link }}</a>
                                    @else
                                        <span class="text-muted">Tidak ada link</span>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-calendar-alt me-3 text-muted"></i>
                                <div>
                                    <div class="fw-bold text-white">Dibuat Pada</div>
                                    <span class="text-muted">{{ $portofolio->created_at ? $portofolio->created_at->format('d M Y, H:i') : '-' }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-clock me-3 text-muted"></i>
                                <div>
                                    <div class="fw-bold text-white">Terakhir Diperbarui</div>
                                    <span class="text-muted">{{ $portofolio->updated_at ? $portofolio->updated_at->format('d M Y, H:i') : '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <hr class="border-secondary my-4">

                        <!-- Tombol Aksi -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('portofolio.edit', $portofolio->portofolio_id) }}" class="btn btn-info text-white btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit Data
                            </a>
                        </div>
                    </div>

                    <!-- Konten Utama -->
                    <div class="col-lg-8 bg-white p-4 p-md-5">

                        <!-- Judul Portofolio -->
                        <div class="mb-4">
                            <h6 class="text-uppercase fw-bold text-teal mb-2 d-flex align-items-center">
                                <i class="fas fa-folder-open fs-5 me-2"></i> NAMA 
                            </h6>
                            <h3 class="h4 fw-bold text-dark">{{ $portofolio->title }}</h3>
                        </div>

                        <hr class="my-4">

                        <!-- Deskripsi Portofolio -->
                        <div class="mb-4">
                            <h6 class="text-uppercase fw-bold text-teal mb-3 d-flex align-items-center">
                                <i class="fas fa-align-left fs-5 me-2"></i> DESKRIPSI
                            </h6>
                            <p class="text-muted small lh-lg mb-0" style="white-space: pre-line;">
                                {{ $portofolio->description }}
                            </p>
                        </div>

                        <hr class="my-4">

                        <!-- Tautan Proyek -->
                        <div>
                            <h6 class="text-uppercase fw-bold text-teal mb-3 d-flex align-items-center">
                                <i class="fas fa-external-link-alt fs-5 me-2"></i> TAUTAN PROYEK
                            </h6>
                            @if($portofolio->link)
                                <a href="{{ $portofolio->link }}" target="_blank" class="btn btn-success text-white">
                                    <i class="fas fa-globe me-2"></i> Kunjungi Link Proyek
                                </a>
                            @else
                                <p class="text-muted small">Tautan proyek tidak tersedia.</p>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </main>

    <script src="{{ asset('assets-admin/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/volt.js') }}"></script>
</body>

</html>