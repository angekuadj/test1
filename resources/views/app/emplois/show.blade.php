@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('emplois.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_emploitemps.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_emploitemps.inputs.classe_id')</h5>
                    <span>{{ optional($emploi->classe)->nom ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_emploitemps.inputs.salle_id')</h5>
                    <span>{{ optional($emploi->salle)->nom ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_emploitemps.inputs.user_id')</h5>
                    <span>{{ optional($emploi->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_emploitemps.inputs.Ddebut')</h5>
                    <span>{{ $emploi->Ddebut ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_emploitemps.inputs.Dfin')</h5>
                    <span>{{ $emploi->Dfin ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_emploitemps.inputs.prof_id')</h5>
                    <span>{{ optional($emploi->prof)->nom ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('emplois.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Emploi::class)
                <a href="{{ route('emplois.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
