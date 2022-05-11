@extends('adminlte::page')

@section('content')
    <section class="content-header">

    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('groups.index') !!}"><i class="fa fa-list mr-2"></i>{{ __('Group List') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('groups.create') }}"><i class="fa fa-plus mr-2"></i>{{ __('Add New Group') }}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active" href=""><i class="fa fa-edit mr-2"></i>{{ __('Edit Group') }}</a>
                          </li>
                        </ul>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <br />
                    @endif
                    <form method="post" action="{{ route('groups.update', $group->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="group_name">Group Name:</label>
                                <input type="text" class="form-control @error('group_name') is-invalid  @enderror" name="group_name" value="{{ $group->group_name }}" />
                                 @error('group_name')
                                 <div class="invalid-feedback">
                                       <strong>{{ $message }}</strong>
                                 </div>
                                 @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
