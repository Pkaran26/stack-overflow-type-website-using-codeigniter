<?php include_once('header.php'); ?>
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="card border-default mb-3">
                <div class="card-header">
                    <h5>Question Tags</h5>
                </div>
                <div class="card-body" style="height:350px;overflow:auto">
                    <?php foreach($tags as $t): ?>
                        <p class="card-text"><?= $t->tag ?></p>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
        <div class="card border-default mb-3">
                <div class="card-header">
                    <h5>Add Question Tags</h5>
                </div>
                <div class="card-body" style="">
                    <div class="form-group">
                        <label for="">Tag Name</label>
                        <?= form_input(['name'=>'tag', 'class'=>'form-control']); ?>
                        <?= form_error('tag','<div class="text-danger">','</div>') ?>
                    </div>
                    <div class="form-group">
                        <?= form_submit(['class'=>'btn btn-primary', 'value'=>'Submit']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once('footer.php'); ?>
    