@extends('admin.master')

@section('script')
    <script src="js/admin/projects/delete.js"></script>
@stop

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/projects" class="aamenu">Projects list</a>
        <a href="admin/projects/new" class="aamenu">New Project</a>
        <a href="admin/projects/order" class="aamenu">Change order</a>
        <a href="admin/changepass" class="aamenu">Chang password</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        <form id="pdeleteform" class="pbox" method="post" action="admin/projects/delete/{!! $project['prj_url'] !!}">
            {!! csrf_field() !!}
            <div class="pimgbox">
                <img src="{!! $thumb !!}" class="pimg">
            </div>
            <div class="piebox">
                <div class="pinfobox">
                    <p class="ptitle">{!! $project['prj_name'] !!}</p>
                </div>
                <div class="peditbox">
                    <input type="submit" class="pedit" value="Delete">
                    <a href="admin/projects" class="pedit">Back</a>
                </div>
            </div>
        </form>
    </section>
@stop