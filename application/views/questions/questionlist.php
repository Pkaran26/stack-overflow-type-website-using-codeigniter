<?php include_once('header.php'); ?>
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="card border-default mb-3">
                <div class="card-header">
                    <h5>All Questions</h5>
                </div>
                <div class="card-body">
                    <?php foreach($questions as $t): ?>
                    <h5 style="margin:0" class="card-title">
                        <span class="badge badge-primary "><?= $t->total_views ?> <br/> Views</span>
                        <span class="badge badge-primary "><?= file_get_contents(base_url('questions/ans_count/'.$t->question_id)); ?> <br/> Answers</span>
                        <a style="margin-left:10px;" href="<?= base_url('questions/viewquestion/').$t->question_id; ?>">
                            <?= $t->question ?>
                        </a>
                    </h5>
                    <p class="card-text" style="margin-left:170px;">
                        <?php $tags = explode(", ", $t->tags); 
                        foreach ($tags as $tag): ?> 
                            <a href="#" class="badge badge-danger"><?= $tag ?></a>
                        <?php endforeach ?>
                    </p>
                    <p class="card-text text-right">
                        <span style="font-size:14px;" class="badge badge-light">
                            <?= date('d-M-y h:i', strtotime($t->created_at)) ?>
                        </span>
                        <span style="font-size:14px;" class="badge badge-primary">
                            <?= ucfirst($t->fname)." ".ucfirst($t->lname) ?>
                        </span>
                    </p>
                    <?php endforeach ?>
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <img src="https://s0.2mdn.net/6519603/InstantGames_Develop_2_Static_en_US_300x600.jpg" style="width:100%" alt="">
        </div>
    </div>
<?php include_once('footer.php'); ?>
    