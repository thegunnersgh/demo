@extends('admin.master')

@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Date</th>
            <th>Category</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1;?>
    @foreach($product as $pro)
        <tr class="odd gradeX" align="center">
            <td>{!! $i !!}</td>
            <td>{!! $pro['name'] !!}</td>
            <td>{!! number_format($pro['price'], 0, ',', '.') !!} VNĐ</td>
            <td>
                {!!
                    \Carbon\Carbon::createFromTimeStamp(strtotime($pro['created_at']))->diffForHumans();
                !!}
                <?php
                    // \Carbon: namespace
                    // \Carbon: tên Class
                    // createFromTimeStamp: gọi phương thức tĩnh
                    // diffForHumans: quy sang năm, tháng, ngày, h, m, s
                ?>
            </td>
            <td>
                <?php $cate_name = DB::table('cates')->where('id', $pro['cate_id'])->first(); ?>
                    @if(!empty($cate_name->name))
                        {!! $cate_name->name !!}
                    @endif
            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không!')" href="{!! url('/admin/product/delete', $pro['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! url('/admin/product/edit', $pro['id']) !!}">Edit</a></td>
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
</table>
@endsection