<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center;
        }
        
        @page { margin-top: 0px; }
        body { margin-top: 0px; }
        
        .page_break { page-break-before: always; }

    </style>
</head>
<body>
    <table width="100%">
        <tr>
            @php
            $nand = 0;
            @endphp
            @foreach ($dataproduk as $key => $produk)

                @if ($dataprodukqr[$key])
                    @for ($i = 0; $i < $dataprodukqr[$key]; $i++)
                    @php
                        $nand++;
                        @endphp
                        <td class="text-center" style="border: 1px solid #333;">
                            <p style="margin-top:4px;">{{ $produk->nama_produk }} - Rp. {{ format_uang($produk->harga_jual) }}</p>
                            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk->kode_produk, 'C39') }}" 
                                alt="{{ $produk->kode_produk }}"
                                width="180"
                                height="50">
                            <br>
                            
                            <p style="margin-bottom:10px;margin-top:2px;">{{ $produk->kode_produk }}</p>
                        </td>
                        @if ($no++ % 3 == 0)
                        @if($nand == 12)
                            </tr>
                            <div class="page_break"></div>
                             @php
                            $nand = 0;
                            @endphp
                            <tr>
                        @else
                        
                        
                        
                            </tr><tr>
                        @endif
                        @endif
                        
                    @endfor
                @endif
                
            @endforeach
        </tr>
    </table>
</body>
</html>