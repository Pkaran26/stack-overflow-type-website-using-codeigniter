<?php include_once('header.php'); ?>
    <h2>
        Welcome <?php echo $this->session->userdata('fullname'); ?>
    </h2>
    <hr/>
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <?= form_open('users/addquestion', ['id'=>'questionform']); ?>
            <div class="form-group">
                <label for=""><strong>Question</strong></label>
                <?= form_input(['name'=>'question', 'class'=>'form-control']) ?>
                <?= form_error('question', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group">
                <label for=""><strong>Description</strong></label>
                <?= form_textarea(['name'=>'description', 'id'=>'summernote', 'class'=>'btn btn-primary']); ?>
                <?= form_error('description', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group">
                <label for=""><strong>Tags</strong></label>
                <?= form_input(['name'=>'tags', 'readonly'=>'readonly', 'id'=>'tag', 'class'=>'form-control']) ?>
                <?= form_error('tags', '<div class="text-danger">', '</div>'); ?>
                <br/>
                <div>
                    <?php foreach($tags as $t): ?>
                    <button class="btn btn-danger" style="margin-bottom:5px"><?= $t->tag ?></button>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="form-group">
                <?= form_hidden('user_id', $this->session->userdata('user_id')); ?>
                <?= form_submit(['value'=>'Submit', 'class'=>'btn btn-primary']) ?>
            </div>
            <?= form_close(); ?>
            <?php if($error = $this->session->flashdata('msg')):
                $class = $this->session->flashdata('msg_class') ?>
                <div class="alert <?= $class ?>">
                    <?php echo $error; ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    
<?php include_once('footer.php'); ?>