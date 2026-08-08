<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Αυτά τα διαπιστευτήρια δεν αντιστοιχούν σε κανέναν λογαριασμό.',
    'password' => 'Ο κωδικός πρόσβασης που δώσατε είναι λανθασμένος.',
    'throttle' => 'Πάρα πολλές προσπάθειες. Δοκιμάστε ξανά σε :seconds δευτερόλεπτα.',

    'client_login_title'  => 'Χώρος πελάτη',
    'client_login_sub'    => 'Συνδεθείτε για πρόσβαση στους φακέλους σας',
    'client_brand_title'  => 'Ο χώρος πελάτη<br>σας AURELIS CAPITAL GROUP',
    'client_brand_sub'    => 'Παρακολουθήστε τις αιτήσεις σας, διαχειριστείτε το προφίλ σας και αποκτήστε πρόσβαση σε όλα τα έγγραφά σας με ασφάλεια.',

    'staff_login_title'   => 'Πύλη διαχείρισης',
    'staff_login_sub'     => 'Αποκλειστικά για εξουσιοδοτημένο προσωπικό',
    'staff_brand_title'   => 'Διαχείριση<br>AURELIS CAPITAL GROUP',
    'staff_brand_sub'     => 'Ασφαλής πρόσβαση σε εργαλεία διαχείρισης, παρακολούθησης φακέλων και διαχείρισης χρηστών.',

    'email'               => 'Διεύθυνση email',
    'email_staff'         => 'Επαγγελματικό email',
    'email_ph'            => 'esys@paradeigma.com',
    'email_ph_staff'      => 'agent@aureliscapital.online',
    'password_label'      => 'Κωδικός πρόσβασης',
    'remember'            => 'Να με θυμάσαι',
    'remember_staff'      => 'Παραμονή συνδεδεμένου',
    'submit'              => 'Σύνδεση',
    'submit_staff'        => 'Είσοδος στον πίνακα ελέγχου',
    'back_site'           => 'Επιστροφή στον ιστότοπο',
    'staff_portal_link'   => 'Πύλη υπαλλήλου / διαχειριστή',
    'client_portal_link'  => 'Χώρος πελάτη',
    'staff_restricted'    => 'Περιορισμένη πρόσβαση — Εξουσιοδοτημένο προσωπικό',
    'staff_notice'        => 'Αυτή η πύλη προορίζεται αποκλειστικά για υπαλλήλους της AURELIS CAPITAL GROUP. Όλες οι συνδέσεις καταγράφονται.',
    'or_staff'            => 'Είστε υπάλληλος ή διαχειριστής;',
    'or_client'           => 'Είστε πελάτης;',

    'stat_clients'        => 'Ικανοποιημένοι πελάτες',
    'stat_amount'         => 'Μέγ. δάνειο / φάκελο',
    'stat_time'           => 'Εγγυημένη απάντηση',
    'stat_years'          => 'Χρόνια εμπειρίας',

    'feature_secure'      => 'Κρυπτογραφημένα δεδομένα',
    'feature_currencies'  => '6 αποδεκτά νομίσματα',
    'feature_certified'   => 'Ευρωπαϊκή άδεια',
    'feature_fast'        => 'Απάντηση εντός 48 ωρών',

    'role_superadmin'     => 'Υπερδιαχειριστής',
    'role_superadmin_sub' => 'Καθολική διαχείριση & ρόλοι',
    'role_admin'          => 'Διαχειριστής',
    'role_admin_sub'      => 'Διαχείριση φακέλων',

    // Identifier (email or phone)
    'identifier'          => 'Email ή τηλέφωνο',
    'identifier_ph'       => 'to@email.sas ή +33...',
    'forgot_password'     => 'Ξεχάσατε τον κωδικό πρόσβασης;',
    'portal_clients_only' => 'Αυτή η πύλη προορίζεται αποκλειστικά για πελάτες.',

    // OTP page
    'otp_title'           => 'Επαλήθευση',
    'otp_heading'         => 'Κωδικός ασφαλείας',
    'otp_subtitle'        => 'Σας στείλαμε έναν 6ψήφιο κωδικό στο',
    'otp_enter'           => 'Εισαγάγετε τον κωδικό που λάβατε μέσω email',
    'otp_verify_btn'      => 'Επαλήθευση',
    'otp_resend'          => 'Επαναποστολή κωδικού',
    'otp_resend_in'       => 'Επαναποστολή σε',
    'otp_back'            => 'Αλλαγή λογαριασμού',
    'otp_verifying'       => 'Επαλήθευση σε εξέλιξη…',
    'otp_invalid'         => 'Λανθασμένος κωδικός. Σας απομένουν :remaining προσπάθεια(ες).',
    'otp_expired'         => 'Αυτός ο κωδικός έχει λήξει. Ζητήστε έναν νέο.',
    'otp_too_many'        => 'Πάρα πολλές προσπάθειες. Δοκιμάστε ξανά σε :seconds δευτερόλεπτα.',
    'otp_resend_limit'    => 'Πάρα πολλές επαναποστολές. Δοκιμάστε ξανά σε λίγα λεπτά.',
    'otp_send_failed'     => 'Δεν ήταν δυνατή η αποστολή του κωδικού. Δοκιμάστε ξανά.',
    'otp_session_expired' => 'Η συνεδρία έληξε. Συνδεθείτε ξανά.',
    'otp_resend_success'  => 'Νέος κωδικός εστάλη!',

    // Compte mémorisé
    'change_account' => 'Αλλαγή λογαριασμού',

    // Compte bloqué
    'account_blocked'                     => 'Ο λογαριασμός σας έχει αποκλειστεί λόγω πολλών λανθασμένων προσπαθειών. Ελέγξτε το email σας για να λάβετε τον σύνδεσμο ξεκλειδώματος.',
    'account_blocked_notified'            => 'Πάρα πολλές λανθασμένες προσπάθειες. Ο λογαριασμός σας αποκλείστηκε. Ένας σύνδεσμος ξεκλειδώματος σας εστάλη μέσω email.',
    'account_unblocked'                   => 'Ο λογαριασμός σας ξεκλειδώθηκε με επιτυχία. Μπορείτε τώρα να συνδεθείτε.',
    'unblock_invalid'                     => 'Αυτός ο σύνδεσμος ξεκλειδώματος δεν είναι έγκυρος ή έχει λήξει. Επικοινωνήστε με την υποστήριξη.',

    'account_blocked_email_subject'       => 'Ο λογαριασμός σας AURELIS CAPITAL GROUP αποκλείστηκε',
    'account_blocked_email_title'         => 'Λογαριασμός προσωρινά αποκλεισμένος',
    'account_blocked_email_intro'         => 'Ο λογαριασμός σας αποκλείστηκε προσωρινά λόγω πολλών λανθασμένων προσπαθειών σύνδεσης.',
    'account_blocked_email_reason_title'  => 'Γιατί έγινε αυτός ο αποκλεισμός;',
    'account_blocked_email_reason_body'   => 'Καταχωρίστηκαν 4 λανθασμένοι κωδικοί OTP διαδοχικά κατά την προσπάθεια σύνδεσης στον λογαριασμό σας. Για λόγους ασφαλείας, η πρόσβαση ανεστάλη.',
    'account_blocked_email_btn'           => 'Ξεκλείδωμα του λογαριασμού μου',
    'account_blocked_email_fallback'      => 'Εάν το κουμπί δεν λειτουργεί, αντιγράψτε αυτόν τον σύνδεσμο στο πρόγραμμα περιήγησής σας:',
    'account_blocked_email_notice'        => 'Εάν δεν πραγματοποιήσατε εσείς αυτές τις προσπάθειες, μην κάνετε κλικ σε αυτόν τον σύνδεσμο και επικοινωνήστε αμέσως με την υποστήριξη της AURELIS CAPITAL GROUP.',
    'account_blocked_email_footer'        => 'Ο σύνδεσμος ισχύει για 48 ώρες.',

    // OTP email
    'otp_email_subject'      => 'Ο κωδικός σύνδεσής σας — AURELIS CAPITAL GROUP',
    'otp_email_title'        => 'Κωδικός επαλήθευσης',
    'otp_email_intro'        => 'Αυτός είναι ο κωδικός σύνδεσης μίας χρήσης. Μην τον κοινοποιήσετε σε κανέναν.',
    'otp_email_code_label'   => 'Ο κωδικός σας',
    'otp_email_expiry'       => 'Αυτός ο κωδικός λήγει σε 10 λεπτά.',
    'otp_email_notice_title' => 'Σημαντική ειδοποίηση ασφαλείας',
    'otp_email_notice_body'  => 'Η AURELIS CAPITAL GROUP δεν θα σας ζητήσει ποτέ αυτόν τον κωδικό τηλεφωνικά ή μέσω μηνύματος. Εάν δεν ζητήσατε αυτόν τον κωδικό, αγνοήστε αυτό το email.',
    'otp_email_footer'       => 'Εάν δεν ζητήσατε αυτόν τον κωδικό, αγνοήστε αυτό το email.',

    // Bannière d'installation PWA (pages de connexion)
    'pwa_install_title' => 'Εγκατάσταση εφαρμογής',
    'pwa_install_hint'  => 'Γρήγορη πρόσβαση · Ειδοποιήσεις · Λειτουργία εκτός σύνδεσης',
    'pwa_install_btn'   => 'Εγκατάσταση',
    'pwa_ios_title'     => 'Εγκαταστήστε την εφαρμογή AURELIS CAPITAL GROUP στο iPhone σας',
    'pwa_ios_step1'     => 'Πατήστε <strong>Κοινή χρήση</strong> στο Safari',
    'pwa_ios_step2'     => 'Επιλέξτε <strong>Προσθήκη στην Αρχική οθόνη</strong>',
    'pwa_ios_step3'     => 'Πατήστε <strong>Προσθήκη</strong> — έτοιμο!',
    'pwa_close'         => 'Κλείσιμο',

];
