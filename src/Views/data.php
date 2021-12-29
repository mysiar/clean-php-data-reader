<?php require_once 'partial/header.php' ?>

    <div class="col-md-6 offset-md-3 d-flex justify-content-center p-3">
        <table class='table table-striped table-hover'>
            <?php
                foreach ($data['data'] as $record) {
                    require 'partial/datarow.php';
                }
            ?>
        </table>
    </div>
    <div class="col-md-6 offset-md-3 d-flex justify-content-center">
        <a class="btn btn-success" href="/">Back</a>
    </div>

<?php require_once 'partial/footer.php' ?>
