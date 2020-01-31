<?php

return [
    'title' =>'Reset Password',
    'forms' =>[
        'label'=>[
            'new_password'=>'New Password',
            'confirm_password'=>'Confirm Password'
        ],
        'placeholder'=>[
            'new_password'=>'Enter new password',
            'confirm_password'=>'Confirm your new password'
        ],
        'note'=>[
            'email'=>"We'll never share your email with anyone else."
        ]
    ],
    'buttons'=>[
        'submit'=>'Submit'
    ],
    'messages'=>[
        'success'=>[
            'reset_password'=>'Congratulation, your password is updated.',
        ]
    ],
    'email'=>[
        'title'=>'Reset Password',
        'line1'=>'You are receiving this email because you have requested to reset your password.',
        'line2'=>'Click the link below to reset your password:',
        'line3'=>'Reset Password',
        'line4'=>'If you did not ask for this email yourself, you can simply delete it again and continue logging in with your chosen password.',
        'line5'=>'The best greetings,',
        'line6'=>'Elightwalk',
    ]
];

?>
