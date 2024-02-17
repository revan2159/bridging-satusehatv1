<?php
return
    [
        'client_id' => getenv('SATUSEHAT_CLIENTID'),
        'client_secret' => getenv('SATUSEHAT_CLIENTSECRET'),
        'organization_id' => getenv('SATUSEHAT_ORGID'),
        'auth_url' => getenv('SATUSEHAT_AUTH'),
        'base_url' => getenv('SATUSEHAT_BASE'),
        'consent_url' => getenv('SATUSEHAT_CONSENT'),
        'kfa_url' => getenv('SATUSEHAT_KFA'),
        'kyc_url' => getenv('SATUSEHAT_KYC'),
    ];
