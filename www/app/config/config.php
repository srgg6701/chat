<?php
// настройки локальной машины
$config = array(

  // Database settings

  'dbHost'          => '127.0.0.1',
  'dbPort'          => 3306,
  'dbUser'          => 'root',
  'dbPassword'      => '',
  'dbName'          => 'mirrormx_customer_chat',

  // Настройки локализации
  'lang' => array(

    'default' => array(
      // На Debian работает такое указание локали
      'locale' => 'ru_RU.UTF-8',
      // В других системах вероятно будет работать с таким значением
//      'locale' => 'ru_RU',
      'codeset' => 'UTF-8',
    ),

    'domain' => 'newrobocall',
    'path' => ROOT_PATH.'/vendor/locale',
  ),

  // Chat application admin user

  'superUser' => 'admin',
  'superPass' => 'admin123',

  // Other (do not modify manually)

  'dbType' => 'mysql',

  'avatarImageSize' => 40,
  // clarify: разобраться, зачем нужен этот конфиг, если уже есть www/app/config/app.settings.php
  'defaultSettings' => array(

    'theme'                  => 'default', // тема по умолчанию
    'widgetTheme'            => 'indavino-black', //themes-widget/indavino-black
    //'primaryColor'           => '#36a9e1',
    //'secondaryColor'         => '#86C953',
    //'labelColor'             => '#ffffff',
    //'headerHeight'           => 55,
    //'widgetWidth'            => 370,
    //'widgetHeight'           => 411,
    //'widgetOffset'           =>  50,
    //'mobileBreakpoint'       => 550,

    'contactMail'            => 'admin@domain.com',
    'hideWhenOffline'        => false,
    'loadingLabel'           => 'Loading...',
    'loginError'             => 'Login error',
    'chatHeader'             => 'Talk to us',
    'startInfo'              => 'Please fill the following form to start the chat',
    'maxConnections'         => 5,
    'messageSound'           => 'audio/default.mp3',
    'startLabel'             => 'Start',
    'backLabel'              => 'Back',
    'initMessageBody'        => 'Hello, how may I help you?',
    'initMessageAuthor'      => 'Operator',
    'chatInputLabel'         => 'Write your question',
    'timeDaysAgo'            => 'day(s) ago',
    'timeHoursAgo'           => 'hour(s) ago',
    'timeMinutesAgo'         => 'minute(s) ago',
    'timeSecondsAgo'         => 'second(s) ago',
    'offlineMessage'         => 'Operator went off-line',
    'toggleSoundLabel'       => 'Sound effects',
    'toggleScrollLabel'      => 'Auto-scroll',
    'toggleEmoticonsLabel'   => 'Emoticons',
    'toggleAutoShowLabel'    => 'Auto-show',
    'toggleFullscreenLabel'  => 'Toggle fullscreen',
    'endChatLabel'           => 'End the chat',
    'endChatConfirmQuestion' => 'Are you sure?',
    'endChatConfirm'         => 'Yes',
    'endChatCancel'          => 'Cancel',
    'contactHeader'          => 'Contact us',
    'contactInfo'            => 'All operators are off-line. Use the below form to send us an e-mail with your question.',
    'contactNameLabel'       => 'Your name',
    'contactMailLabel'       => 'Your e-mail',
    'contactQuestionLabel'   => 'Your question',
    'contactSendLabel'       => 'Send',
    'contactSuccessHeader'   => 'Message sent',
    'contactSuccessMessage'  => 'Your question has been sent. Thank you!',
    'contactErrorHeader'     => 'Error',
    'contactErrorMessage'    => 'There was an error sending your question'
  )
);

// Generate connection strings

$config['dbConnectionRaw_mysql'] = 'mysql:host=' . $config['dbHost'] . ';port=' . $config['dbPort'];
$config['dbConnection_mysql']    = 'mysql:dbname=' . $config['dbName'] . ';host=' . $config['dbHost'] . ';port=' . $config['dbPort'];

// Used connection strings

$config['dbConnectionRaw'] = $config['dbConnectionRaw_' . $config['dbType']];
$config['dbConnection']    = $config['dbConnection_'    . $config['dbType']];

return $config;

?>
