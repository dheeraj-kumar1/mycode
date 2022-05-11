@extends('adminlte::page')

@section('content')
    <section class="content-header">
      
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('groups.index') !!}"><i
                                    class="fa fa-list mr-2"></i>{{ __('Group List') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('groups.create') }}"><i
                                    class="fa fa-plus mr-2"></i>{{ __('Add New Group') }}</a>
                        </li>
                    </ul>
                </div>
                <form method="post" action="{{ route('groups.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="group_name">Group Name:</label>
                            <input type="text" class="form-control @error('group_name') is-invalid  @enderror" value="{{old('group_name')}}" name="group_name" />
                            @error('group_name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="group_name">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
