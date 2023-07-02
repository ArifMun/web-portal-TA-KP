<form method="post" enctype="multipart/form-data" action="import-excel">
    @csrf
    <div class="form-group">
        <table class="table">
            <tr>
                <td width="40%" align="right"><label>Select File for Upload</label></td>
                <td width="30">
                    <input type="file" name="file-import">
                </td>
                <td width="30%" align="left">
                    <input type="submit" name="upload" class="btn btn-primary btn-round ml-auto" value="upload">
                </td>
            </tr>
            <tr>
                <td width="40%" align="right"></td>
                <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                <td width="30%" align="left"></td>
            </tr>
        </table>
    </div>
</form>