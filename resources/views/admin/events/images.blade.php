@extends('admin.master')

@section('script')
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/jquery.ezdz.min.js"></script>
    <script src="js/admin/events/images.js"></script>
@stop

@section('content')
    <header class="aheader">
        <a href="admin" class="aamenu">Main page</a>
        <a href="admin/events" class="aamenu">Events list</a>
        <a href="admin/events/new" class="aamenu">New event</a>
        <a href="admin/events/order" class="aamenu">Change order</a>
        <a href="admin/changepass" class="aamenu">Chang password</a>
        <a href="admin/logout" class="aamenu">Log out</a>
    </header>
    <section class="asection">
        <form id="pthumbform" class="pbox" method="post" action="admin/events/thumb/{!! $event['eve_url'] !!}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="pimgbox">
                <img id="pthumbimg" src="{!! $thumb !!}?rand={!! time() !!}" class="pimg">
            </div>
            <div class="piebox">
                <p class="ptitle">Thumbnail</p>
                <input type="file" id="eve_thumb" name="eve_thumb" accept="image/*" required>
                <input type="submit" class="form-button" value="Save">
            </div>
        </form>
        <form id="pnewimagesform" class="pform" method="post" action="admin/events/newimages/{!! $event['eve_url'] !!}"  enctype="multipart/form-data">
            {!! csrf_field() !!}
            <p class="ptitle">Add new images</p>
            <input type="file" id="eve_images" name="eve_images[]" accept="image/*" multiple required>
            <div id="eve-imgs-box" class="input-box"></div>
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
        </form>
        <form id="porderimagesform" class="pform" method="post" action="admin/events/orderimages/{!! $event['eve_url'] !!}">
            {!! csrf_field() !!}
            <p class="ptitle">Images</p>
            <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            @foreach($images as $i => $image)
                <div class="pbox">
                    <div class="pimgbox">
                        <img src="img/events/{!! $event['eve_url'] !!}/{!! $image !!}?{!! time() !!}" class="pimg">
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