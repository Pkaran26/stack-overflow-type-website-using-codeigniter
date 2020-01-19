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
                <?php if($this->session->userdata('admin_id')){ ?>
                <a class="btn btn-danger" href="<?= base_url('admin/deletequestion/').$question[0]->question_id ?>">Delete Question</a>
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
                            <img style="position:absolute;top:0px" src="<?= base_url('icons/up.png'); ?>" alt="">
                            <h5 style="position:absolute;top:26px;left:12px;" class="text-center" style="margin:0;"><?php echo ($a->likes - $a->dislikes) ?></h5>
                            <img style="position:absolute;top:40px;" src="<?= base_url('icons/down.png'); ?>" alt="">
                        </div>    
                        <div style="padding-left:40px;padding-top:10px;min-height:60px;"><?= $a->answer; ?></div>
                    <hr/>
                    <p class="card-text text-right">
                        <span style="font-size:13px;" class="badge badge-light">
                            <?= ucfirst($a->fname)." ".ucfirst($a->lname) ?>
                            <?php if($this->session->userdata('admin_id')){ ?>
                                <a href="<?= base_url('admin/deleteanswer/').$a->answer_id."/".$question[0]->question_id; ?>">Delete</a>    
                            <?php } ?>
                        </span>        
                    </p>
                   
                </div>
                </div>
               
                <?php endforeach ?>
            </ul>
            <br/>
        </div>
        <div class="col-lg-4 col-md-4">
            
        </div>
    </div>
<?php include_once('footer.php'); ?>
    