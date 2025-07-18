
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        body { padding: 20px; max-width: 800px; margin: 0 auto; }
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
            background-color: #faeaea;
        }
        .data-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }
        .data-item:hover {
            background-color: #f8f9fa;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .detail-link {
            float: right;
            text-decoration: none;
        }
        .pagination { justify-content: center; margin-top: 20px; }
    </style>
</head>
<body>
    <!-- Header dengan tombol tambah -->
        <div class="header-container">
            <h2>Daftar Data</h2>
            <a href="{{ route('data.create') }}" class="btn btn-primary">
                + Tambah KK Baru
            </a>
        </div>

    <h2 class="mb-4">Daftar kartu keluarga</h2> 

        <table class="member-table">
                    <thead>
                        <tr>
                            <th>No.KK</th>
                            <th>Alamat</th>
                            <th>kepala keluarga</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fcard as $fc)
                        
                        <tr>
                            <td>{{ $fc->fc_number }}</td>
                            <td>{{ $fc->address }}</td>
                            <td>{{ $fc->kepala_kk }}</td>    
                            <td>
                                   
                                <form action="{{ route('data.delete' ,$fc->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick='return confirm("Apakah Anda yakin ingin menghapus data ini?")'>
                                        Hapus
                                    </button>
                                </form>

                                    <a href="{{ route('data.edit',$fc->id) }}" class="btn btn-sm btn-outline-primary">
                                        edit
                                    </a>

                                    <a href="{{ route('data.show',$fc->id) }}" class="btn btn-sm btn-outline-primary">
                                        lihat detail
                                    </a>
                                </td>
                                    
    
                        </tr>
                        
                        @endforeach
                    </tbody> 
                </table>

      {{-- <!-- Filter Form (opsional) -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form method="GET" action="">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>  
        
    
    <!-- Contoh data statis untuk preview -->
    @foreach ($fcard as $fc)  
<div class="data-item">
            <span class="fw-bold">No.KK: {{ $fc->fc_number }}</span> - 
            <a href="{{ route('data.show', $fc->id) }}" class="btn btn-sm btn-outline-primary detail-link">
                Lihat Report
            </a>
            <hr/>
            &nbsp;
    
           
            <a href="{{ route('data.edit', $fc->id) }}" class="btn btn-sm btn-outline-primary detail-link">
                Edit
            </a>
            
            <div class="clearfix"></div>

            <form action="{{ route('data.delete', $fc->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>

        </div>
        @endforeach --}}
        
        <!-- Pagination -->
        {{-- <div class="d-flex justify-content-center mt-4">
            {{ $fmember->links('name_view.custom_pagination') }}
        </div> 
    </div>  --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        body { padding: 20px; max-width: 800px; margin: 0 auto; }
        .body {
            font-family: 'Times New Roman', serif;
            margin: 0 auto;
            padding: 15px;
        }
        .kk-container {
            border: 2px solid #0e1016;
            padding: 20px;
            width: 700px;
            margin: 0 auto;
        }
        .kk-header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .kk-header h2 {
            margin: 0;
            font-size: 24px;
        }
        .kk-header p {
            margin: 5px 0 0;
            font-weight: bold;
            font-size: 18px;
        }
        .kk-body table {
            width: 100%;
        }
        .kk-body table td {
            vertical-align: top;
            padding: 5px 0;
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
        .data-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }
        .data-item:hover {
            background-color: #f8f9fa;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .detail-link {
            float: right;
            text-decoration: none;
        }
        .pagination { justify-content: center; margin-top: 20px; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif  
    <h2 class="mb-4">Daftar kartu keluarga</h2> 

        {{-- <!-- Filter Form (opsional) -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form method="GET" action="">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>   --}} 

         <!-- Header dengan tombol tambah -->
         {{-- <div class="header-container">
            <h2>Daftar Data</h2>
            <a href="{{ route('data.create') }}" class="btn btn-primary">
                + Tambah KK Baru
            </a>
        </div>
     --}}
    <!-- Contoh data statis untuk preview -->
     {{-- @foreach ($fcard as $fc)  
<div class="data-item">
            <span class="fw-bold">No.KK: {{ $fc->fc_number }}</span> - 

                <div class="body">
                    <div class="kk-container">
                        <div class="kk-header">
                            <h2>KARTU KELUARGA</h2>
                            <p>No. {{ $fc->fc_number }}</p>
                        </div>
                        <div class="kk-body">
                            <table>
                                <tr>
                                    <td style="width: 50%;">
                                        <p><strong>Alamat:</strong> {{ $fc->address }}</p>
                                        <p><strong>RT/RW:</strong> {{ $fc->rt_rw }}</p>
                                        <p><strong>Desa/Kelurahan:</strong> {{ $fc->ward }}</p>
                                    </td>
                                    <td style="width: 50%;">
                                        <p><strong>Kecamatan:</strong> {{ $fc->districk }}</p>
                                        <p><strong>Kabupaten/Kota:</strong> {{ $fc->regency }}</p>
                                        <p><strong>provinsi:</strong> {{ $fc->region }}</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            <a href="{{ route('data.show', $fc->id) }}" class="btn btn-sm btn-outline-primary detail-link">
                Lihat Report
            </a>
            <hr/>
        
            <a href="{{ route('data.edit', $fc->id) }}" class="btn btn-sm btn-outline-primary detail-link">
                Edit
            </a>
            
            <div class="clearfix"></div>

            <form action="{{ route('data.delete', $fc->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>

        </div>
        @endforeach --}}
        
        <!-- Pagination -->
        {{-- <div class="d-flex justify-content-center mt-4">
            {{ $fcard->links('pagination::bootstrap-5') }}
        </div> --}}
        
 

  {{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  --}} 