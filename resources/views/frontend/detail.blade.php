@extends('frontend.partials.master')

@section('content')
<!-- Masthead-->
<header class="masthead" id="Homepage">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold">Detail Kalender Beasiswa</h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 mb-5">Mulai Cari Beasiswa Untuk Studi Mu</p>
            </div>
        </div>
    </div>
</header>

<!-- Detail Kalender Beasiswa -->
<section class="page-section" id="DetailKalenderBeasiswa">
    <div class="container">
        <h1>{{ $data->judul }}</h1>
        <h2>Tentang</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <div>
                    <strong>Tingkat Studi:</strong>
                    <ul>
                        @foreach ($data->tingkat_studi as $tingkat)
                            <li>{{ $tingkat->nama }}</li>
                        @endforeach
                    </ul>
                    <strong>Negara:</strong>
                    <ul>
                        @foreach ($data->negara as $neg)
                            <li>{{ $neg->nama }}</li>
                        @endforeach
                    </ul>
                    <strong>Tanggal Registrasi:</strong> {{ date('d-m-Y', strtotime($data->tanggal_registrasi)) }}<br>
                    <strong>Deadline:</strong> {{ date('d-m-Y', strtotime($data->deadline)) }}<br>
                    <strong>Judul:</strong> {{ $data->judul }}<br>
                    <strong>Deskripsi:</strong> {{ $data->deskripsi }}<br>
                    <strong>Jenis Beasiswa:</strong> {{ $data->jenis_beasiswa }}<br>
                </div>
            </li>
        </ul>
    </div>

    {{-- Container Keuntungan --}}
    <div class="container">
        <h2>Keuntungan</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Keuntungan:</strong> {{ $data->keuntungan }}<br>
            </li>
        </ul>
    </div>

    {{-- Container Persyaratan --}}
    <div class="container">
        <h2>Persyaratan</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Umur:</strong> {{ $data->umur }}<br>
                <strong>GPA:</strong> {{ $data->gpa }}<br>
                <strong>Tes English:</strong> {{ $data->tes_english }}<br>
                <strong>Tes Bahasa Lain:</strong> {{ $data->tes_bahasa_lain }}<br>
                <strong>Tes Standard:</strong> {{ $data->tes_standard }}<br>
                <strong>Dokumen:</strong> {{ $data->dokumen }}<br>
                <strong>Lainnya:</strong> {{ $data->lainnya }}<br>
            </li>
        </ul>
    </div>
</section>
<!-- /Kalender Beasiswa -->
@endsection
