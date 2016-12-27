@extends('admin.master')

@section('script')
    <script src="js/admin/tinymce/tinymce.min.js"></script>
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/jquery.ezdz.min.js"></script>
    <script src="js/admin/events/new.js"></script>
@stop

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/events" class="aamenu">Events list</a>
        <a href="admin/events/order" class="aamenu">Change order</a>
        <a href="admin/changepass" class="aamenu">Chang password</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        <form id="pnewform" class="pform" method="post" action="admin/events/new" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="input-box">
                <label class="form-label" for="eve_title">Title</label>
                <input type="text" class="form-text" id="eve_title" name="eve_title" autofocus required>
            </div>
            <div class="input-box">
                <label class="form-label" for="eve_text">Text</label>
            </div>
            <div class="input-box">
                <textarea class="form-textarea" id="eve_text" name="eve_text"></textarea>
            </div>
            <div class="input-box">
                <label class="form-label" for="eve_thumb">Thumbnail</label>
                <input type="file" class="form-file" id="eve_thumb" name="eve_thumb" accept="image/*" required>
            </div>
            <div id="prthumb-box" class="input-box"></div>
            <div class="input-box">
                <label class="form-label" for="eve_images">Images</label>
                <input type="file" class="form-file" id="eve_images" name="eve_images[]" accept="image/*" multiple>
            </div>
            <div id="eve-imgs-box" class="input-box"></div>
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
        </form>
    </section>
@stop