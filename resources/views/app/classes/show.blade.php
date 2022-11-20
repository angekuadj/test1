@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('classes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.classes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.classes.inputs.nom')</h5>
                    <span>{{ $classe->nom ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.classes.inputs.qte')</h5>
                    <span>{{ $classe->qte ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('classes.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Classe::class)
                <a href="{{ route('classes.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
