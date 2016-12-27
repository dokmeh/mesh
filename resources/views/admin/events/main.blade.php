@extends('admin.master')

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/events/new" class="aamenu">New event</a>
        <a href="admin/events/order" class="aamenu">Change order</a>
        <a href="admin/changepass" class="aamenu">Chang password</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        @if(count($events) > 0)
            @foreach($events as $event)
                <div class="pbox">
                    <div class="pimgbox">
                        <img src="{!! $event['eve_thumb'] !!}" class="pimg">
                    </div>
                    <div class="piebox">
                        <div class="pinfobox">
                            <p class="ptitle">{!! $event['eve_title'] !!}</p>
                        </div>
                        <div class="peditbox">
                            <a href="admin/events/info/{!! $event['eve_url'] !!}" class="pedit">Edit information</a>
                            <a href="admin/events/images/{!! $event['eve_url'] !!}" class="pedit">Edit images</a>
                            <a href="admin/events/delete/{!! $event['eve_url'] !!}" class="pedit">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="pno">No data found!</p>
        @endif
    </section>
@stop