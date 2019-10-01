<div class="table-responsive">
    <table class="table" id="students-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Profile Image</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        {{--@foreach($students as $students)
            <tr>
                <td>{!! $students->name !!}</td>
                <td>{!! $students->email !!}</td>
                <td>{!! $students->contact_number !!}</td>
                <td>{!! $students->profile_image !!}</td>
                <td>
                    {!! Form::open(['route' => ['students.destroy', $students->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('students.show', [$students->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('students.edit', [$students->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach--}}
        </tbody>
    </table>
</div>
