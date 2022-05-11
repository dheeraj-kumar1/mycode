@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Groups</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Groups</li>
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
                                <a class="nav-link active" href="{!! route('groups.index') !!}"><i class="fa fa-list mr-2"></i>{{ __('Group List') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('groups.create') }}"><i class="fa fa-plus mr-2"></i>{{ __('Add New Group') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="container">
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered table-striped w-100 mt-2" style="text-align: center;"
                                id="myTable">
                                <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Group Name</th>
                                        <th>Group Status</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $group)
                                        <tr class="odd">
                                            <td class="">{{ $loop->iteration }}</td>
                                            <td class="">{{ $group->group_name }} </td>
                                            <td>
                                                <a href="{{ route('changestatus', $group->id) }}"
                                                    class="btn {{ $group->status == 0 ? 'btn-danger' : 'btn-success' }}">{{ $group->status == 0 ? 'Inactive' : 'Active' }}</a>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('groups.edit', $group->id) }}"
                                                    class="btn text-primary"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('groups.destroy', $group->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn text-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                        type="submit"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $groups->links() }}
                        </div>
                        {{-- <p class="text-sm text-gray-700 leading-5">
                                Showing <span class="font-medium">1</span> to
                                <span class="font-medium">{{ $groups->count() }}</span>
                                of
                                <span class="font-medium">{{ $groups->total() }}</span>
                                results
                            </p> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
