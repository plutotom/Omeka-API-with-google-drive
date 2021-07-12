<html>
    <body>

    <form
      enctype="multipart/form-data"
      action="gDriveInstance.php"
      method="post"
    >
      <h3>Upload Item to Google drive and Omeka</h3>
      <p>
        <select name="folderSelect" id="folderSelect">
          <option value="Chapel Messages">Chapel Messages</option>
          <option value="TREN">TREN</option>
          <option value="Stone-Campbell Hymnal Collection">
            Stone-Campbell Hymnal Collection
          </option>
        </select>
        Google Drive Folder
      </p>

      <p><input name="file" type="file" id="file" /></p>
      <p>
        <input name="fileName" type="text" id="file" /> Google drive file name
      </p>
      <p><input name="author" type="text" id="file" /> author name</p>
      <p>
        <select name="mimeType" id="mimeType">
          <option value="audio/mpeg">audio/mpeg</option>
        </select>
        MimeType
      </p>

      <div>
        <input
          type="checkbox"
          id="omekaFilePreview"
          name="omekaFilePreview"
          value="omeka File Preview"
        />
        <label for="omekaFilePreview">True == preview, false == hyperlink</label>
      </div>

      <br />

      <input type="submit" value="Submit" />
    </form>
    <pre id="output"></pre>
    </body>
</html>

<?php

?>