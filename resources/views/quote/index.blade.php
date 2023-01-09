@extends('quote.master')

@section('content')
<section>
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-lg-6">

                <!-- CUSTOM BLOCKQUOTE -->
                <blockquote class="blockquote blockquote-custom bg-white p-5 shadow rounded">
                    <a href="{{ route('quote.create') }}">
                        <div class="blockquote-custom-icon bg-info shadow-sm"><i class="fa-solid fa-quote-left text-white"></i></div>
                    </a>
                    <p class="mb-0 mt-2 font-italic">{{ ucfirst($data['quote']) }}</p>
                    <footer class="blockquote-footer pt-4 mt-4 border-top">
                        <cite title="Source Title">{{ $data['by'] }}</cite>
                    </footer>
                </blockquote><!-- END -->

            </div>
        </div>
    </div>
</section>
@endsection
