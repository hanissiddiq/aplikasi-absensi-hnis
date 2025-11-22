@extends('templates.app')
@section('container')
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <div class="tf-tab">
                <div class="content-tab pt-tab-space mb-5">
                    <div class="tab-gift-item">
                        @foreach ($informasi as $inf)
                            <div class="food-box">
                                <div class="img-box">
                                    <a href="{{ url('/informasi-user/show/'.$inf->id) }}"><img src="{{ url('/storage/'.$inf->berita_file_path) }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;"></a>
                                </div>
                                <div class="content">
                                    <h4><a href="{{ url('/informasi-user/show/'.$inf->id) }}">{{ $inf->judul }}</a></h4>
                                    <div class="rating mt-2">
                                        {{ Str::limit($inf->isi, 50, '.......') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection
