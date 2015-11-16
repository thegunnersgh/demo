@extends('admin.master')

@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Username</th>
            <th>Level</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1?>
    @foreach($user as $value)
        <tr class="odd gradeX" align="center">
            <td>{!! $i !!}</td>
            <td>{!! $value['username'] !!}</td>
            <td>
                @if($value['id'] == 2)
                    <b style="color:#FF8F00">Supper Admin</b>
                @elseif($value['level'] == 1)
                    <b style="color:green">Admin</b>
                @else
                    <b style="color:#866565">Member</b>
                @endif
            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa thành viên này?')" href="{!! url('admin/user/delete', $value['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! url('admin/user/edit', $value['id']) !!}">Edit</a></td>
        </tr>
        <?php $i++; ?>
    @endforeach    
    </tbody>
</table>
@endsection