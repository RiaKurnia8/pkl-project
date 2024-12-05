{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
    <style>
        table, td, th {
          border: 1px solid;
          text-align: center; /* Pusatkan teks secara horizontal */
          vertical-align: middle; /* Pusatkan teks secara vertikal */
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
    <h1 style="display: inline-block;">Data Dashboard</h1>
    <img id="logo-print" src="{{ base_path('public/assets/images/sasa.png') }}" alt="Logo" style="float: right; width: 100px; height: auto;">

    <div style=" border-radius: 5px;"> <!-- Padding dan border-radius -->
        <table class="table table-striped">
            <thead style="background-color: #dc3545; color: white;">
                <!-- Mengatur background merah hanya untuk thead -->
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Barang Dipinjam</th>
                    <th>Plant</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>
    </div>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
    <style>
        table, td, th {
            border: 1px solid;
            text-align: center;
            vertical-align: middle;
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
    <h1 style="display: inline-block;">Data Dashboard</h1>
    <img id="logo-print" src="{{ base_path('public/assets/images/sasa.png') }}" alt="Logo" style="float: right; width: 100px; height: auto;">

    <div style="border-radius: 5px;"> <!-- Padding dan border-radius -->
        <table class="table table-striped">
            <thead style="background-color: #dc3545; color: white;">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Barang Dipinjam</th>
                    <th>Plant</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamanData as $index => $peminjaman)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peminjaman->id }}</td>
                        <td>{{ $peminjaman->name }}</td>
                        <td>{{ $peminjaman->barang }}</td>
                        <td>{{ $peminjaman->plant }}</td>
                        <td>{{ $peminjaman->tanggal_pinjam }}</td>
                        <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
