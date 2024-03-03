@extends('layout.master')
@push('cssjsexternal')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@section('content')
<section class="mt-32">
    <div class="items-center max-w-screen-md mx-auto ">
        <h3 class="text-5xl text-center font-telex">Gallify</h3>
    </div>
</section>
<section class="mt-10">
    @csrf
    <div class="max-w-screen-md mx-auto">
        <div class="flex flex-wrap items-center flex-container gap-2" id="exploredata">

        </div>
    </div>
</section>
@endsection
@push('footerjsexternal')
    <script src="/javascript/explore.js"></script>
@endpush
