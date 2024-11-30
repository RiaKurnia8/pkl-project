<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table,
        td,
        th {
            border: 1px solid;
            text-align: center;
            /* Pusatkan teks secara horizontal */
            vertical-align: middle;
            /* Pusatkan teks secara vertikal */
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

            /* Show the logo next to Data Disposal title when printing */
            #logo-print {
                display: inline-block;
                vertical-align: middle;
                margin-right: 20px;
            }

            #data-disposal-title {
                display: inline-block;
                vertical-align: middle;
            }
        }

        /* Hide logo by default on screen */
        /* #logo-print {
            display: none;
        } */
    </style>
</head>

<body>
    <div style="margin-bottom: 20px; position: relative;">
        <h1 style="display: inline-block;">Data Disposal</h1>
        <p><strong>Tanggal Export:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }} </p>
        <p><strong>Di Export Oleh:</strong> {{ Auth::user()->name }}</p>
        <img id="logo-print" src="{{ base_path('public/assets/images/sasa.png') }}" alt="Logo"
            style="position: absolute; top: 0; right: 0; width: 100px; height: auto;">
    </div>
    <!-- Tabel Data Barang -->
    <div style=" border-radius: 5px;"> <!-- Padding dan border-radius -->
        <table class="table table-striped">
            <thead style="background-color: #dc3545; color: white;">
                <!-- Mengatur background merah hanya untuk thead -->
                <tr class="text-center">
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Barang</th>
                    <th>No.Asset</th>
                    <th>No.Equipment</th>
                    <th>Kategori</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>SN</th>
                    <th>Foto</th>
                    <th>Tanggal Disposal</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($datadisposal as $i => $data)
                    <!-- Contoh data barang (ini akan diganti dengan data dari database) -->
                    <tr class="text-center">
                        {{-- <th scope="row">{{ $i + 1 }}</th> --}}
                        <th scope="row">{{ $i + 1 }}</th>
                        <td>{{ $data->lokasi }}</td>
                        <td>{{ $data->barang }}</td>
                        <td>{{ $data->no_asset }}</td>
                        <td>{{ $data->no_equipment }}</td>
                        <td>{{ $data->kategori->nama_kategori ?? 'Kategori tidak tersedia' }}</td>
                        <!-- Ambil nama kategori -->
                        <td>{{ $data->merk }}</td>
                        <td>{{ $data->tipe }}</td>
                        <td>{{ $data->sn }}</td>
                        <td><img src="{{ public_path('img/' . $data->foto) }}?{{ time() }}" width="100"
                                height="100"></td>
                        <td>{{ $data->updated_at->format('d-m-Y ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
