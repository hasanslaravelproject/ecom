@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('customers.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.customers.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.name')</h5>
                    <span>{{ $customer->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.email')</h5>
                    <span>{{ $customer->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.passcode')</h5>
                    <span>{{ $customer->passcode ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.comapany_id')</h5>
                    <span
                        >{{ optional($customer->comapany)->name ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('customers.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Customer::class)
                <a href="{{ route('customers.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
