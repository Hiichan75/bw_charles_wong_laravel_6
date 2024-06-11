@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-4">Admin Dashboard</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage News</h5>
                    <p class="card-text">Create, edit, and delete news items.</p>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-primary">Go to News</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage FAQ</h5>
                    <p class="card-text">Manage frequently asked questions.</p>
                    <a href="{{ route('admin.faq.index') }}" class="btn btn-primary">Go to FAQ</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Contacts</h5>
                    <p class="card-text">View and respond to contact inquiries.</p>
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-primary">Go to Contacts</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Products</h5>
                    <p class="card-text">Add, edit, and delete products.</p>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Go to Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
