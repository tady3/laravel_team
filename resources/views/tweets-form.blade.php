<x-app-layout>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8">

                <x-tweet-form :tags=$tags/> {{-- 追記 --}}

            </div>
        </div>
    </div>
</x-app-layout>