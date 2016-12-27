@extends('admin.master')

@section('script')
    <script src="js/admin/tinymce/tinymce.min.js"></script>
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/jquery.ezdz.min.js"></script>
    <script src="js/admin/projects/new.js"></script>
@stop

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/projects" class="aamenu">Projects list</a>
        <a href="admin/projects/order" class="aamenu">Change order</a>
        <a href="admin/changepass" class="aamenu">Chang password</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        <form id="pnewform" class="pform" method="post" action="admin/projects/new" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="input-box">
                <label class="form-label" for="prj_name">Name</label>
                <input type="text" class="form-text" id="prj_name" name="prj_name" autofocus required>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_category">Category</label>
                <select id="prj_category" name="prj_category" class="form-select">
                    @foreach($cats as $i => $cat)
                        <option class="form-option" value="{!! $cat['prjc_id'] !!}"{!! $i == 0 ? " selected" : "" !!}>{!! $cat['prjc_title'] !!}</option>
                    @endforeach
                </select>
                <a id="add_category" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_location">Location</label>
                <input type="text" class="form-text" id="prj_location" name="prj_location">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_client">Client</label>
                <input type="text" class="form-text" id="prj_client" name="prj_client">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_sarea">Site area</label>
                <input type="number" class="form-text" id="prj_sarea" name="prj_sarea">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_farea">Floor area</label>
                <input type="number" class="form-text" id="prj_farea" name="prj_farea">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_status">Status</label>
                <select id="prj_status" name="prj_status" class="form-select">
                    @foreach($statuses as $i => $status)
                        <option class="form-option" value="{!! $status['prjs_id'] !!}"{!! $i == 0 ? " selected" : "" !!}>{!! $status['prjs_title'] !!}</option>
                    @endforeach
                </select>
                <a id="add_status" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_ddate">Design date</label>
                <input type="text" class="form-text" id="prj_ddate" name="prj_ddate">
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_cdate">Completion date</label>
                <input type="text" class="form-text" id="prj_cdate" name="prj_cdate">
            </div>
            <div class="input-box">
                <h2 class="form-h form-h2">Extra field</h2>
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            <div class="extra_container"></div>
            <div class="input-box">
                <a id="add_extra" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_desc">Story</label>
            </div>
            <div class="input-box">
                <textarea class="form-textarea" id="prj_desc" name="prj_desc"></textarea>
            </div>
            <div class="input-box">
                <label class="form-label" for="prj_thumb">Thumbnail</label>
                <input type="file" class="form-file" id="prj_thumb" name="prj_thumb" accept="image/*" required>
            </div>
            <div id="prthumb-box" class="input-box"></div>
            <div class="input-box">
                <label class="form-label" for="prj_images">Images</label>
                <input type="file" class="form-file" id="prj_images" name="prj_images[]" accept="image/*" multiple>
            </div>
            <div id="prj-imgs-box" class="input-box"></div>
            <div class="input-box">
                <h2 class="form-h form-h2">Awards</h2>
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            <div class="award_container"></div>
            <div class="input-box">
                <a id="add_award" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <h2 class="form-h form-h2">Links</h2>
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            <div class="link_container"></div>
            <div class="input-box">
                <a id="add_link" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <h2 class="form-h form-h2">Publications</h2>
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            <div class="press_container"></div>
            <div class="input-box">
                <a id="add_press" class="form-button">Add</a>
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
            <div class="new-award">
                <div class="award-box">
                    <div class="input-box">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-text" name="prja_title[]" required>
                    </div>
                    <div class="input-box">
                        <a class="form-button del_award">Delete</a>
                    </div>
                </div>
            </div>
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