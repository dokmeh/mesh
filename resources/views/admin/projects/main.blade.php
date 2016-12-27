@extends('admin.master')

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/projects/new" class="aamenu">New project</a>
        <a href="admin/projects/order" class="aamenu">Change order</a>
        <a href="admin/changepass" class="aamenu">Chang password</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        @if(count($projects) > 0)
            @foreach($projects as $project)
                <div class="pbox">
                    <div class="pimgbox">
                        <img src="{!! $project['prj_thumb'] !!}" class="pimg">
                    </div>
                    <div class="piebox">
                        <div class="pinfobox">
                            <p class="ptitle">{!! $project['prj_name'] !!}</p>
                        </div>
                        <div class="peditbox">
                            <a href="admin/projects/info/{!! $project['prj_url'] !!}" class="pedit">Edit information</a>
                            <a href="admin/projects/awards/{!! $project['prj_url'] !!}" class="pedit">Edit awards</a>
                            <a href="admin/projects/links/{!! $project['prj_url'] !!}" class="pedit">Edit links</a>
                            <a href="admin/projects/press/{!! $project['prj_url'] !!}" class="pedit">Edit Publications</a>
                            <a href="admin/projects/images/{!! $project['prj_url'] !!}" class="pedit">Edit images</a>
                            <a href="admin/projects/delete/{!! $project['prj_url'] !!}" class="pedit">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="pno">No data found!</p>
        @endif
    </section>
@stop