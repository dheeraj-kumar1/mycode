@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>WhatsApp Messsages</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">WhatsApp Messsages</li>
                </ol>
            </div>
        </div>
    </section>
    <div class="col-sm-12">

        @if (session()->get('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
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
                                <a class="nav-link active" href=""><i class="fa fa-list mr-2"></i>{{ __('Group Message') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('whatsapp.single')}}"><i class="fa fa-list mr-2"></i>{{ __('Single Message') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif
                        <form method="post" action="{{ route('whatsapp.send') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="">Select Group</label>
                                    <select required class="selectpicker form-control" data-live-search="true"
                                        name="group_id" id="group_id" onchange="get_group_user_cnt()">
                                        <option selected disabled>Please select group name</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                    </select>
                                    <p data-toggle="modal" data-target="#userModal">
                                    <span id="total_user_cnt" class="show_user_details" onclick="show_user_detail_data()" style="color:red;"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Choose file:</label>
                                    <input type="file" class="form-control" name="file" />
                                    <span class="h6" style="color:red;">File size must not exceed 5MB. Only
                                        JPEG, PNG, GIF are
                                        supported.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">WhatsApp message:</label>
                                <br><span class="h6" style="color:red;" id="counted_char">Typed 0
                                    character</span>
                                <textarea class="form-control" name="message" cols="30" rows="5" data-maxlength="1600" id="message_body"
                                    placeholder="Enter your Custom Message"></textarea>
                                <span class="h6" style="color:red;">Message cab be maximum of 1600
                                    characters.</span>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </form>
                        <h6>Help articles:</h6>
                        <ul>
                            <li><a href="https://support.twilio.com/hc/en-us/articles/360024008153-WhatsApp-Rate-Limiting" target="_blank" rel="noopener noreferrer">Whatsapp message rate limits</a></li>
                            <li>Can send 1000 SMS a day to unique phone numbers.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  Model for user data -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="margin: 35px 200px">
        <div class="modal-content" style="width:950px;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="overflow-y:scroll; height: auto; max-height: 400px;">
            <table class="table" border="1px" id="user_details_data">
               
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#message_body').unbind('keyup change input paste').bind('keyup change input paste', function(e) {
                var text = $(this).val();
                var maxlength = $(this).data('maxlength');
                $("#counted_char").html("Typed " + text.length + " character")
                if (maxlength > 0) {
                    $(this).val(text.substr(0, maxlength));
                }
            });

            $('form').on('submit', function() {
                if ($("#group_id").val() == null) {
                    alert("Please select atleast one group");
                    $("#group_id").focus();
                    return false;
                } else if ($("#message_body").val().trim() == '') {
                    alert("Please write something in the message box");
                    $("#message_body").focus();
                    return false;
                } else {
                    return true;
                }
            });
        });

        function get_group_user_cnt() {
            $.ajax({
                method: "POST",
                url: "{{ route('GetClientCount') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "group_id": $("#group_id").val()
                },
                success: function(data) {
                    $("#total_user_cnt").html("Total contacts in this group are " + data.total);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function showSection(section){
            if (section == 2) {
                $('#byGroup').show();
                $('#byNumber').hide();
                $('#whatsapp').val('');
                $('form').on('submit', function() {
                if ($("#group_id").val() == null) {
                    alert("Please select atleast one group");
                    $("#group_id").focus();
                    return false;
                } else if ($("#message_body").val().trim() == '') {
                    alert("Please write something in the message box");
                    $("#message_body").focus();
                    return false;
                } else {
                    return true;
                }
            });
            }else if(section == 1){
                $('#byGroup').hide();
                $('#byNumber').show();
            }
        }

        function show_user_detail_data(){
            $('#user_details_data').empty();
            $('#user_details_data').append($("<thead><tr><th>Name</th><th>Email</th><th>Contact No</th></tr></thead>").attr("value", ''));
            $.ajax({
                method: "POST",
                url: "{{ route('GetClientCount') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "group_id": $("#group_id").val()
                },
                success: function(data) {
                    data.client.forEach(element => {
                        $('#user_details_data').append($("<tr><td>"+element.full_name+"</td>"+" "+"<td>"+element.email+"</td>"+" "+"<td>"+element.mobile_phone+"</td></tr>"));
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
