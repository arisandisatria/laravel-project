<x-app-layout>
    <x-slot name="header">
        <div class="d-flexjustify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                {{ __('Dashboard Overview') }}
            </h2>
            <span class="text-muted small">
                <i class="bi bi-calendar3 me-1"></i> {{ date('d F Y') }}
            </span>
        </div>
    </x-slot>

    <div class="card shadow-sm border-0 rounded-4 mb-4 bg-primary text-white">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <h4 class="fw-bold mb-1">Selamat datang, {{ Auth::user()->name }}! 👋</h4>
                <p class="mb-0 text-white-50 small">Berikut adalah ringkasan aktivitas dan metrik sistem hari ini.</p>
            </div>
            <div class="d-none d-md-block opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                              <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.84l-6.5-2.6v7.922l6.5 2.6zM5.22 4.24 1.846 2.887 8 1.426l3.374 1.352-6.154 1.463z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-1">Total Master Obat</h6>
                    <h3 class="fw-bold mb-0 text-dark">142 <span class="fs-6 text-muted fw-normal">Item</span></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 16 16">
                              <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2-3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-1">E-Resep Hari Ini</h6>
                    <h3 class="fw-bold mb-0 text-dark">28 <span class="fs-6 text-muted fw-normal">Resep</span></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                              <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                              <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                              <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-1">Antrean Pasien</h6>
                    <h3 class="fw-bold mb-0 text-dark">12 <span class="fs-6 text-muted fw-normal">Orang</span></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                              <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                              <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-1">Stok Obat Menipis</h6>
                    <h3 class="fw-bold mb-0 text-dark">5 <span class="fs-6 text-muted fw-normal">Item</span></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0">E-Resep Terbaru</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Semua</a>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted small">
                                <tr>
                                    <th class="border-0 rounded-start">ID Resep</th>
                                    <th class="border-0">Nama Pasien</th>
                                    <th class="border-0">Dokter</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0 rounded-end text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">#RSP-092</td>
                                    <td>Budi Santoso</td>
                                    <td class="text-muted small">Dr. Andi (Umum)</td>
                                    <td><span class="badge bg-warning text-dark bg-opacity-25 rounded-pill px-3">Menunggu Obat</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light">Detail</button></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">#RSP-091</td>
                                    <td>Siti Aminah</td>
                                    <td class="text-muted small">Dr. Sarah (Gigi)</td>
                                    <td><span class="badge bg-success bg-opacity-25 text-success rounded-pill px-3">Selesai</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light">Detail</button></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">#RSP-090</td>
                                    <td>Rina Melati</td>
                                    <td class="text-muted small">Dr. Andi (Umum)</td>
                                    <td><span class="badge bg-success bg-opacity-25 text-success rounded-pill px-3">Selesai</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light">Detail</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold text-dark mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <button class="btn btn-outline-primary text-start p-3 rounded-3 d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">+</div>
                            <div>
                                <h6 class="fw-bold mb-0">Buat Resep Baru</h6>
                                <span class="small text-muted">Input resep digital untuk pasien</span>
                            </div>
                        </button>

                        <button class="btn btn-outline-success text-start p-3 rounded-3 d-flex align-items-center">
                            <div class="bg-success text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">💊</div>
                            <div>
                                <h6 class="fw-bold mb-0">Tambah Master Obat</h6>
                                <span class="small text-muted">Update inventaris apotek</span>
                            </div>
                        </button>
                    </div>

                    <hr class="my-4 text-muted">

                    <h6 class="fw-bold text-dark mb-3">Notifikasi Sistem</h6>
                    <div class="alert alert-danger bg-opacity-10 border-0 border-start border-danger border-4 d-flex align-items-center" role="alert">
                        <div class="small">
                            <strong>Perhatian:</strong> Stok Paracetamol (500mg) tersisa 2 kotak. Segera lakukan restock.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
