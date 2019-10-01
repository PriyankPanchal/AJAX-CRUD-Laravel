@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Students</h1>
        <h1 class="pull-right">
            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#largeModal"
               id="add_new_sport" style="margin-top: -10px;margin-bottom: 5px">Add new</a>
            {{--<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{!! route('students.create') !!}">Add New</a>--}}
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
             aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span onclick="closeModal()" aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Student</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post">
                            @include('students.fields')
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id" class="form-control" name="id" value="">
                        <input class="btn btn-primary" type="button" value="Save" id="save-student">
                        <button type="button" class="btn btn-default"
                                onclick="closeModal()" {{--data-dismiss="modal"--}}>Close
                        </button>
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('students.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            table = $('#students-table').DataTable({
                "serverSide": true,
                "ajax": {
                    "url": "{{ url('students') }}",
                    {{--"url": "{{ route('students.index') }}",--}}
                    "dataType": "json",
                    "type": "GET",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "contact_number"},
                    {
                        "data": "profile_image",
                        render: function (data, type, full, meta) {
                            return '<img src="{{ url('/images/profile_image').'/' }}' + data + '" height="100px" width="100px">';
                        }
                    },
                    {
                        data: null,
                        "bSortable": false,
                        "mRender": function (data, type, full) {
                            var id = full['id'];
                            return '<a href="{{ url('students') }}' + '/' + full['id'] + '" class="btn btn-default btn-xs" style="padding: 4px 5px;"><i class="glyphicon glyphicon-eye-open"></i></a>' +
                                '<a onclick="editStudents(' + full['id'] + ')" class="btn btn-default btn-xs" style="padding: 4px 5px;"><i class="glyphicon glyphicon-edit"></i></a>' +
                                '<a onclick="destroyStudents(' + full['id'] + ')" class="btn btn-danger btn-xs" style="padding: 4px 5px;"><i class="glyphicon glyphicon-trash"></i></a>';
                        }
                    }

                ]
            });
        });


        $(document).ready(function () {
            $("#save-student").click(function () {

                var id = $('#id').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var contact_number = $('#contact_number').val();
                var image = $('#profile_image');
                var profile_image = image[0].files[0];
                var data = new FormData();
                data.append('name', name);
                data.append('email', email);
                data.append('contact_number', contact_number);
                data.append('profile_image', image[0].files[0]);

                if (name == "") {
                    toastr.warning("Please, Please Enter Your Name  !")
                } else if (email == "") {
                    toastr.warning("Please, Please Enter Your Email  !")
                } else if (contact_number == "") {
                    toastr.warning("Please, Please Enter Your Contact Number  !")
                } else if (profile_image == "") {
                    toastr.warning("Please, Please Select Your Profile Image  !")
                } else {
                    if (id == "") {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "{{ URL::to('students') }}",
                            data: data,
                            processData: false,
                            contentType: false,
                            enctype: 'multipart/form-data',
                            cache: false,
                            success: function (data) {
                                console.log(data);
                                closeModal();
                                table.ajax.reload(null, false);
                                swal("Record Inserted !", "Successfully New Sport Category Inserted !", "success");
                            }
                        });
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "{{ URL::to('students_update') }}/" + id,
                            data: data,
                            processData: false,
                            contentType: false,
                            enctype: 'multipart/form-data',
                            cache: false,
                            success: function (data) {
                                closeModal();
                                table.ajax.reload(null, false);
                                swal("Updated!", "Successfully Updated.!", "success");
                            }
                        });
                    }
                }
            });
        });


        function editStudents(id) {
            var url = "{{URL::to('students')}}/" + id + "/edit";

            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    var id = document.getElementById("id").value = data.data.students.id;
                    var name = document.getElementById("name").value = data.data.students.name;
                    var email = document.getElementById("email").value = data.data.students.email;
                    var contact_number = document.getElementById("contact_number").value = data.data.students.contact_number;
//                    var profile_image = document.getElementById("profile_image").value = data.data.students.profile_image;

                    /*console.log(id);
                     console.log(sport_name);
                     console.log(created_date);
                     console.log(modified_date);
                     console.log(is_delete);
                     console.log(is_testdata);*/


                    $('#largeModal').modal('show');
                }
            });
        }

        function destroyStudents(id) {
            swal({
                    title: "Are you sure??",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "yes",
                    cancelButtonText: "no",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var url = "{{URL::to('students_delete')}}/" + id;
                        $.ajax({
                            url: url,
                            type: "get",
                            success: function (data) {
                                table.ajax.reload(null, false);
                                swal("Deleted!", "Deleted Successfully!", "success");
                            }
                        });
                    } else {
                        swal("Cancelled", "Your Data is safe :)", "error");
                    }
                });
            return false;
        }


        function closeModal() {
            $('#largeModal').modal('hide');
            $('#id').val('');
            $('#name').val('');
            $('#email').val('');
            $('#contact_number').val('');
            $('#profile_image').val('');
        }
    </script>
@endsection