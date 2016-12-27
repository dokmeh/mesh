@extends('admin.master')

@section('script')
    <script src="js/admin/tinymce/tinymce.min.js"></script>
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/events/info.js"></script>
@stop

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/events" class="aamenu">Events list</a>
        <a href="admin/events/new" class="aamenu">New event</a>
        <a href="admin/events/order" class="aamenu">Change order</a>
        <a href="admin/changepass" class="aamenu">Chang password</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        <form id="pinfoform" class="pform" method="post" action="admin/events/info/{!! $event['eve_url'] !!}">
            {!! csrf_field() !!}
            <div class="input-box">
                <label class="form-label" for="eve_title">Tite</label>
                <input type="text" class="form-text" id="eve_title" name="eve_title" value="{!! $event['eve_title'] !!}" required>
            </div>
            <div class="input-box">
                <label class="form-label" for="eve_text">Text</label>
            </div>
            <div class="input-box">
                <textarea class="form-textarea" id="eve_text" name="eve_text" required>{!! $event['eve_text'] !!}</textarea>
            </div>
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
        </form>
    </section>
@stop