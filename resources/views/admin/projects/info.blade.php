@extends('admin.master')

@section('script')
    <script src="js/admin/tinymce/tinymce.min.js"></script>
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/projects/info.js"></script>
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
        <form id="pinfoform" class="pform" method="post" action="admin/projects/info/{!! $project['prj_url'] !!}">
            {!! csrf_field() !!}
            <div class="input-box">
                <label class="form-label" for="prj_name">Name</label>
                <input type="text" class="form-text" id="prj_name" name="prj_name" value="{!! $project['prj_name'] !!}" required>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_category">Category</label>
                <select id="prj_category" name="prj_category" class="form-select">
                    @foreach($cats as $i => $cat)
                        <option class="form-option" value="{!! $cat['prjc_id'] !!}"{!! $cat['prjc_id'] == $project['prj_category'] ? " selected" : "" !!}>{!! $cat['prjc_title'] !!}</option>
                    @endforeach
                </select>
                <a id="add_category" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_location">Location</label>
                <input type="text" class="form-text" id="prj_location" name="prj_location" value="{!! empty($project['prj_location']) ? '' : $project['prj_location'] !!}">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_client">Client</label>
                <input type="text" class="form-text" id="prj_client" name="prj_client" value="{!! empty($project['prj_client']) ? '' : $project['prj_client'] !!}">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_sarea">Site area</label>
                <input type="number" class="form-text" id="prj_sarea" name="prj_sarea" value="{!! empty($project['prj_sarea']) ? '' : $project['prj_sarea'] !!}">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_farea">Floor area</label>
                <input type="number" class="form-text" id="prj_farea" name="prj_farea" value="{!! empty($project['prj_farea']) ? '' : $project['prj_farea'] !!}">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_status">Status</label>
                <select id="prj_status" name="prj_status" class="form-select">
                    @foreach($statuses as $i => $status)
                        <option class="form-option" value="{!! $status['prjs_id'] !!}"{!! $status['prjs_id'] == $project['prj_category'] ? " selected" : "" !!}>{!! $status['prjs_title'] !!}</option>
                    @endforeach
                </select>
                <a id="add_status" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_ddate">Design date</label>
                <input type="text" class="form-text" id="prj_ddate" name="prj_ddate" value="{!! empty($project['prj_ddate']) ? '' : $project['prj_ddate'] !!}">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_cdate">Completion date</label>
                <input type="text" class="form-text" id="prj_cdate" name="prj_cdate" value="{!! empty($project['prj_cdate']) ? '' : $project['prj_cdate'] !!}">
            </div>
            <div class="input-box">
                <h2 class="form-h form-h2">Extra field</h2>
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            <div class="extra_container">
                @foreach($project->extras as $i => $extra)
                    <div class="extra-box">
                        <div class="input-box">
                            <label class="form-label" for="prje_title{!! $i + 1 !!}">Title</label>
                            <input type="text" id="prje_title{!! $i + 1 !!}" class="form-text" name="prje_title[]" value="{!! empty($extra['prje_title']) ? '' : $extra['prje_title'] !!}">
                        </div>
                        <div class="input-box">
                            <label class="form-label" for="prje_content{!! $i + 1 !!}">Content</label>
                            <input type="text" id="prje_content{!! $i + 1 !!}" class="form-text" name="prje_content[]" value="{!! empty($extra['prje_content']) ? '' : $extra['prje_content'] !!}" required>
                        </div>
                        <div class="input-box">
                            <a class="form-button del_extra">Delete</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="input-box">
                <a id="add_extra" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_desc">Story</label>
            </div>
            <div class="input-box">
                <textarea class="form-textarea" id="prj_desc" name="prj_desc">{!! empty($project['prj_desc']) ? '' : $project['prj_desc'] !!}</textarea>
            </div>
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
        </form>
        <div id="newcategory" class="add-form-box">
            <form id="newcategoryform" class="add-form" method="post" action="admin/projects/category">
                {!! csrf_field() !!}
                <div class="close-form"></div>
                <p class="ptitle">New category</p>
                <div class="input-box">
                    <label class="form-label" for="prjc_title">Title</label>
                    <input type="text" class="form-text" id="prjc_title" name="prjc_title" required>
                </div>
                <div class="input-box">
                    <input type="submit" class="form-submit" value="Save">
                </div>
            </form>
        </div>
        <div id="newstatus" class="add-form-box">
            <form id="newstatusform" class="add-form" method="post" action="admin/projects/status">
                {!! csrf_field() !!}
                <div class="close-form"></div>
                <p class="ptitle">New status</p>
                <div class="input-box">
                    <label class="form-label" for="prjs_title">Title</label>
                    <input type="text" class="form-text" id="prjs_title" name="prjs_title" required>
                </div>
                <div class="input-box">
                    <input type="submit" class="form-submit" value="Save">
                </div>
            </form>
        </div>
        <div class="div-hide">
            <div class="new-extra">
                <div class="extra-box">
                    <div class="input-box">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-text" name="prje_title[]">
                    </div>
                    <div class="input-box">
                        <label class="form-label">Content</label>
                        <input type="text" class="form-text" name="prje_content[]" required>
                    </div>
                    <div class="input-box">
                        <a class="form-button del_extra">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop