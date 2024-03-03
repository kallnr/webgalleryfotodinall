@extends('layout.master')
@section('content')
    {{-- @push('cssjsexternal')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush --}}
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-telex">Gallify</h3>
        </div>
    </section>
    <section class="mt-10">
        @csrf
        <div class="max-w-screen-md mx-auto">
            <div class="flex flex-wrap items-center flex-container gap-2" id="exploredata">
                @foreach ($dataalbum as $item)
                    <div class="flex mt-2 bg-white rounded-md shadow-2xl">
                        <div class="flex flex-col px-2">
                            <a href="">
                                <div class="w-[363px] h-[192px] bg-bgcolor2 bg-cover" style="background-image: url('/postingan/{{ $item->lokasi_file }}');">
                                    {{-- <img src=""
                                        class="w-[363px] h-[192px] transition duration-500 ease-in-out hover:scale-105"> --}}
                                </div>
                            </a>
                            <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                                <div>
                                    <div class="flex flex-col">
                                        <div>
                                            {{ $item->judul_foto }}
                                        </div>
                                        <div class="text-xs text-gray-600">
                                            {{ $item->deksripsi_foto }}
                                        </div>
                                    </div>
                                </div>
                                <div>

                                    {{-- <span class="bi bi-chat-left-text" ahref="/explore-detail/"></span>
                    <small></small>
                    <span class="bi ${x.idUserLike === x.useractive ? 'bi-heart-fill' : 'bi-heart' }" onclick="likes()"></span>
                    <small></small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
{{-- @push('footerjsexternal')
    <script src="/javascript/postingan.js"></script>
    <script src="/javascript/album.js"></script>
@endpush --}}
