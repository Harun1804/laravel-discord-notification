<?php

return [
    /*
     * A set of colors to associate to the different log levels when using the `RichRecordConverter`
     */
    'colors'     => [
        'DEBUG'     => 0x607d8b,
        'INFO'      => 0x4caf50,
        'NOTICE'    => 0x2196f3,
        'WARNING'   => 0xff9800,
        'ERROR'     => 0xf44336,
        'CRITICAL'  => 0xe91e63,
        'ALERT'     => 0x673ab7,
        'EMERGENCY' => 0x9c27b0,
    ],

    /*
     * A set of emojis to associate to the different log levels. Set to null to disable an emoji for a given level
     */
    'emojis'     => [
        'DEBUG'     => ':beetle:',
        'INFO'      => ':bulb:',
        'NOTICE'    => ':wink:',
        'WARNING'   => ':flushed:',
        'ERROR'     => ':poop:',
        'CRITICAL'  => ':imp:',
        'ALERT'     => ':japanese_ogre:',
        'EMERGENCY' => ':skull:',
    ],
];
