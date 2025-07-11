<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kartu Keluarga Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card-header {
            font-weight: bold;
            text-align: center;
        }
        .member-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #000;
        }
        .member-table th, .member-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        .member-table th {
            background-color: #f2f2f2;
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
        .data-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">EDIT FORMULIR KARTU KELUARGA </h3>
            </div>

            <div class="card-body">
               <form action="{{ route('data.update', $fcard->id) }}" method="POST">
                @csrf
                @method('PUT')

                    <!-- Data Alamat Keluarga -->
                    <div class="form-section">
                        <h4 class="section-title">KARTU KELUARGA</h4>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fc_number" class="form-label required-field">Nomor Kartu Keluarga</label>
                                <input type="text" class="form-control" id="fc_number" name="fc_number" value="{{ old('fc_number', $fcard->fc_number) }}" required>
                             </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label required-field">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $fcard->address) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="rt_rw" class="form-label required-field">RT/rw</label>
                                <input type="text" class="form-control" id="rt_rw" name="rt_rw" value="{{ old('rt_rw', $fcard->rt_rw) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ward" class="form-label required-field">Desa/Kelurahan</label>
                                <input type="text" class="form-control" id="ward" name="ward" value="{{ old('ward', $fcard->ward) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="districk" class="form-label required-field">Kecamatan</label>
                                <input type="text" class="form-control" id="districk" name="districk" value="{{ old('districk', $fcard->districk) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="regency" class="form-label required-field">Kabupaten/Kota</label>
                                <input type="text" class="form-control" id="regency" name="regency" value="{{ old('regency', $fcard->regency) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="region" class="form-label">provinsi</label>
                                <input type="text" class="form-control" id="region" name="region" value="{{ old('region', $fcard->region) }}" required>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="reset" class="btn btn-secondary me-md-2"><a href="{{ route('data.show', $fcard->id) }}">Kembali</a></button>
                                <button type="submit" class="btn btn-primary">Simpan Kartu Keluarga</button>
                            </div>
                        </div>
                   </form>
                </div>  
        
            <div class="card-body">
                <div class="form-section">
                    <h4 class="section-title">ANGGOTA KELUARGA</h4>
                </div> 
                 {{-- <P> ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
                     <a href="{{ route('data_m.create', $fcard->id) }}" class="btn btn-sm btn-outline-primary detail-link">
                        tambah anggota
                    </a> 
                {{-- </P>             --}}
                <table class="member-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>pendidikan</th>
                                <th>Pekerjaan</th>
                                <th>#</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($fmember as $item)
                            <tr>
                                <td>{{ ($fmember->currentPage() - 1) * $fmember->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->pin }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->place_of_birth }}</td>
                                <td>{{ $item->date_of_birth }}</td>
                                <td>{{ $item->education }}</td>
                                <td>{{ $item->employment }}</td>
                                <td>
                                    <a href="{{ route('data_m.edit',$item->id) }}" class="btn btn-sm btn-outline-primary detail-link">
                                    edit
                                    </a>
                                
                                <form action="{{ route('data_m.delete' ,$item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick='return confirm("Apakah Anda yakin ingin menghapus data ini?")'>
                                        Hapus
                                    </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>    
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
</html>