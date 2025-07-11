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
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">FORMULIR KARTU KELUARGA BARU</h3>
            </div>

            <div class="card-body">
               <form action="{{ route('data_m.store') }}" method="POST">
                @csrf
                
                    <!-- Data Kepala Keluarga -->
                    <div class="form-section">
                        <h4 class="section-title">data anggota</h4>
                        <div class="row g-3">
                            <div class="form-group">
                            <div class="col-md-6">
                                <label for="familycard_id, " class="form-label required-field">No.KK</label>
                                <input type="text" class="form-control" id="familycard_id" name="familycard_id" value="{{ old('fc_number', $fcard->fc_number) }}" readonly>
                                <input type="hidden" class="form-control" id="familycard_id" name="familycard_id"  value="{{ old('familycard_id', $fcard->id) }}" required>
                            </div>
                             <div class="col-md-6">
                                <label for="full_name" class="form-label required-field">Nama Lengkap</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                             <div class="col-md-6">
                                <label for="pin" class="form-label required-field">NIK</label>
                                <input type="text" class="form-control" id="pin" name="pin" required>
                            </div>
                             <div class="col-md-4">
                                <label for="gender" class="form-label required-field">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="place_of_birth" class="form-label required-field">Tempat Lahir</label>
                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" required>
                            </div>
                            <div class="col-md-4">
                                <label for="date_of_birth" class="form-label required-field">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            </div>
                            <div class="col-md-4">
                                <label for="education" class="form-label required-field">Pendidikan</label>
                                <input type="text" class="form-control" id="education" name="education" required>
                            </div>
                            <div class="col-md-4">
                                <label for="employment" class="form-label required-field">Pekerjaan</label>
                                <input type="text" class="form-control" id="employment" name="employment" required>
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