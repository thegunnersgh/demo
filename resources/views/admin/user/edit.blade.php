@extends('admin.master')

@section('content')

<div class="col-lg-7" style="padding-bottom:120px">
    <form action="" method="POST">
        <input type="hidden" value="{!! csrf_token()!!}" name="_token"  />
        @include('admin.blocks.error')
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="txtUser" value="{!! old('txtUser', isset($user) ? $user['username']: null) !!}" disabled />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" value=""/>
        </div>
        <div class="form-group">
            <label>RePassword</label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" value=""/>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txtEmail" placeholder="Please Enter Email" value="{!! old('txtEmail', isset($user) ? $user['email']: null) !!}"/>
        </div>
        @if(Auth::user()->id != $user['id'])
        <div class="form-group">
            <label>User Level</label>
            @if($user['level'] == 1)
                <label class="radio-inline">
                    <input name="rdoLevel" value="1" checked="checked" type="radio">Admin
                </label>
                <label class="radio-inline">
                    <input name="rdoLevel" value="2" type="radio">Member
                </label>
            @else
                <label class="radio-inline">
                    <input name="rdoLevel" value="1" checked="" type="radio" >Admin
                </label>
                <label class="radio-inline">
                    <input name="rdoLevel" value="2" checked="checked" type="radio">Member
                </label>
            @endif
        </div>
        @endif
        <button type="submit" class="btn btn-default">User Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection