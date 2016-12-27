@extends('admin.master')

@section('script')
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/projects/links.js"></script>
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
        <form id="plinksform" class="pform" method="post" action="admin/projects/links/{!! $project['prj_url'] !!}">
            {!! csrf_field() !!}
            <div class="input-box">
                <h3 class="form-h form-h3">Links</h3>
            </div>
            <div class="input-box">
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            <div class="link-boxes">
            @foreach($project->links as $i => $link)
                <div class="link-box">
                    <div class="input-box">
                        <label class="form-label" for="prjl_title{!! $i + 1 !!}">Title</label>
                        <input type="text" class="form-text" id="prjl_title{!! $i + 1 !!}" name="prjl_title[]" value="{!! $link['prjl_title'] !!}" required>
                    </div>
                    <div class="input-box">
                        <label class="form-label" for="prjl_url{!! $i + 1 !!}">Link</label>
                        <input type="url" class="form-text" id="prjl_url{!! $i + 1 !!}" name="prjl_url[]" value="{!! $link['prjl_url'] !!}" required>
                    </div>
                    <div class="input-box">
                        <a class="form-button del_link">Delete</a>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="input-box">
                <a id="add_link" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
         </form>
        </div>
        <div class="div-hide">
            <div class="new-link">
                <div class="link-box">
                    <div class="input-box">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-text" name="prjl_title[]" required>
                    </div>
                    <div class="input-box">
                        <label class="form-label">Link</label>
                        <input type="url" class="form-text" name="prjl_url[]" required>
                    </div>
                    <div class="input-box">
                        <a class="form-button del_link">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop