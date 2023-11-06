<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Importer</title>
</head>

<body>
    <?php if (session()->has('success')) : ?>
        <p style="color: green;"><?= session('success') ?></p>
    <?php elseif (session()->has('error')) : ?>
        <p style="color: red;"><?= session('error') ?></p>
    <?php endif; ?>

    <form action="/excel-importer/import" method="post" enctype="multipart/form-data">
        <label for="excel_file">Choose Excel File:</label>
        <input type="file" name="excel_file" id="excel_file" accept=".xls, .xlsx" required>
        <button type="submit">Import</button>
    </form>
</body>

</html>