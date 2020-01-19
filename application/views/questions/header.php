<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>stackOverflow</title>
    <?= link_tag('https://bootswatch.com/4/yeti/bootstrap.min.css'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"><strong>stack Overflow</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url(); ?>">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('questions/questionlist'); ?>">Questions List</a>
        </li>
        <?php if($this->session->userdata('user_id')){ ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('users/home'); ?>">User Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('users/addquestion'); ?>" >Add Question</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('users/logout'); ?>" >Logout</a>
        </li>
        <?php }else{ ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('users/index'); ?>">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('users/register'); ?>">Signup</a>
        </li>
        <?php } ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    </nav>
    <div class="card text-white bg-primary mb-3">
        <div class="card-header text-center">
            <h2>stack Overflow</h2>
        </div>
        <div class="card-body text-center">
            <h4 class="card-title">Ask & Learn</h4>
            <p class="card-text">Lets ask your problums and find solutions.</p>
        </div>
    </div>
    <div class="container">