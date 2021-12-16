@extends('layouts.app',['activePage' => 'vehicletype'])

@section('title','Edit Vehicletype')

@section('content')
<section class="section">
    @if (Session::has('msg'))
    @include('layouts.msg')
    @endif
    <div class="section-header">
        <h1>{{__('vehicletypes')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a
                    href="{{ url('admin/vehicletype') }}">{{__('update vehicletype')}}</a></div>
            <div class="breadcrumb-item">{{__('Vehicletype')}}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__('Vehicletype menu')}}</h2>
        <p class="section-lead">{{__('Add, Edit, Manage Vehicletype')}}</p>
        <form class="container-fuild" action="{{ url('admin/vehicletype/'.$vehicletype->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card p-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <label for="Promo code name">{{__('vehicletype')}}</label>
                            <div class="logoContainer">
                                <img id="image" src="{{ $vehicletype->image }}" width="180" height="150">
                            </div>
                            <div class="fileContainer sprite">
                                <span>{{__('Image')}}</span>
                                <input type="file" name="image" value="Choose File" id="previewImage" data-id="edit"
                                    accept=".png, .jpg, .jpeg, .svg">
                            </div>
                            @error('image')
                            <span class="custom_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="">{{__('Name of Vehicletype')}}</label>
                            <input type="text" name="name" placeholder="{{__('Enter Vehicletype Name')}}"
                                class="form-control @error('name') is_invalide @enderror"
                                value="{{ $vehicletype->name }}" required="true">
                            @error('name')
                            <span class="custom_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">{{__('update Vehicletype')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection