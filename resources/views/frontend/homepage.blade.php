@extends('frontend.partials.master')

@section('content')
<!-- Masthead -->
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

@if (session('message') == 'No articles found')
    <script>
        window.onload = function() {
            document.querySelector('#KalenderBeasiswa').scrollIntoView();
        };
    </script>
@endif

<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="header">
                <h1>Filter Beasiswa</h1>
                <form id="filterForm" method="get" action="{{ route('beasiswa.filter') }}">
                    {{-- Tingkat Studi Filter --}}
                    <div class="form-group mt-4">
                        <label for="option_tingkat_studi">Tingkat Studi</label>
                        <select class="form-control multi-select" name="id_tingkat_studi[]" id="option_tingkat_studi" multiple>
                            @foreach ($tingkat_studi as $i)
                                <option value="{{ $i->id }}" {{ in_array($i->id, request('id_tingkat_studi', [])) ? 'selected' : '' }}>
                                    {{ $i->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jenis Beasiswa Filter --}}
                    <div class="form-group mt-4">
                        <label for="option_jenis_beasiswa">Jenis Beasiswa</label>
                        <select class="form-control multi-select" name="jenis_beasiswa[]" id="option_jenis_beasiswa" multiple>
                            <option value="Partial" {{ in_array('Partial', request('jenis_beasiswa', [])) ? 'selected' : '' }}>Partial</option>
                            <option value="Full" {{ in_array('Full', request('jenis_beasiswa', [])) ? 'selected' : '' }}>Full</option>
                        </select>
                    </div>

                    {{-- Negara Filter --}}
                    <div class="form-group mt-4">
                        <label for="option_negara">Negara</label>
                        <select class="form-control multi-select" name="id_negara[]" id="option_negara" multiple>
                            @foreach ($negara as $i)
                                <option value="{{ $i->id }}" {{ in_array($i->id, request('id_negara', [])) ? 'selected' : '' }}>
                                    {{ $i->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
                    <a href="{{ route('homepage') }}" class="btn btn-warning mt-3">Reset Filters</a>
                </form>
            </div>
        </div>

        <!-- Articles -->
        <div class="col-lg-9" id="KalenderBeasiswa">
            <section class="content">
                <div class="row" id="articleList">
                    @if($data->isEmpty())
                        <div class="col-12 text-center">
                            <h2>No articles found</h2>
                            <p>Sorry, but no articles matched your criteria. Please try adjusting your filters.</p>
                        </div>
                    @else
                        @foreach ($data as $index => $article)
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $article->judul }}</h5>
                                        <div class="bg-light p-3 mt-3">
                                            <p><strong>Tanggal Registrasi:</strong> {{ $article->tanggal_registrasi }}</p>
                                            <p><strong>Deadline:</strong> {{ $article->deadline }}</p>
                                            <div class="mb-3">
                                                <!-- Tingkat Studi -->
                                                <div>
                                                    <strong>Tingkat Studi:</strong>
                                                    @foreach ($article->tingkat_studi as $tingkat)
                                                        <span class="badge bg-primary">{{ $tingkat->nama }}</span>
                                                    @endforeach
                                                </div>

                                                <!-- Jenis Beasiswa -->
                                                <div class="mt-2">
                                                    <strong>Jenis Beasiswa:</strong>
                                                    @foreach ((array) $article->jenis_beasiswa as $jenis)
                                                        <span class="badge bg-secondary">{{ $jenis }}</span>
                                                    @endforeach
                                                </div>

                                                <!-- Negara -->
                                                <div class="mt-2">
                                                    <strong>Negara:</strong>
                                                    @foreach ($article->negara as $negara)
                                                        <span class="badge bg-success">{{ $negara->nama }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('detail', ['id' => $article->id]) }}#DetailKalenderBeasiswa" class="btn btn-primary mt-3">Go to Detail Kalender Beasiswa</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Multi-Select Library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize MultiSelectTag
    new MultiSelectTag('option_tingkat_studi');
    new MultiSelectTag('option_jenis_beasiswa');
    new MultiSelectTag('option_negara');
});
</script>
@endsection