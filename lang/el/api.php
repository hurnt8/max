<?php

return [

    'auth' => [
        'invalid_credentials' => 'Λανθασμένα στοιχεία σύνδεσης.',
        'clients_only'        => 'Πρόσβαση μόνο για πελάτες.',
        'account_blocked'     => 'Ο λογαριασμός έχει αποκλειστεί. Επικοινωνήστε με την υποστήριξη.',
        'otp_send_failed'     => 'Αδυναμία αποστολής κωδικού OTP.',
        'otp_sent'            => 'Κωδικός OTP στάλθηκε στο :email',
        'otp_invalid'         => 'Μη έγκυρος ή ληγμένος κωδικός OTP.',
        'user_not_found'      => 'Ο χρήστης δεν βρέθηκε.',
        'logged_out'          => 'Αποσυνδεθήκατε.',
    ],

    'transfer' => [
        'negative_balance'     => 'Αρνητικό υπόλοιπο, αδύνατη η μεταφορά.',
        'insufficient_balance' => 'Ανεπαρκές υπόλοιπο.',
        'success'              => 'Η μεταφορά υποβλήθηκε με επιτυχία.',
        'admin_title'          => 'Εκκρεμής μεταφορά — :name',
        'admin_body'           => 'Μεταφορά :amount :currency προς :name',
    ],

    'notification' => [
        'all_read' => 'Όλες οι ειδοποιήσεις σημάνθηκαν ως αναγνωσμένες.',
    ],

    'support' => [
        'empty_message' => 'Κενό μήνυμα.',
    ],

    'profile' => [
        'updated'         => 'Το προφίλ ενημερώθηκε.',
        'same_email'      => 'Αυτή είναι ήδη η τρέχουσα διεύθυνση email σας.',
        'otp_send_failed' => 'Αδυναμία αποστολής κωδικού.',
        'email_otp_sent'  => 'Κωδικός OTP στάλθηκε στο τρέχον email σας.',
        'otp_invalid'     => 'Μη έγκυρος ή ληγμένος κωδικός OTP.',
        'email_updated'   => 'Το email ενημερώθηκε.',
        'wrong_password'  => 'Ο τρέχων κωδικός πρόσβασης είναι λανθασμένος.',
        'password_updated'=> 'Ο κωδικός άλλαξε.',
    ],

    'movement' => [
        'credit_received'   => 'Πίστωση ελήφθη',
        'debit_done'        => 'Χρέωση εκτελέστηκε',
        'transfer_to'       => 'Μεταφορά προς :name',
        'transfer_received' => 'Μεταφορά ελήφθη',
        'system'            => 'Σύστημα',
    ],
];
