<?php

return [
    'user' => [
        'verify_email' => [
            'success' => 'Email authentication successful',
            'error' => 'Email authentication failed'
        ],
        'success' => [
            'create' => 'Register account was successful. Please check your email to verify your account.',
        ],
        'error' => [
            'login' => 'Login error, please check your email or password',
            'active' => 'Your account has not been activated, please check your email for authentication.',
            'block' => 'This account has been locked due to excessive login attempts. Please contact admin to unlock.'
        ]
    ],
    'profile' => [
        'success' => [
            'update' => 'Update or create profile was successful',
            'update_image' => 'Update image successful'
        ],
        'error' => [
            'update' => 'Update profile was fail'
        ],
    ],
    'comment' => [
        'success' => [
            'create' => 'Create comment was successful',
            'delete' => 'Delete comment was successful',
            'update' => 'Update comment was successful',
        ],
        'error' => [
            'create' => 'Create comment was failed',
            'delete' => 'Delete comment was failed',
            'update' => 'Update comment was failed',
        ],
    ],
    'cart' => [
        'success' => [
            'create' => 'Added to cart successfully!',
            'delete' => 'successfully removed the course from the shopping cart',
        ],
        'error' => [
            'create' => 'Failed to add to cart!',
            'delete' => 'Removing course from cart failed'
        ]
    ],
    'password' => [
        'success' => [
            'forgot_password' => 'A reset link has been sent !',
            'reset_password' => 'Reset Password Successfully!'
        ],
        'error' => [
            'forgot_password' => 'Already sent the link to your email !',
            'reset_password' => 'Error token !'
        ]
    ],
    'review' => [
        'success' => [
            'create' => 'Add review successfull!',
        ],
        'error' => [
            'create' => 'Failed to add review!'
        ],
    ],
    'instructor' => [
        'success' => [
            'send' => 'Send mail successfully',
            'register' => 'Register instructor successfully',
            'profile' => [
                'update' => 'Update profile successfully'
            ]
        ],
        'error' => [
            'request' => 'Please waiting 1 minutes to send email again',
            'register' => 'You have register instructor',
            'profile' => [
                'update' => 'Failed to update profile'
            ]
        ]
    ],
    'checkout' => [
        'error' => [
            'save' => 'Please choose at least one course'
        ],
    ],
    'order' => [
        'error' => [
            'create_order' => 'The course has been purchased'
        ]
    ],
    'topic' => [
        'success' => [
            'create' => 'Create topic was successful',
        ],
        'error' => [
            'create' => 'Create comment was failed'
        ]
    ],
    'file' => [
        'success' => [
            'upload' => 'Upload files were successful',
        ]
        ],
    'payment' => [
        'paypal' => [
            'error' => 'Something went wrong.',
            'cancel' => 'You have canceled the transaction.'
        ]
        ],
    'favorite' => [
        'success' => [
            'delete' => 'Remove favorite course successfull',
            'create' => 'Add favorite course successfull'
        ],
        'error' => [
            'create' => 'Add favorite course error'
        ]
    ]
];
