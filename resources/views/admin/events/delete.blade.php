@extends('admin.master')

@section('script')
    <script src="js/admin/events/delete.js"></script>
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
        <form id="pdeleteform" class="pbox" method="post" action="admin/events/delete/{!! $event['eve_url'] !!}">
            {!! csrf_field() !!}
            <div class="pimgbox">
                <img src="{!! $thumb !!}" class="pimg">
            </div>
            <div class="piebox">
                <div class="pinfobox">
                    <p class="ptitle">{!! $event['eve_title'] !!}</p>
                </div>
                <div class="peditbox">
                    <input type="submit" class="pedit" value="Delete">
                    <a href="admin/events" class="pedit">Back</a>
                </div>
            </div>
        </form>
    </section>
@stop