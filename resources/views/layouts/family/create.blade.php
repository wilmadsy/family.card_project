<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kartu Keluarga Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card-header {
            font-weight: bold;
            text-align: center;
        }
        .form-section {
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .section-title {
            color: #0d6efd;
            margin-bottom: 20px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 5px;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: "terjadi kesalahan",
                text: "@foreach($errors->all() as $error) {{ $error }} @endforeach",
                icon: "error"
            });
        </script>
    @endif
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">FORMULIR KARTU KELUARGA BARU</h3>
            </div>

            <div class="card-body">
               <form action="{{ route('data.store') }}" method="POST">
                @csrf

                    <!-- Data Alamat Keluarga -->
                    <div class="form-section">
                        <h4 class="section-title">DATA KELUARGA</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fc_number" class="form-label required-field">Nomor Kartu Keluarga</label>
                                <input type="text" class="form-control" id="fc_number" name="fc_number" required>
                                @error('fc_number')
                                    <span class="invalid-feedback">{{ $message }}</span>                          
                                @enderror
                             </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label required-field">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>                          
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="rt_rw" class="form-label required-field">RT/rw</label>
                                <input type="text" class="form-control" id="rt_rw" name="rt_rw" required>
                                @error('rt_rw')
                                    <span class="invalid-feedback">{{ $message }}</span>                          
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="ward" class="form-label required-field">Desa/Kelurahan</label>
                                <input type="text" class="form-control" id="ward" name="ward" required>
                                @error('ward')
                                    <span class="invalid-feedback">{{ $message }}</span>                          
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="districk" class="form-label required-field">Kecamatan</label>
                                <input type="text" class="form-control" id="districk" name="districk" required>
                                @error('disrtick')
                                    <span class="invalid-feedback">{{ $message }}</span>                          
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="regency" class="form-label required-field">Kabupaten/Kota</label>
                                <input type="text" class="form-control" id="regency" name="regency" required>
                                @error('regency')
                                    <span class="invalid-feedback">{{ $message }}</span>                          
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="region" class="form-label">provinsi</label>
                                <input type="text" class="form-control" id="region" name="region">
                                @error('region')
                                    <span class="invalid-feedback">{{ $message }}</span>                          
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <!-- Data Anggota Keluarga -->
                    <div class="form-section">
                        <h4 class="section-title">ANGGOTA KELUARGA</h4>
                        <div id="anggota-container">
                            <!-- Anggota keluarga akan ditambahkan di sini melalui JavaScript -->
                        </div>
                        <button type="button" id="tambah-anggota" class="btn btn-outline-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Tambah Anggota Keluarga
                        </button>
                    </div> --}}

                    <!-- Tombol Submit -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="reset" class="btn btn-secondary me-md-2"><a href="{{ route('data.index') }}">Kembali</a></button>
                        <button type="reset" class="btn btn-secondary me-md-2">Reset Form</button>
                        <button type="submit" class="btn btn-primary">Simpan Kartu Keluarga</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
</html>