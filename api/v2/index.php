<?php

namespace App\API\V2;

require __DIR__ . '/include.php';
$router = new \Bramus\Router\Router();

// Add CORS headers to all responses (for development)
$router->before('GET|POST|PUT|DELETE|OPTIONS', '/.*', function () {
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");
	header("Access-Control-Allow-Credentials: true");
});

// Define routes
$router->setNamespace('\App\API\V2\Controller');
$router->get('/', 'WelcomeController@Root');

//-- Authentication Routes
$router->post('/auth/login', 'AuthenticationController@Login');
$router->post('/auth/logout', 'AuthenticationController@Logout');
$router->post('/auth/signup', 'AuthenticationController@Signup');
$router->post('/auth/check', 'AuthenticationController@Check');

//-- User Routes
$router->get('/user/me', 'UserController@GetUserInformation');
$router->get('/user/me_new', 'UserController@GetUserInformationNew');

//-- Case Routes
$router->post('/cases/getfull', 'CasesController@getCases');
$router->post('/cases/submit', 'CasesController@submitCase');

//-- Guide Routes
$router->post('/guide/add', 'GuideController@addGuide');
$router->post('/guide/edit', 'GuideController@editGuide');
//$router->post('/guide/delete', 'GuideController@deleteGuide');
$router->post('/guide/full', 'GuideController@getFullGuide');
$router->get('/guide/get', 'GuideController@getGuides');

//-- Notification Routes
$router->get('/notifications/get', 'NotificationController@getNotifications');
$router->post('/notifications/set', 'NotificationController@setNotifications');
$router->post('/notifications/essential/mark', 'NotificationController@markEssentialRead');

//-- Search Routes
$router->get('/search/players', 'SearchController@players');

//-- Statistics Routes
$router->get('/statistics/cases/daily', 'StatisticsController@DailyCases');
$router->get('/statistics/cases/weekly', 'StatisticsController@WeeklyCases');
$router->get('/statistics/game/server', 'StatisticsController@ServerStatistics');

//-- Staff Routes
$router->get('/staff/cases/list', 'StaffController@List');
$router->get('/staff/list', 'StaffController@ListStaffTeam');
$router->post('/staff/rank/update', 'StaffController@UpdateStaffRank');
$router->post('/staff/team/update', 'StaffController@UpdateStaffTeam');

// Execute the router
$router->run();
