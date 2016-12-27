@extends('admin.master')

@section('script')
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/projects/order.js"></script>
@stop

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/projects" class="aamenu">Projects list</a>
        <a href="admin/projects/new" class="aamenu">New project</a>
        <a href="admin/projects/order" class="aamenu">Change order</a>
        <a href="admin/changepass" class="aamenu">Chang password</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        <form id="porderform" class="pform" method="post" action="admin/projects/order">
            <div class="input-box">
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            {!! csrf_field() !!}
            @foreach($projects as $i => $project)
                <div class="pbox">
                    <div class="pimgbox">
                        <img src="{!! $project['prj_thumb'] !!}" class="pimg">
                    </div>
                    <div class="piebox">
                        <div class="pinfobox">
                            <p class="ptitle">{!! $project['prj_name'] !!}</p>
                        </div>
                        <div class="peditbox">
                            <input type="hidden" class="prj_url" name="prj_url[]" value="{!! $project['prj_url'] !!}">
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