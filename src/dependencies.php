<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// PDO database library
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'].";charset=UTF8",
        $settings['user'], $settings['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

//DIR upload file
$container['upload_directory'] = function ($c) {
    return __DIR__ . '/uploads';
};

// controller
$container['CommonController'] = function($c) {
    return new Controllers\CommonController($c['db'],$c['upload_directory']);
};
$container['ArticleController'] = function($c) {
    return new Controllers\ArticleController($c['db'], $c['upload_directory']);
};
$container['AccountController'] = function($c) {
    return new Controllers\AccountController($c['db']);
};
$container['CompanyController'] = function($c) {
    return new Controllers\CompanyController($c['db']);
};
$container['AddressController'] = function($c) {
    return new Controllers\AddressController($c['db']);
};
$container['CompanyTempController'] = function($c) {
    return new Controllers\CompanyTempController($c['db']);
};
$container['UserTempController'] = function($c) {
    return new Controllers\UserTempController($c['db']);
};
$container['BankAccountController'] = function($c) {
    return new Controllers\BankAccountController($c['db']);
};
$container['CompanySettingController'] = function($c) {
    return new Controllers\CompanySettingController($c['db']);
};
$container['CreditApprovalLogController'] = function($c) {
    return new Controllers\CreditApprovalLogController($c['db']);
};
$container['SurveyController'] = function($c) {
    return new Controllers\SurveyController($c['db']);
};
$container['HistoryChatController'] = function($c) {
    return new Controllers\HistoryChatController($c['db']);
};
$container['CommentSurveyController'] = function($c) {
    return new Controllers\CommentSurveyController($c['db']);
};
$container['SurveyInfoController'] = function($c) {
    return new Controllers\SurveyInfoController($c['db']);
};
$container['NotifyInboxController'] = function($c) {
    return new Controllers\NotifyInboxController($c['db']);
};
$container['GroundSurveyReportController'] = function($c) {
    return new Controllers\GroundSurveyReportController($c['db']);
};
$container['JudgementController'] = function($c) {
    return new Controllers\JudgementController($c['db']);
};
$container['ConstructionPlanController'] = function($c) {
    return new Controllers\ConstructionPlanController($c['db']);
};
$container['ProfileController'] = function($c) {
    return new Controllers\ProfileController($c['db']);
};
$container['CostBalanceController'] = function($c) {
    return new Controllers\CostBalanceController($c['db']);
};
$container['SecurityController'] = function($c) {
    return new Controllers\SecurityController($c['db']);
};
$container['SurveyChatController'] = function($c) {
    return new Controllers\SurveyChatController($c['db']);
};