@extends('admin.master')

@section('script')
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/jquery.ezdz.min.js"></script>
    <script src="js/admin/projects/images.js"></script>
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
        <form id="pthumbform" class="pbox" method="post" action="admin/projects/thumb/{!! $project['prj_url'] !!}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="pimgbox">
                <img id="pthumbimg" src="{!! $thumb !!}?rand={!! time() !!}" class="pimg">
            </div>
            <div class="piebox">
                <p class="ptitle">Thumbnail</p>
                <input type="file" id="prj_thumb" name="prj_thumb" accept="image/*" required>
                <input type="submit" class="form-button" value="Save">
            </div>
        </form>
        <form id="pnewimagesform" class="pform" method="post" action="admin/projects/newimages/{!! $project['prj_url'] !!}"  enctype="multipart/form-data">
            {!! csrf_field() !!}
            <p class="ptitle">Add new images</p>
            <input type="file" id="prj_images" name="prj_images[]" accept="image/*" multiple required>
            <div id="prj-imgs-box" class="input-box"></div>
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
        </form>
        <form id="porderimagesform" class="pform" method="post" action="admin/projects/orderimages/{!! $project['prj_url'] !!}">
            {!! csrf_field() !!}
            <p class="ptitle">Images</p>
            <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            @foreach($images as $i => $image)
                <div class="pbox">
                    <div class="pimgbox">
                        <img src="img/projects/{!! $project['prj_url'] !!}/{!! $image !!}?{!! time() !!}" class="pimg">
                    </div>
                    <div class="piebox">
                        <div class="peditbox">
                            <input type="hidden" class="img_url" name="img_url[]" value="{!! str_replace("thumb", "", $image) !!}">
                            <a class="del_img pedit">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <input type="submit" class="form-submit" value="Save">
        </form>
    </section>
@stop