@extends('layouts.app',['activePage' => 'Reviews and ratting'])

@section('title','Ratting')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Ratting and reviews')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('admin/vehicle/'.$vehicle->id) }}">{{ $vehicle->name }}</a></div>
            <div class="breadcrumb-item">{{__('Review Ratting')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('Vehicle Management System')}}</h2>

        <p class="section-lead">{{__('Ratting and review')}}</p>
        <div class="card">
            <div class="card-header">
                <div class="w-100">
                    <h4>{{__('Vehicle reviews')}}</h4>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Order Id')}}</th>
                            <th>{{__('User name')}}</th>
                            <th>{{__('Review')}}</th>
                            <th>{{__('Rate')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->order }}</td>
                            <td>{{ $review->user['name'] }}</td>
                            <td>{{ $review->comment }}</td>
                            <td>
                                @for ($i = 1; $i < 6; $i++)
                                    @if ($review->rate >= $i)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
