@extends('adminlte::page')
@section('content')
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Import Contact</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Import Contact</li>
                </ol>
            </div>
        </div>
    </section>
    <div class="col-sm-12">
        @if (Session::has('message'))
            <div class="alert alert-success">
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form method='post' action="{{ route('importcontact.store') }}" enctype='multipart/form-data' class="row">
                        @csrf
                        <div class="col-md-5 form-group">
                            <label for="group_name">Contact Group</label>
                            <select required class="selectpicker form-control" data-live-search="true" name="group_id">
                                <option selected disabled value="Please select Group Name">Please select Group Name</option>
                                @if (isset($groups))
                                    @foreach ($groups as $group)
                                        @if ($group->status == '1')
                                            {
                                            <option value="{{ $group->id }}">{{ $group->group_name }}
                                            </option>
                                            }
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-5 form-group">
                          <label for="file">Choose csv file</label>
                          <input type="file" name="file" id="file" class="form-control" placeholder="">
                        </div>
                        <div class="col-md-2 form-group mt-4 pt-2">
                            <input type='submit' class="btn w-100 btn-primary" name='submit' value='Import'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($Filedata) && !empty($Filedata))
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body table-responsive">
                <form method='post' id="form2"  action="{{ route('importcontact.save') }}" enctype='multipart/form-data' >
                  @csrf
                  <input type="hidden" name="csv_id" value="{{$Filedata['inserted_id']}}">                                  
                  <input type="hidden" name="group_id" value="{{$Filedata['group_id']}}">       
                  <input type="hidden" name="fieldCount" id="fieldCount" value="{{count($Filedata['row_name'][0])}}">
                  <table class="table table-bordered table-striped " style="text-align: center;" id="myTable">
                    <thead>
                      <tr>
                      <th></th>
                      @foreach($Filedata['row_name'][0] as $vkeys => $vrows)
                      <th>
                        <select name="fields[{{$vkeys}}]" class="form-control dropdownclass" id="dropdown{{$vkeys+1}}" onchange="checkselect('dropdown{{$vkeys+1}}');" >
                          <option value="">--Please select field--</option>
                          @foreach($Filedata['main_rows'] as $mkeys => $mvalues)
                          <option value="{{$mkeys}}">{{$mvalues}}</option>
                          @endforeach
                        </select>
                      </th>
                      @endforeach
                      </tr>
                      <tr role="row">
                        <th>#</th>
                        @foreach($Filedata['row_name'][0] as $vrows)
                        <th>{{$vrows}}</th>
                        @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($Filedata['csv_data'] as $kfiles => $files) 
                          @if($kfiles != 0)
                          <tr class="odd">
                            <td class="">{{$loop->iteration}}</td>
                            @php {{ $cnt = count($Filedata['row_name'][0]); }} @endphp
                            @for ($c=0; $c < $cnt; $c++) 
                                <td>{{$files[$c]}}</td>
                            @endfor
                          </tr>
                          @endif
                        @endforeach 
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>
                            <input type='button' class="btn btn-primary" name='submit2' onclick="return checkvalid();" value='Submit'>
                          </th>
                        </tr>
                      </tfoot>
                  </table>
                </form>      
              </div>
            </div>
        </div>
      </div>
</section>
@endif
@endsection
@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@stop
@section('js')
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#myTable").DataTable();
        });
    </script>
    <script>
        function checkvalid() {
            var num = 0;
            jQuery('select.dropdownclass').each(function() {
                var value = jQuery(this).val();
                if (value != '') {
                    num++;
                }
            });
            if (num == 0) {
                alert("Please select field");
                return false;
            } else if($("#fieldCount").val() != num){
                alert("Please select all field");
                return false;
            }else{
                $("#form2").submit();
                return true;
            }
        }
    </script>
    <script>
        function checkselect(val) {
            var mainvalue = $('#' + val).val();
            jQuery('select:not([id=' + val + '])').each(function() {
                var value = jQuery(this).val();
                var id = jQuery(this).attr('id');
                if (value == mainvalue) {
                    console.log(id);
                    alert(value + ' field already been chosen.');
                    jQuery('#' + val + ' option:contains("--Please select field--")').prop('selected', true);
                    return false;
                }
            });
        }
    </script>
@endsection
