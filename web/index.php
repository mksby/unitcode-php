<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form action="/index.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <label for="csv">File: </label>
                <input type="file" id="csv" name="csv" />
            </fieldset>

            <br>

            <input type="submit" value="Send" />
        </form>
    </body>
</html>