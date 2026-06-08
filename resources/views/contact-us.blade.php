@extends('user.body.app')

@section('title')
    Contact Us | Online Easy News
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">Contact Us</h2>
        <div class="row">
            <div class="col-lg-7">
                <form method="POST" action="{{ route('contact-us-post') }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="comments" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
@endsection
