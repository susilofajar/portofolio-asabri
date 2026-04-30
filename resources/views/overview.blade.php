<x-app-layout>
    <x-slot name="pageTitle">Overview</x-slot>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1" style="color: var(--asabri-navy); font-weight: 600;">
                <i class="fas fa-info-circle"></i> Informasi Portfolio
            </h4>
            <p class="text-muted mb-0">Daftar kategori dokumen dan laporan investasi</p>
        </div>

        @if(canManage())
            <a href="{{ route('document-categories.index') }}" class="btn btn-asabri">
                <i class="fas fa-cog"></i> Kelola Kategori
            </a>
        @endif
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="background-color: white; border-radius: 8px;">
                <div class="card-body py-3">
                    <form action="{{ route('overview') }}" method="GET" class="row g-3 align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-filter text-muted me-2"></i> <strong>Filter:</strong>
                        </div>
                        <div class="col-auto">
                            <select name="year" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Semua Tahun</option>
                                @foreach($years as $y)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <select name="month" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Semua Bulan</option>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <select name="day" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Semua Tanggal</option>
                                @foreach(range(1, 31) as $d)
                                    <option value="{{ $d }}" {{ request('day') == $d ? 'selected' : '' }}>
                                        {{ $d }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if(request('year') || request('month') || request('day'))
                            <div class="col-auto">
                                <a href="{{ route('overview') }}"
                                    class="btn btn-sm btn-link text-danger text-decoration-none">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Fund Fact Sheet Section -->
    <div class="overview-section mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" style="color: var(--asabri-navy); font-weight: 600;">
                <i class="fas fa-file-alt"></i> Fund Fact Sheet
            </h5>
            @if($fundFactSheetCategories->count() > 3 && !request('year') && !request('month') && !request('day'))
                <button class="btn btn-sm btn-outline-primary toggle-collapse-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#fundFactSheetCollapse" aria-expanded="false" aria-controls="fundFactSheetCollapse">
                    <i class="fas fa-chevron-down"></i> <span class="btn-text">Tampilkan</span>
                </button>
            @endif
        </div>

        <div class="mt-3" id="fundFactSheetSection">
            <!-- This div wrapper is just for structure -->
            @if($fundFactSheetCategories->count() > 0)
                <div class="row g-3">
                    @foreach($fundFactSheetCategories as $index => $category)
                        @if($index == 3 && !request('year') && !request('month') && !request('day'))
                            </div>
                            <div class="collapse mt-3" id="fundFactSheetCollapse">
                                <div class="row g-3">
                        @endif
                            <div class="col-md-6 col-lg-4">
                                <div class="category-card">
                                    <div class="category-image">
                                        <img src="{{ $category->image_url }}" alt="{{ $category->title }}"
                                            onclick="showImagePreview('{{ $category->image_url }}', '{{ $category->title }}')"
                                            style="cursor: pointer;" title="Klik untuk memperbesar">
                                    </div>
                                    <div class="category-content">
                                        <h6 class="category-title">{{ $category->title }}</h6>
                                        @if($category->manager)
                                            <p class="category-manager">{{ $category->manager }}</p>
                                        @endif
                                        <div class="d-flex align-items-center text-muted mb-2" style="font-size: 11px;">
                                            <i class="far fa-clock me-1"></i>
                                            <span>{{ $category->published_at ? $category->published_at->format('d M Y') : '-' }}</span>
                                        </div>
                                        @if($category->description)
                                            <p class="category-description">{{ Str::limit($category->description, 80) }}</p>
                                        @endif
                                        <div class="mt-3">
                                            <a href="{{ route('fundfactsheet.index') }}"
                                                class="btn btn-sm btn-outline-asabri w-100">
                                                <i class="fas fa-eye me-1"></i> Lihat Dokumen
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    </div>
                    <!-- Move end of collapse if we opened it -->
                    @if($fundFactSheetCategories->count() > 3 && !request('year') && !request('month') && !request('day'))
                        </div>
                    @endif
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <p>Belum ada kategori Fund Fact Sheet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Laporan Mingguan Section -->
    <div class="overview-section mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" style="color: var(--asabri-navy); font-weight: 600;">
                <i class="fas fa-calendar-week"></i> Laporan Mingguan
            </h5>
            @if($laporanMingguanCategories->count() > 3 && !request('year') && !request('month') && !request('day'))
                <button class="btn btn-sm btn-outline-primary toggle-collapse-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#laporanMingguanCollapse" aria-expanded="false" aria-controls="laporanMingguanCollapse">
                    <i class="fas fa-chevron-down"></i> <span class="btn-text">Tampilkan</span>
                </button>
            @endif
        </div>

        <div class="mt-3" id="laporanMingguanSection">
            <!-- This div wrapper is just for structure -->
            @if($laporanMingguanCategories->count() > 0)
                <div class="row g-3">
                    @foreach($laporanMingguanCategories as $index => $category)
                        @if($index == 3 && !request('year') && !request('month') && !request('day'))
                            </div>
                            <div class="collapse mt-3" id="laporanMingguanCollapse">
                                <div class="row g-3">
                        @endif
                            <div class="col-md-6 col-lg-4">
                                <div class="category-card">
                                    <div class="category-image">
                                        <img src="{{ $category->image_url }}" alt="{{ $category->title }}"
                                            onclick="showImagePreview('{{ $category->image_url }}', '{{ $category->title }}')"
                                            style="cursor: pointer;" title="Klik untuk memperbesar">
                                    </div>
                                    <div class="category-content">
                                        <h6 class="category-title">{{ $category->title }}</h6>
                                        @if($category->manager)
                                            <p class="category-manager">{{ $category->manager }}</p>
                                        @endif
                                        <div class="d-flex align-items-center text-muted mb-2" style="font-size: 11px;">
                                            <i class="far fa-clock me-1"></i>
                                            <span>{{ $category->published_at ? $category->published_at->format('d M Y') : '-' }}</span>
                                        </div>
                                        @if($category->description)
                                            <p class="category-description">{{ Str::limit($category->description, 80) }}</p>
                                        @endif
                                        <div class="mt-3">
                                            <a href="{{ route('laporan.mingguan.index') }}"
                                                class="btn btn-sm btn-outline-asabri w-100">
                                                <i class="fas fa-eye me-1"></i> Lihat Dokumen
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    </div>
                    @if($laporanMingguanCategories->count() > 3 && !request('year') && !request('month') && !request('day'))
                        </div>
                    @endif
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <p>Belum ada kategori Laporan Mingguan.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Laporan Bulanan Section -->
    <div class="overview-section mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" style="color: var(--asabri-navy); font-weight: 600;">
                <i class="fas fa-calendar-alt"></i> Laporan Bulanan
            </h5>
            @if($laporanBulananCategories->count() > 3 && !request('year') && !request('month') && !request('day'))
                <button class="btn btn-sm btn-outline-primary toggle-collapse-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#laporanBulananCollapse" aria-expanded="false" aria-controls="laporanBulananCollapse">
                    <i class="fas fa-chevron-down"></i> <span class="btn-text">Tampilkan</span>
                </button>
            @endif
        </div>

        <div class="mt-3" id="laporanBulananSection">
            <!-- This div wrapper is just for structure -->
            @if($laporanBulananCategories->count() > 0)
                <div class="row g-3">
                    @foreach($laporanBulananCategories as $index => $category)
                        @if($index == 3 && !request('year') && !request('month') && !request('day'))
                            </div>
                            <div class="collapse mt-3" id="laporanBulananCollapse">
                                <div class="row g-3">
                        @endif
                            <div class="col-md-6 col-lg-4">
                                <div class="category-card">
                                    <div class="category-image">
                                        <img src="{{ $category->image_url }}" alt="{{ $category->title }}"
                                            onclick="showImagePreview('{{ $category->image_url }}', '{{ $category->title }}')"
                                            style="cursor: pointer;" title="Klik untuk memperbesar">
                                    </div>
                                    <div class="category-content">
                                        <h6 class="category-title">{{ $category->title }}</h6>
                                        @if($category->manager)
                                            <p class="category-manager">{{ $category->manager }}</p>
                                        @endif
                                        <div class="d-flex align-items-center text-muted mb-2" style="font-size: 11px;">
                                            <i class="far fa-clock me-1"></i>
                                            <span>{{ $category->published_at ? $category->published_at->format('d M Y') : '-' }}</span>
                                        </div>
                                        @if($category->description)
                                            <p class="category-description">{{ Str::limit($category->description, 80) }}</p>
                                        @endif
                                        <div class="mt-3">
                                            <a href="{{ route('laporan.bulanan.index') }}"
                                                class="btn btn-sm btn-outline-asabri w-100">
                                                <i class="fas fa-eye me-1"></i> Lihat Dokumen
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    </div>
                    @if($laporanBulananCategories->count() > 3 && !request('year') && !request('month') && !request('day'))
                        </div>
                    @endif
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <p>Belum ada kategori Laporan Bulanan.</p>
                </div>
            @endif
        </div>
    </div>

    <!--Laporan Tahunan Section -->
    <!--<div class="overview-section mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" style="color: var(--asabri-navy); font-weight: 600;">
                <i class="fas fa-calendar"></i> Laporan Tahunan
            </h5>
            @if($laporanTahunanCategories->count() > 3 && !request('year') && !request('month') && !request('day'))
                <button class="btn btn-sm btn-outline-primary toggle-collapse-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#laporanTahunanCollapse" aria-expanded="false" aria-controls="laporanTahunanCollapse">
                    <i class="fas fa-chevron-down"></i> <span class="btn-text">Tampilkan</span>
                </button>
            @endif
        </div>

        <div class="mt-3" id="laporanTahunanSection">
            <!-- This div wrapper is just for structure -->
            <!--@if($laporanTahunanCategories->count() > 0)
                <div class="row g-3">
                    @foreach($laporanTahunanCategories as $index => $category)
                        @if($index == 3 && !request('year') && !request('month') && !request('day'))
                            </div>
                            <div class="collapse mt-3" id="laporanTahunanCollapse">
                                <div class="row g-3">
                        @endif
                            <div class="col-md-6 col-lg-4">
                                <div class="category-card">
                                    <div class="category-image">
                                        <img src="{{ $category->image_url }}" alt="{{ $category->title }}"
                                            onclick="showImagePreview('{{ $category->image_url }}', '{{ $category->title }}')"
                                            style="cursor: pointer;" title="Klik untuk memperbesar">
                                    </div>
                                    <div class="category-content">
                                        <h6 class="category-title">{{ $category->title }}</h6>
                                        @if($category->manager)
                                            <p class="category-manager">{{ $category->manager }}</p>
                                        @endif
                                        <div class="d-flex align-items-center text-muted mb-2" style="font-size: 11px;">
                                            <i class="far fa-clock me-1"></i>
                                            <span>{{ $category->published_at ? $category->published_at->format('d M Y') : '-' }}</span>
                                        </div>
                                        @if($category->description)
                                            <p class="category-description">{{ Str::limit($category->description, 80) }}</p>
                                        @endif
                                        <div class="mt-3">
                                            <a href="{{ route('laporan.tahunan.index') }}"
                                                class="btn btn-sm btn-outline-asabri w-100">
                                                <i class="fas fa-eye me-1"></i> Lihat Dokumen
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    </div>
                    @if($laporanTahunanCategories->count() > 3 && !request('year') && !request('month') && !request('day'))
                        </div>
                    @endif
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <p>Belum ada kategori Laporan Tahunan.</p>
                </div>
            @endif
        </div>
    </div>-->

    <style>
        .overview-section {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 28px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0, 41, 102, 0.05);
            transition: box-shadow 0.3s;
        }
        
        .overview-section:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .category-card {
            background: white;
            border: 1px solid rgba(0, 41, 102, 0.06);
            border-radius: var(--border-radius-md);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            position: relative;
        }
        
        .category-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--asabri-navy), var(--asabri-gold));
            opacity: 0;
            transition: 0.4s;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
            border-color: rgba(0, 41, 102, 0.12);
        }
        
        .category-card:hover::after {
            opacity: 1;
        }

        .category-image {
            width: 100%;
            height: 180px;
            background: #f5f6fa;
            overflow: hidden;
            position: relative;
        }

        .category-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .category-card:hover .category-image img {
            transform: scale(1.05);
        }

        .category-content {
            padding: 20px;
        }

        .category-title {
            color: var(--asabri-navy);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .category-manager {
            color: var(--asabri-grey);
            font-size: 0.85rem;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .category-description {
            color: #64748B;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 0;
        }
        
        .btn-outline-asabri {
            color: var(--asabri-navy);
            border: 1px solid var(--asabri-navy);
            background: transparent;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-outline-asabri:hover {
            background: linear-gradient(135deg, var(--asabri-navy) 0%, var(--asabri-blue) 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 41, 102, 0.15);
        }
    </style>
    <!-- Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="background: transparent; border: none;">
                <div class="modal-header border-0 p-0 mb-2">
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0 text-center">
                    <img src="" id="previewImage" class="img-fluid rounded shadow-lg"
                        style="max-height: 80vh; object-fit: contain;">
                    <h5 class="mt-3 text-white" id="previewTitle"></h5>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImagePreview(url, title) {
            document.getElementById('previewImage').src = url;
            document.getElementById('previewTitle').textContent = title;
            new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const collapses = document.querySelectorAll('.collapse');

            collapses.forEach(collapse => {
                collapse.addEventListener('show.bs.collapse', function () {
                    const button = document.querySelector(`[data-bs-target="#${this.id}"]`);
                    if (button) {
                        const icon = button.querySelector('i');
                        const text = button.querySelector('.btn-text');
                        icon.className = 'fas fa-chevron-up';
                        text.textContent = 'Sembunyikan';
                    }
                });

                collapse.addEventListener('hide.bs.collapse', function () {
                    const button = document.querySelector(`[data-bs-target="#${this.id}"]`);
                    if (button) {
                        const icon = button.querySelector('i');
                        const text = button.querySelector('.btn-text');
                        icon.className = 'fas fa-chevron-down';
                        text.textContent = 'Tampilkan';
                    }
                });
            });
        });
    </script>
</x-app-layout>
