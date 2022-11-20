<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'classes' => [
        'name' => 'Classes',
        'index_title' => 'Classes List',
        'new_title' => 'New Classe',
        'create_title' => 'Create Classe',
        'edit_title' => 'Edit Classe',
        'show_title' => 'Show Classe',
        'inputs' => [
            'nom' => 'Nom',
            'qte' => 'Qte',
        ],
    ],

    'salles' => [
        'name' => 'Salles',
        'index_title' => 'Salles List',
        'new_title' => 'New Salle',
        'create_title' => 'Create Salle',
        'edit_title' => 'Edit Salle',
        'show_title' => 'Show Salle',
        'inputs' => [
            'nom' => 'Nom',
            'qte' => 'Qte',
        ],
    ],

    'reservations' => [
        'name' => 'Reservations',
        'index_title' => 'Reservations List',
        'new_title' => 'New Reservation',
        'create_title' => 'Create Reservation',
        'edit_title' => 'Edit Reservation',
        'show_title' => 'Show Reservation',
        'inputs' => [
            'salle_id' => 'Salle',
            'classe_id' => 'Classe',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'new_title' => 'New Role',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'all_emploitemps' => [
        'name' => 'All Emploitemps',
        'index_title' => 'AllEmploitemps List',
        'new_title' => 'New Emploitemps',
        'create_title' => 'Create Emploitemps',
        'edit_title' => 'Edit Emploitemps',
        'show_title' => 'Show Emploitemps',
        'inputs' => [
            'classe_id' => 'Classe',
            'salle_id' => 'Salle',
            'user_id' => 'User',
            'Ddebut' => 'Ddebut',
            'Dfin' => 'Dfin',
            'prof_id' => 'Prof',
        ],
    ],

    'profs' => [
        'name' => 'Profs',
        'index_title' => 'Profs List',
        'new_title' => 'New Prof',
        'create_title' => 'Create Prof',
        'edit_title' => 'Edit Prof',
        'show_title' => 'Show Prof',
        'inputs' => [
            'nom' => 'Nom',
        ],
    ],
];
