<?php
defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'mod_exportgrades\task\export_gringleses',
        'blocking' => 0,
        'minute' => 'R',  // Random minute
        'hour' => '4',    // 4 a.m. every day
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    )
);

