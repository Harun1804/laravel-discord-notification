@extends('quote.master')

@section('content')
<section class="py-5">
    <div class="container">
        <form action="{{ route('quote.index') }}">
            @csrf
            <textarea name="quote" required class="form-control mb-3" placeholder="Quote Of The Day"></textarea>
            <input type="text" name="by" placeholder="Quote Writer" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary btn-sm">Send</button>
        </form>
    </div>
</section>
@endsection
