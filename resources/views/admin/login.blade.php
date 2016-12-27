@extends('admin.master')

@section('content')
    <form id="loginform" action="admin/login" method="post">
        {!! csrf_field() !!}
        <div class="input-box">
            <input type="text" name="uname" id="uname" class="form-text form-full" placeholder="User name" autofocus required>
        </div>
        <div class="input-box">
            <input type="password" name="upass" id="upass" class="form-text form-full" placeholder="Password" required>
        </div>
        <div class="input-box">
            <input type="submit" id="usubmit" class="form-submit" value="Log in">
        </div>
    </form>
@stop