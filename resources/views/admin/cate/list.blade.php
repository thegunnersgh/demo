@extends('admin.master')

@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Category Parent</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 1?>
        @foreach($data as $value)
        <tr class="odd gradeX" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $value['name'] !!}</td>
            <td>
                @if($value['parent_id'] == 0)
                    {!! "None" !!}
                @else
                    <?php
                        $parent = DB::table('cates')->where('id', $value['parent_id'])->first();
                        echo $parent->name;
                    ?>
                @endif
            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không!')" href="{!! URL('admin/cate/delete', $value['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL('admin/cate/edit', $value['id']) !!}">Edit</a></td>
        </tr>
        <?php $stt++; ?>
        @endforeach
    </tbody>
</table>
@endsection