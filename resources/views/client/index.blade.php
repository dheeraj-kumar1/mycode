@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Clients List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Clients List</li>
                </ol>
            </div>
        </div>
    </section>
    <div class="col-sm-12">

        @if (session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('client.index') }}"><i
                                        class="fa fa-list mr-2"></i>{{ __('Client List') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.create') }}"><i
                                        class="fa fa-plus mr-2"></i>{{ __('Add New Client') }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Actions</th>
                                    <th>Full Name</th>
                                    <th>Company Name</th>
                                    {{-- <th>Title</th> --}}
                                    <th>Friendly Name</th>
                                    <th>Email</th>
                                    <th>Mobile Phone</th>
                                    <th>Home Phone</th>
                                    <th>Work Phone</th>
                                    <th>Fax</th>
                                    <th>Notes</th>
                                    <th>Address Line 1</th>
                                    <th>Address Line 2</th>
                                    <th>Town/City</th>
                                    <th>County</th>
                                    <th>Postcode</th>
                                    <th>Country</th>
                                    <th>Date registered</th>
                                    <th>Registration Complete</th>
                                    <th>Registered via Website?</th>
                                    <th>Branches</th>
                                    <th>Sources</th>
                                    <th>Grouping</th>
                                    <th>Property Details via Email</th>
                                    <th>Property Details via SMS</th>
                                    <th>Other Marketing via Email</th>
                                    <th>Consent Last Updated</th>
                                    <th>Manage Consent Link</th>
                                    <th>Do not Delete Before</th>
                                    <th>Finance Status</th>
                                    <th>Finance Status Notes</th>
                                    <th>Chain Status</th>
                                    <th>Chain Status Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $client)
                                    <tr>
                                        <td class="">{{ $key + 1 }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('client.edit', $client->id) }}"
                                                class="btn text-primary"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('client.destroy', $client->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn text-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    type="submit"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                        <td class="">{{ $client->first_name.' '.$client->surname }}</td>
                                        <td class="">{{ $client->company_name }} </td>
                                        {{-- <td class="">{{ $client->title }} </td> --}}
                                        <td class="">{{ $client->friendly_name }} </td>
                                        <td class="">{{ $client->email }} </td>
                                        <td class="">{{ $client->mobile_phone }} </td>
                                        <td class="">{{ $client->home_phone }} </td>
                                        <td class="">{{ $client->work_phone }} </td>
                                        <td class="">{{ $client->fax }} </td>
                                        <td class="">{{ $client->notes }} </td>
                                        <td class="">{{ $client->address_line1 }} </td>
                                        <td class="">{{ $client->address_line2 }} </td>
                                        <td class="">{{ $client->town }} </td>
                                        <td class="">{{ $client->county }} </td>
                                        <td class="">{{ $client->postcode }} </td>
                                        <td class="">{{ $client->country }} </td>
                                        <td class="">{{ $client->date_registered }} </td>
                                        <td class="">{{ $client->registration_complete }} </td>
                                        <td class="">{{ $client->reg_website }} </td>
                                        <td class="">{{ $client->branches }} </td>
                                        <td class="">{{ $client->source }} </td>
                                        <td class="">{{ $client->grouping }} </td>
                                        <td class="">{{ $client->property_email }} </td>
                                        <td class="">{{ $client->property_sms }} </td>
                                        <td class="">{{ $client->other_marketing }} </td>
                                        <td class="">{{ $client->consent_updated }} </td>
                                        <td class="">{{ $client->consent_link }} </td>
                                        <td class="">{{ $client->delete_before }} </td>
                                        <td class="">{{ $client->finance_status }} </td>
                                        <td class="">{{ $client->finance_status_notes }} </td>
                                        <td class="">{{ $client->chain_status }} </td>
                                        <td class="">{{ $client->chain_status_notes }} </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
@endsection
