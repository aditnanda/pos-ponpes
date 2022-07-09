@extends('layouts.master')

@section('title')
    Transaksi Penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Penjualan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="alert alert-info alert-dismissible">
                <i class="fa fa-info icon"></i>
                Petunjuk Tombol Cepat di Keyboard
                <ul>
                    <li>Tombol P : Untuk Cetak Nota</li>
                    <li>Tombol N : Untuk Transaksi Baru</li>
                </ul>
            </div>
            <div class="box-body">
                <div class="alert alert-success alert-dismissible">
                    <i class="fa fa-check icon"></i>
                    Data Transaksi telah selesai.
                </div>
            </div>
            <div class="box-footer">
                @if ($setting->tipe_nota == 1)
                <button class="btn btn-warning btn-flat" onclick="notaKecil('{{ route('transaksi.nota_kecil') }}', 'Nota Kecil')">Cetak Ulang Nota</button>
                @else
                <button class="btn btn-warning btn-flat" onclick="notaBesar('{{ route('transaksi.nota_besar') }}', 'Nota PDF')">Cetak Ulang Nota</button>
                @endif
                <a href="{{ route('transaksi.baru') }}" class="btn btn-primary btn-flat">Transaksi Baru</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // tambahkan untuk delete cookie innerHeight terlebih dahulu
    document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    
    var newWindow;

    function notaKecil(url, title) {
        popupCenter(url, title, 625, 500);
    }

    function notaBesar(url, title) {
        popupCenter(url, title, 900, 675);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
        const dualScreenTop  = window.screenTop  !==  undefined ? window.screenTop  : window.screenY;

        const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left       = (width - w) / 2 / systemZoom + dualScreenLeft
        const top        = (height - h) / 2 / systemZoom + dualScreenTop
        newWindow  = window.open(url, title, 
        `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
        );

        if (window.focus) newWindow.focus();

        newWindow.onfocus = function () { setTimeout(function () { newWindow.close(); }, 500); }

    }

    document.onkeypress = function (e) {
        e = e || window.event;
        // use e.keyCode
        // console.log(e.keyCode);
        if (e.keyCode == 110) {
            window.location = "{{ route('transaksi.baru') }}";
        }
        if (e.keyCode == 112) {
            notaKecil('{{ route('transaksi.nota_kecil') }}', 'Nota Kecil');
        }
    };

    
</script>
@endpush