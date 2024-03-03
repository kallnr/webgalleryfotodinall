@extends('layout.master')
@section('content')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-telex">Gallify</h3>
        </div>
    </section>
    <section>
        <div class="flex flex-col items-center max-w-screen-md px-2 mx-auto mt-7">
            <div>
                <img src="/pic/{{ old('foto_profil', Auth::User()->foto_profil) }}" alt=""
                    class="rounded-full w-14 h-14">
            </div>
            <h3 class="text-xl font-semibold">
                {{ $dataprofile->username }}
            </h3>
            <small class="text-xs ">{{ $dataprofile->bio }}</small>
            <div class="flex flex-row mt-3">
                <a href="follower">
                    <small class="mr-4 text-abuabu" id="jumlahpengikut"></small></small>
                </a>
                <a href="following">
                    <small class="text-abuabu" id="jumlahmengikuti"></small>
                </a>

            </div>

            <div class="flex ml-[20px] mt-4 sm:pl-[250px]">
                <a href="/editprofil"
                    class="bg-blue-600 text-white border border-gray-300 focus:outline-none font-medium rounded-lg text-xs px-3 py-1 me-1 mb-2"
                    type="button">
                    edit profile
                </a>
                <a href="/password&username"
                    class="bg-blue-600 text-white border border-gray-300 focus:outline-none font-medium rounded-lg text-xs px-3 py-1 me-2 mb-2"
                    type="button">
                    edit password
                </a>
            </div>

        </div>
    </section>



    <!-- Tabs Menu -->
    <div class="mb-4  border-gray-200 dark:border-gray-700 mx-4 -sm:pl-[40px]">
        <ul class="flex flex-wrap  text-sm font-medium text-center justify-center gap-2 lg:justify-normal md:justify-normal sm:pl-[260px] sm:justify-normal"
            id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="unggahan-tab" data-tabs-target="#unggahan"
                    type="button" role="tab" aria-controls="unggahan" aria-selected="false">Post</button>
            </li>
            <li class="" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="album-tab" data-tabs-target="#album" type="button" role="tab" aria-controls="album"
                    aria-selected="false">Album</button>
            </li>

        </ul>
    </div>

    <div id="default-tab-content">
        <!-- unggahan -->
        <div class="hidden p-4 rounded-lg bg-putih mb-14 dark:bg-slate-800" id="unggahan" role="tabpanel"
            aria-labelledby="unggahan-tab">
            {{-- <div class="max-w-screen-md columns-2 gap-2 mx-auto  space-y-2 lg:columns-3"> --}}
            <section class="">
                <div class="max-w-screen-lg mx-auto flex flex-wrap  flex-container gap-2">
                    @foreach ($unggahan as $foto)
                        <div class="flex mt-2 mx-auto">
                            <div class="mx-auto mt-2 flex flex-col px-2 py-4 bg-white shadow-md rounded-md">

                                <div class="w-[363px] h-[192px] overflow-hidden rounded-md">
                                    <a href="/explore-detail/{{$foto->id}}"> <img src="/postingan/{{ $foto->lokasi_file }}" alt=""
                                        class="w-full transtion duration-500 ease-in-out hover:scale-105"></a>
                                </div>

                                <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                                    <div>
                                        <div class="flex flex-col">
                                            <div class="font-bold">
                                                {{ $foto->judul_foto }}
                                            </div>
                                            <div>
                                                {{ $foto->deksripsi_foto }}
                                            </div>

                                        </div>
                                    </div>
                                    <!-- <div>
                                                                            <a href="/beranda_detail/${x.id}">
                                                                                <span class="bi bi-chat-left-text"></span></a>

                                                                                <small>${x.jml_komen}</small>
                                                                                <i class="bi ${x.idUserLike === x.useractive ? 'heart-fill' : 'bi-heart' } bi-heart"
                                                                                    onclick="likes(this, ${x.id})"></i>
                                                                                <small>${x.jml_like}</small>
                                                                            </div> -->
                                </div>
                            </div>

                        </div>
                    @endforeach


                </div>
        </div>
        <!-- Album -->
        <div class="hidden p-4 rounded-lg mb-14" id="album" role="tabpanel" aria-labelledby="album-tab">


            <div class="max-w-screen-md mx-auto grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($dataalbum as $item)
                    <div>
                        <a href="/album/{{ $item->id }}"><img class="h-auto max-w-full rounded-lg"
                                src="/assets/album.png" alt=""></a>
                        <div class="mt-2">
                            <h2 class="text-[16px] font-semibold">
                                {{ $item->Nama_Album }}
                            </h2>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

        <!-- End Tabs Menu -->
        <!-- end konten -->








    </div>
    </div>
    </div>
@endsection
