@extends('quote.master')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">

                <!-- CUSTOM BLOCKQUOTE -->
                <blockquote class="blockquote blockquote-custom bg-white p-5 shadow rounded">
                    <div class="blockquote-custom-icon bg-info shadow-sm"><i class="fa-solid fa-quote-left text-white"></i></div>
                    <p class="mb-0 mt-2 font-italic">"{{ ucfirst($data['quote']) }}"</p>
                    <footer class="blockquote-footer pt-4 mt-4 border-top">
                        <cite title="Source Title">{{ $data['by'] }}</cite>
                    </footer>
                </blockquote><!-- END -->

            </div>
        </div>
    </div>
</section>
@endsection
