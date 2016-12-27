@extends('admin.master')

@section('script')
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/events/order.js"></script>
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
        <form id="porderform" class="pform" method="post" action="admin/events/order">
            <div class="input-box">
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            {!! csrf_field() !!}
            @foreach($events as $i => $event)
                <div class="pbox">
                    <div class="pimgbox">
                        <img src="{!! $event['eve_thumb'] !!}" class="pimg">
                    </div>
                    <div class="piebox">
                        <div class="pinfobox">
                            <p class="ptitle">{!! $event['eve_title'] !!}</p>
                        </div>
                        <div class="peditbox">
                            <input type="hidden" class="eve_url" name="eve_url[]" value="{!! $event['eve_url'] !!}">
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
        </form>
    </section>
@stop