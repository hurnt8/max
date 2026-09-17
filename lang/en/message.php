<?php

return [
    'success_contact' => 'message sent successfully',
    'success_sbscribe' => 'Subscription successfully completed',
    'error' => 'An error occurred while sending. Please try again later.',
    'success_loan' => 'Your aid request has been sent successfully. We will provide you with a response as soon as possible.',
    'error_loan' => 'An error occurred while sending your aid request. Please try again later.',

    // Aid request emails
    'months'               => 'months',
    'month_abbr'           => 'mo',
    'optional'             => 'optional',
    'loan_admin_subject'   => 'New aid request',
    'loan_admin_intro'     => 'Someone has just submitted an aid request via the ' . site_name() . ' website.',

    'loan_confirm_subject'   => 'Your aid request is being processed',
    'loan_confirm_greeting'  => 'Hello :name,',
    'loan_confirm_body'      => 'We have received your aid request for an amount of :amount :currency over :duration months. It is currently being processed by our team.',
    'loan_confirm_footer'    => 'We will contact you as soon as possible. Thank you for trusting us.',
    'loan_confirm_signature' => 'The ' . site_name() . ' team',
    'loan_confirm_noreply'   => 'This email was sent from a no-reply address. Please do not reply directly to this message.',
    'no_reply_notice' => 'This is an automatically generated email. Please do not reply.',

    'loan_conditions_title'  => 'Eligibility conditions',
    'loan_conditions_text'   => 'To receive aid, you must be of legal age and able to present your situation. Each case is reviewed with care and consideration.',
    'loan_complete_btn'      => 'Complete my request',
    'loan_complete_intro'    => 'To finalise your case file, please click the button below to send us your full address and a copy of your ID.',

    'docs_subject'   => 'Documents — Aid request',
    'docs_intro'     => 'The person has submitted their documents to complete their aid request.',
    'docs_name'      => 'Name',
    'docs_email'     => 'Email',
    'docs_address'   => 'Address',
    'docs_tax_number' => 'Tax number',
    'docs_activity'  => 'Occupation',
    'docs_id_photo'  => 'Identity document',
    'docs_doc_type'  => 'Document type',
    'docs_recto'     => 'Front side',
    'docs_verso'     => 'Back side',
    'docs_success'   => 'Your documents have been sent. Our team will review them as soon as possible.',
    'docs_already_sent'  => 'Your documents have already been sent or the form has expired. Please reload this page if you wish to resend your documents.',

    'doc_type_id_card'   => 'National ID card',
    'doc_type_passport'  => 'Passport',
    'doc_type_license'   => 'Driving licence',
    'doc_type_residence' => 'Residence permit',
    'doc_type_other'     => 'Other document',

    'docs_confirm_subject'   => 'Your documents have been received',
    'docs_confirm_greeting'  => 'Hello :name,',
    'docs_confirm_body'      => 'We have received your documents (address and identity document). Our team will review them and get back to you within 24 hours.',
    'docs_confirm_footer'    => 'Thank you for your trust. We remain available for any questions.',
    'docs_confirm_signature' => 'The ' . site_name() . ' team',

    'docs_upload_hint'  => 'Drag and drop or click to choose a file',
    'docs_single_photo' => 'For this document type, a single photo is enough.',
];
