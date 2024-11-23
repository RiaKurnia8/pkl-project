<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, td, th {
            border: 1px solid;
            text-align: center; /* Menambahkan perataan teks ke tengah */
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }
    
        img {
            max-width: 100%;
            height: auto;
        }
    
        @media print {
            table {
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            thead {
                display: table-header-group;
            }
            tfoot {
                display: table-footer-group;
            }
        }
    </style>
</head>

<body>
    <h1 style="display: inline-block;">Data Pengembalian</h1>
    <img id="logo-print" src="{{ base_path('public/assets/images/sasa.png') }}" alt="Logo" style="float: right; width: 100px; height: auto;">
    <!-- Tabel Data Pengembalian -->
    <div style=" border-radius: 5px;"> <!-- Padding dan border-radius -->
        <table class="table table-striped">
            <thead style="background-color: #dc3545; color: white;">
                <!-- Mengatur background merah hanya untuk thead -->
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Username</th>
                    <th>Plant</th>
                    <th>Barang dipinjam</th>
                    <th>Tanggal pengembalian</th>
                    <th>Keperluan</th>
                    <th>Notes</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalian as $i => $data)
                    <!-- Contoh data barang (ini akan diganti dengan data dari database) -->
                    <tr>
                        {{-- <th scope="row">{{ $i + 1 }}</th> --}}
                        <th scope="row">{{ $i + 1 }}</th>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->plant }}</td>
                        <td>{{ $data->barang_dipinjam }}</td>
                        <td>{{ $data->tanggal_pengembalian }}</td>
                        <td>{{ $data->keperluan }}</td>
                        <td>{{ $data->notes }}</td>
                        <td>{{ $data->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
