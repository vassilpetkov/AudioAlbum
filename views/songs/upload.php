<h1>Upload new song</h1>

<form method="post" action="/songs/upload" enctype="multipart/form-data">

    <label for="title">Title:</label>
    <input id="title" type="text" name="title" />
    <br/>
    <label for="artist">Artist:</label>
    <input id="artist" type="text" name="artist" />
    <br/>
    <label for="genre">Genre:</label>
    <input id="genre" type="text" name="genre" />
    <br/>
    <label for="year">Year:</label>
    <input id="year" type="text" name="year" />
    <br/>

    <span>Select file to upload:</span>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br />
    <input type="submit" value="Upload Song" name="submit">
    <br />
    <a href="/songs">Cancel</a>
</form>
