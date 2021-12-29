<?php require_once 'partial/header.php' ?>

<div class="col-md-6 offset-md-3">
    <form method="post" action="process.php" enctype="multipart/form-data">
        <div class="row p-3">
            <input type="file" name="uploaded_file"/>
        </div>
        <div class="row p-3">
            <input class="btn-success" type="submit" value="Process">
        </div>
    </form>
</div>

<?php require_once 'partial/footer.php' ?>
