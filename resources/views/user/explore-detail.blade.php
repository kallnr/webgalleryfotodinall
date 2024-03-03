@extends('layout.master')
@section('content')
    @push('cssjsexternal')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-telex">Gallify</h3>
        </div>
    </section>
    <section class="mt-10">
        @csrf
        <div class="max-w-screen-md mx-auto">
            <div class="flex flex-wrap px-2 flex-container">
                <div class="w-3/5 max-[480px]:w-full">
                    <div class="flex justify-center w-[363px] h-[192px] overflow-hidden">
                        <img src="" id="fotodetail" alt=""
                            class="w-full rounded-md transition duration-500 ease-in-out hover:scale-105">
                    </div>
                    <div class="flex flex-col px-2">
                        <div class="font-semibold" id="judulfoto">

                        </div>

                        <div class="text-slate-500 text-sm" id="deksripsifoto">
                            <!--album-->
                        </div>
                    </div>


                </div>
                <div class="w-2/5  max-[480px]:w-full">
                    <div class="flex flex-wrap items-center justify-between ">
                        <div class="flex flex-row items-center gap-2">
                            <div>
                                <img src="" id="fotoprofil" class="w-10 h-10 rounded-full" alt="">
                            </div>
                            <div class="flex flex-col">

                                    <a href="{{ route('otherpin', $keotherpin->users->id) }}" class="text-md" id="username"></a>


                            </div>
                        </div>
                        {{-- <div>
                            <button
                                class="bg-blue-700 px-4 rounded-full transition duration-500 ease-in-out hover:scale-105"><span
                                    class="text-white" id="tombolfollow">ikuti</span></button>
                        </div> --}}
                    </div>
                    <div class="mt-[33px]">
                        Comments
                    </div>
                    <div class="relative flex flex-col overflow-y-auto h-[200px] scrollbar-hidden" id="komentar">

                    </div>
                    <div class="flex gap-2 mt-2">
                        <div class="w-3/4">
                            <input type="text" name="textkomentar" id="textkomentar" placeholder="Tulis Komen..."
                                class="w-full px-2 py-1 rounded-full border-slate-500 transition duration-500 ease-in-out hover:scale-105">
                        </div>
                        <button
                            class="px-4 rounded-full bg-blue-700 transition duration-500 ease-in-out hover:scale-105"><span
                                class="text-white bi bi-send " onclick="kirimkomentar()"></span></button>
                    </div>
                </div>

    </section>
    <div class="max-w-screen-md mx-auto">
        <div class="flex flex-wrap items-center flex-container gap-2" id="exploredatapostingan">

        </div>
    </div>
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
@endsection
@push('footerjsexternal')
    <script src="/javascript/exploredetail.js"></script>
@endpush
