<form action="/songs/create" method="post" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <legend>Upload new song</legend>
        <div class="form-group">
            <label for="title" class="col-lg-2 control-label">Title:</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            </div>
        </div>
        <div class="form-group">
            <label for="artist" class="col-lg-2 control-label">Artist:</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" id="artist" name="artist" placeholder="Artist">
            </div>
        </div>
        <div class="form-group">
            <label for="genre" class="col-lg-2 control-label">Genre:</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre">
            </div>
        </div>
        <div class="form-group">
            <label for="year" class="col-lg-2 control-label">Year:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="year" name="year" placeholder="Year">
            </div>
        </div>
        <div class="form-group">
            <label for="fileToUpload" class="col-lg-2 control-label">Select file:</label>
            <div class="col-lg-10">
                <input type="file" class="btn btn-default" id="fileToUpload" name="fileToUpload">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="/songs" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </fieldset>
</form>