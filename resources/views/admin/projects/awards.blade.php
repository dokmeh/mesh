@extends('admin.master')

@section('script')
    <script src="js/admin/drag-arrange.min.js"></script>
    <script src="js/admin/projects/awards.js"></script>
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
        <form id="pawardsform" class="pform" method="post" action="admin/projects/awards/{!! $project['prj_url'] !!}">
            {!! csrf_field() !!}
            <div class="input-box">
                <h3 class="form-h form-h3">Awards</h3>
            </div>
            <div class="input-box">
                <h4 class="form-h form-h4">Drag and drop for changing order</h4>
            </div>
            <div class="award-boxes">
            @foreach($project->awards as $i => $award)
                <div class="award-box">
                    <div class="input-box">
                        <label class="form-label" for="prja_title{!! $i + 1 !!}">Title</label>
                        <input type="text" class="form-text" id="prja_title{!! $i + 1 !!}" name="prja_title[]" value="{!! $award['prja_title'] !!}" required>
                    </div>
                    <div class="input-box">
                        <a class="form-button del_award">Delete</a>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="input-box">
                <a id="add_award" class="form-button">Add</a>
            </div>
            <div class="input-box">
                <input type="submit" class="form-submit" value="Save">
            </div>
         </form>
        </div>
        <div class="div-hide">
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
        </div>
    </section>
@stop