@extends('layout.master')
@section('content')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-telex">Gallify</h3>
        </div>
    </section>
    <section class="max-w-[500px] mx-auto ">
        <div class="max-[480px]:w-full">
            <form action="/updatepassword" method="POST">
                @csrf
                <div class="bg-white rounded-md shadow-md ">
                    <div class="flex flex-col px-4 py-4 ">
                        <h5 class="text-3xl text-center font-hurricane">Change Your Password</h5>
                        <h5>Old Password</h5>
                        <input type="password" name="current_password" value="" class="py-1 rounded-md">
                        <h5>new Password</h5>
                        <input type="password" name="new_password" value="" class="py-1 rounded-md">
                        <h5>confirm Password</h5>
                        <input type="password"name="new_password_confirmation" class="py-1 rounded-md">
                        <button type="submit" class="py-2 mt-4 text-white rounded-md bg-blue-600">Perbaharui</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
@endsection
