<?php include_once('header.php'); ?>  
<?php 
    if(!$question){
        header("location:".base_url('questions/index'));
    }
?>  
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h2>
                <?= $question[0]->question ?>
                <?php if($this->session->userdata('user_id')){ ?>
                <a class="btn btn-danger" href="<?= base_url('users/deletequestion/').$question[0]->question_id ?>">Delete Question</a>
                <?php } ?>
            </h2>
            <div><?= $question[0]->description ?></div>
            <hr/>
            <br/>
            <h4 style="font-size:16px;"><strong><?= $count_answers ?> Answers</strong></h4>
            <ul class="list-group">
                <?php foreach($answers as $a): ?>
                <div class="card border-light mb-3">
                    <div class="card-body">
                        <div style="position:relative">
                            <a href="<?= base_url('users/like/').$a->answer_id."/".$question[0]->question_id; ?>">
                                <img style="position:absolute;top:0px" src="<?= base_url('icons/up.png'); ?>" alt="">
                            </a>
                            <h5 style="position:absolute;top:26px;left:12px;" class="text-center" style="margin:0;"><?php echo ($a->likes - $a->dislikes) ?></h5>
                            <a href="<?= base_url('users/dislike/').$a->answer_id."/".$question[0]->question_id; ?>">
                                <img style="position:absolute;top:40px;" src="<?= base_url('icons/down.png'); ?>" alt="">
                            </a>
                        </div>    
                        <div style="padding-left:40px;padding-top:10px;min-height:60px;"><?= $a->answer; ?></div>
                    <hr/>
                    <p class="card-text text-right">
                        <span style="font-size:13px;" class="badge badge-light">
                            <?= ucfirst($a->fname)." ".ucfirst($a->lname) ?>
                            <?php if($this->session->userdata('user_id')==$a->user_id){ ?>
                                <a href="<?= base_url('users/deleteanswer/').$a->answer_id."/".$question[0]->question_id; ?>">Delete</a>    
                            <?php } ?>
                        </span>        
                    </p>
                   
                </div>
                </div>
               
                <?php endforeach ?>
            </ul>
            <br/>
            <div>
                <?= form_open('users/viewquestion/'.$question[0]->question_id, ['id'=>'answerform']); ?>
                    <div class="form-group">
                        <label for=""><strong>Your Answer</strong></label>
                        <?= form_textarea(['name'=>'answer', 'style'=>'display:none', 'id'=>'summernote']); ?>
                        <?= form_error('answer', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <?= form_hidden('user_id', $this->session->userdata('user_id')); ?>
                        <?= form_hidden('question_id', $question[0]->question_id); ?>
                        <?= form_submit(['value'=>'submit', 'class'=>'btn btn-primary']); ?>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <img src="https://s0.2mdn.net/6519603/InstantGames_Develop_2_Static_en_US_300x600.jpg" style="width:100%" alt="">
        </div>
    </div>
<?php include_once('footer.php'); ?>
    