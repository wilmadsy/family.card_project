
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Keluarga</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* @media print {
            body { padding: 0; }
            .no-print { display: none !important; }
            .print-table { width: 100%; border-collapse: collapse; }
            .print-table th, .print-table td { border: 1px solid #000; padding: 8px; }
        } */
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 20px;
        }
        .kk-container {
            border: 2px solid #0e1016;
            padding: 20px;
            width: 800px;
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
        .action-buttons {
            margin-top: 20px;
            text-align: right;
        }
        .action-buttons a {
            display: inline-block;
            padding: 8px 15px;
            margin-left: 10px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
        }
        .btn-back {
            background-color: #6c757d;
        }
        .btn-edit {
            background-color: #007bff;
        }
    </style>   
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
    <div class="kk-container">
        <div class="kk-header">
            <h2>KARTU KELUARGA</h2>
            <p>No. {{ $fcard->fc_number; }}</p>
        </div>
        
            <div class="kk-body">
                <table>
                    <tr>
                        <td style="width: 50%;">
                            <p><strong>Alamat:</strong> {{ $fcard->address; }}</p>
                            <p><strong>RT/RW:</strong> {{ $fcard->rt_rw; }}</p>
                            <p><strong>Desa/Kelurahan:</strong> {{ $fcard->ward; }}</p>
                        </td>
                        <td style="width: 50%;">
                            <p><strong>Kecamatan:</strong> {{ $fcard->districk; }}</p>
                            <p><strong>Kabupaten/Kota:</strong> {{ $fcard->regency; }}</p>
                            <p><strong>provinsi:</strong> {{ $fcard->region; }}</p>
                        </td>
                    </tr>
                </table>
            
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fmember as $fc => $item)
                        <tr>
                            <td>{{ ($fmember->currentPage() - 1) * $fmember->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->full_name }}</td>
                            <td>{{ $item->pin }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->place_of_birth }}</td>
                            <td>{{ $item->date_of_birth }}</td>
                            <td>{{ $item->education }}</td>
                            <td>{{ $item->employment }}</td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
                {{ $fmember->links() }}
                
                @if (strpos(url()->current(),'pdf') == false)
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

                    <hr>
                    <a href="{{ route('data.index') }}" class="btn btn-sm btn-outline-primary detail-link">Kembali</a>
                    
                    <a href="{{ route('data.edit', $fcard->id) }}" class="btn btn-sm btn-outline-primary detail-link">Edit</a> 
                    
                    <a href="/kk/pdf/{{ $fcard->id }}" class="btn btn-sm btn-outline-primary detail-link">Pdf</a>    
                    
                
                @endif
            </div> 
            
        </div>
    </div>
</body>
</html>