<?php

    require_once('init.php');
    require_once('twitterFunctions.php');

    Logger::debug('wot m8');

    // Tweet with missing image
    echo "1...";
    $result = tweetMessage('Should fail', '/var/opt/escape/invalid.png');
    assert($result == E_IMAGE_NOT_FOUND);

    echo "2...";
    // Tweet corrupt image
    $result = tweetMessage('Should fail', '/var/opt/escape/corrupt.png');

    assert($result == E_IMAGE_UPLOAD_FAILED);

 ?>
