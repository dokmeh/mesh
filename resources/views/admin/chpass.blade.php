@extends('admin.master')

@section('script')
    <script src="js/admin/chpass.js"></script>
@stop

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        <form id="chpassform" action="admin/changepass" method="post">
            {!! csrf_field() !!}
            <div class="input-box">
                <input type="password" name="upass" id="upass" class="form-text form-full" placeholder="Current password" autofocus required>
            </div>
            <div class="input-box">
                <input type="password" name="unpass" id="unpass" class="form-text form-full" placeholder="New password" required>
            </div>
            <div class="input-box">
                <input type="password" name="urnpass" id="urnpass" class="form-text form-full" placeholder="Repeat new pasword" required>
            </div>
            <div class="input-box">
                <input type="submit" id="usubmit" class="form-submit" value="Save">
            </div>
        </form>
    </section>
@stop