@extends('layout.master')
@section('content')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-telex">Gallify</h3>
        </div>
    </section>
    <section class="max-w-screen-md mx-auto ">
        <form action="/ubahprofil" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap justify-between flex-container">
                <div class="flex flex-col items-center w-2/6 bg-white rounded-md shadow-md max-[480px]:w-full">
                    <img src="/pic/{{ old('foto_profil', Auth::User()->foto_profil) }}" alt=""
                        class="mt-[40px] rounded-full w-36 h-36">
                    <input type="file" name="file" class="items-center w-48 h-9 mt-4 border rounded-md">
                    <button type="submit" class="w-48 py-1 mt-4 text-white rounded-md bg-blue-600">Ubah Photo</button>
                </div>

        </form>
        <div class="w-3/5 max-[480px]:w-full">
            <form action="/updateprofil" method="POST" enctype="multipart/form-data" class="">
                @csrf
                <div class="bg-white rounded-md shadow-md ">
                    <div class="flex flex-col px-4 py-4 ">
                        <h5 class="text-3xl text-center font-">Your Profile</h5>
                        <h5>Username</h5>
                        <input type="text" name="username" value="{{ $dataprofile->username }}"
                            class="py-1 rounded-md border border-gray-700">
                        <h5>No Telepon</h5>
                        <input type="text" name="no_telephone" value="{{ $dataprofile->no_telephone }}"
                            class="py-1 rounded-md border border-gray-700">
                        <h5>Jenis Kelamin</h5>
                        <select name="jenis_kelamin" id="" class="py-1 rounded-md">
                            @foreach (['Laki-laki', 'Perempuan'] as $option)
                                <option value="{{ $option }}"
                                    {{ $option == $dataprofile->jenis_kelamin ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        <h5>Alamat</h5>
                        <textarea type="text"name="alamat" value="{{ $dataprofile->alamat }}" class="py-1 rounded-md border border-gray-700">

                    </textarea>
                        <h5>Bio</h5>
                        <textarea type="text" name="bio" value="{{ $dataprofile->bio }}" class="py-1 rounded-md border border-gray-700">

                    </textarea>
                        <button type="submit"
                            class="py-2 mt-4 bg-blue-600 text-white rounded-md bg-biru">Perbaharui</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
@endsection
