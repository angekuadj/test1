@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('salles.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.salles.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.salles.inputs.nom')</h5>
                    <span>{{ $salle->nom ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.salles.inputs.qte')</h5>
                    <span>{{ $salle->qte ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('salles.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Salle::class)
                <a href="{{ route('salles.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
