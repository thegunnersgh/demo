@extends('admin.master')

@section('content')
<style type="text/css">
    .icon_del{position: relative; top: -55px; left: -20px;}
    #insert{margin-top: 20px;}
    #a{margin-top: 10px;}
</style>
<form action="" method="POST" name="editproduct" enctype="multipart/form-data">
<div class="col-lg-7" style="padding-bottom:120px">
    
    @include('admin.blocks.error')

        <input type="hidden" value="{!! csrf_token()!!}" name="_token"  />
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name='sltParent'>
                <option value="">Please Choose Category</option>
                <?php cate_parent($parent, 0, '----', $product->cate_id) ?>
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="txtName" placeholder="Please Enter Username" value="{!! old('txtName', isset($product)? $product->name : null ) !!}" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" name="txtPrice" placeholder="Please Enter Password" value="{!! old('txtPrice', isset($product)? $product->price : null ) !!}" />
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro', isset($product)? $product->intro : null ) !!}</textarea>
            <script type="text/javascript">ckeditor('txtIntro')</script>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent', isset($product)? $product->content : null ) !!}</textarea>
            <script type="text/javascript">ckeditor('txtContent')</script>
        </div>
        <div class="form-group">
            <label>Image Curent</label>
            <img src="{!! asset('resources/upload/'.$product['image']) !!}" width="150" />

        </div>
        <div class="form-group">
            <label>Images</label>
            <input type="file" name="fImages" />
            <input type="hidden" name="img_current" value="{!! $product['image'] !!}" />
        </div>
        <div class="form-group">
            <label>Product Keywords</label>
            <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="{!! old('txtKeywords', isset($product)? $product->keywords : null ) !!}" />
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription', isset($product)? $product->description : null ) !!}</textarea>
        </div>
        
        <button type="submit" class="btn btn-default">Product Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    
</div>
<div class="col-md-1">
    
</div>
<div class="col-md-4">
    @foreach($product_image as $item)
        <div class="form-group" id="hinh{!! $item['id'] !!}">
            <img src="{!! asset('resources/upload/detail/'.$item['image']) !!}" width="200" idHinh="{!! $item['id'] !!}" id="hinh{!! $item['id'] !!}" />
            <a id="del_img_demo" class="btn btn-danger btn-circle icon_del"><i class="fa fa-times"></i></a>
            <input type="file" name="fProductDetail[]" id="a" />
        </div>
    @endforeach
    <button type="button" class="btn btn-primary" id="addImages">Add Images</button>
    <div id="insert"></div>
</div>
</form>
@endsection