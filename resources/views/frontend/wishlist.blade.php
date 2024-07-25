@extends('frontend.partials.master')

@section('content')
<div class="container my-5">
    <h2>Your Wishlist</h2>

    @if ($wishlists->isEmpty())
        <p>Your wishlist is empty.</p>
    @else
        <div class="row">
            @foreach ($wishlists as $wishlist)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $wishlist->kalenderBeasiswa->judul }}</h5>
                            <p><strong>Tanggal Registrasi:</strong> {{ date('d F Y', strtotime($wishlist->kalenderBeasiswa->tanggal_registrasi)) }}</p>
                            <p><strong>Deadline:</strong> {{ date('d F Y', strtotime($wishlist->kalenderBeasiswa->deadline)) }}</p>
                            <a href="{{ route('detail', ['id' => $wishlist->kalenderBeasiswa->id]) }}" class="btn btn-primary">View Details</a>
                            <form action="{{ route('wishlist.remove', $wishlist->kalenderBeasiswa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning mt-2">Remove from Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
