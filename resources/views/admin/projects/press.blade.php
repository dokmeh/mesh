@extends('admin.master')

@section('script')
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/projects/press.js"></script>
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
        <form id="ppressform" class="pform" method="post" action="admin/projects/press/{!! $project['prj_url'] !!}">
            {!! csrf_field() !!}
            <div class="input-box">
                <h3 class="form-h form-h3">Publications</h3>
            </div>
            <div class="input-box">
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            <div class="press-boxes">
            @foreach($project->press as $i => $press)
                <div class="press-box">
                    <div class="input-box">
                        <label class="form-label" for="prjp_title{!! $i + 1 !!}">Title</label>
                        <input type="text" class="form-text" id="prjp_title{!! $i + 1 !!}" name="prjp_title[]" value="{!! $press['prjp_title'] !!}" required>
                    </div>
                    <div class="input-box">
                        <a class="form-button del_press">Delete</a>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="input-box">
                <a id="add_press" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
         </form>
        </div>
        <div class="div-hide">
            <div class="new-press">
                <div class="press-box">
                    <div class="input-box">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-text" name="prjp_title[]" required>
                    </div>
                    <div class="input-box">
                        <a class="form-button del_press">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop