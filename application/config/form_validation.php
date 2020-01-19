<?php
$config = [
    'add_user_register_rules'=>[
        [
            'field'=>'fname',
            'label'=>'First Name',
            'rules'=>'trim|required|alpha'
        ],
        [
            'field'=>'lname',
            'label'=>'Last Name',
            'rules'=>'trim|required|alpha'
        ],
        [
            'field'=>'email',
            'label'=>'Email id',
            'rules'=>'trim|required|valid_email|is_unique[users.email]'
        ],
        [
            'field'=>'password',
            'label'=>'Password',
            'rules'=>'trim|required'
        ],
        [
            'field'=>'rpassword',
            'label'=>'Re-password',
            'rules'=>'trim|required'
        ]
    ],
    'add_user_login_rules'=>[
        [
            'field'=>'email',
            'label'=>'Email id',
            'rules'=>'trim|required|valid_email'
        ],
        [
            'field'=>'password',
            'label'=>'Password',
            'rules'=>'trim|required'
        ]
    ],
    'add_question_rules'=>[
        [
            'field'=>'question',
            'label'=>'Question',
            'rules'=>'trim|required'
        ],
        [
            'field'=>'description',
            'label'=>'Description',
            'rules'=>'trim|required'
        ],
        [
            'field'=>'tags',
            'label'=>'Tags',
            'rules'=>'trim|required'
        ]
    ],
    'add_answer_rules'=>[
        [
            'field'=>'answer',
            'label'=>'Answer',
            'rules'=>'trim|required'
        ]
    ]
]
?>