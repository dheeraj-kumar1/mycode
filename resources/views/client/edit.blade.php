@extends('adminlte::page')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.index') }}"><i
                                        class="fa fa-list mr-2"></i>{{ __('Client List') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.create') }}"><i
                                        class="fa fa-plus mr-2"></i>{{ __('Add New Client') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href=""><i
                                        class="fa fa-edit mr-2"></i>{{ __($client->first_name) }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('client.update', $client->id) }}">
                            @method('PATCH')
                            @include('client.form')
                            <div class="text-right">
                               <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
