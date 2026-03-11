<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('blocked', 'Auth::forbiddenPage');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::storeRegister');

$routes->get('dashboard', 'Home::index', ['filter' => 'isLoggedIn']);
$routes->get('dashboard-v2', 'Home::dashboardV2', ['filter' => 'isLoggedIn']);
$routes->get('dashboard-v3', 'Home::dashboardV3', ['filter' => 'isLoggedIn']);

// Profile Routes
$routes->get('profile', 'ProfileController::show', ['filter' => 'isLoggedIn']);
$routes->get('profile/edit', 'ProfileController::edit', ['filter' => 'isLoggedIn']);
$routes->post('profile/update', 'ProfileController::update', ['filter' => 'isLoggedIn']);

// Setting Routes
$routes->group('users', static function ($routes) {
    $routes->get('/', 'Settings::users');
    $routes->post('create-role', 'Settings::createRole');
    $routes->post('update-role', 'Settings::updateRole');
    $routes->delete('delete-role/(:num)', 'Settings::deleteRole/$1');

    $routes->get('role-access', 'Settings::roleAccess');
    $routes->post('create-user', 'Settings::createUser');
    $routes->post('update-user', 'Settings::updateUser');
    $routes->delete('delete-user/(:num)', 'Settings::deleteUser/$1');

    $routes->post('change-menu-permission', 'Settings::changeMenuPermission');
    $routes->post('change-menu-category-permission', 'Settings::changeMenuCategoryPermission');
    $routes->post('change-submenu-permission', 'Settings::changeSubMenuPermission');
});

$routes->group('menu-management', static function ($routes) {
    $routes->get('/', 'Settings::menuManagement');
    $routes->post('create-menu-category', 'Settings::createMenuCategory');
    $routes->post('create-menu', 'Settings::createMenu');
    $routes->post('create-submenu', 'Settings::createSubMenu');
});
$routes->get('menu','Menu::index');

// Student Routes
$routes->get('students', 'Student::index');
$routes->post('student/store', 'Student::store');
$routes->delete('student/delete/(:num)', 'Student::delete/$1');

// Records CRUD Routes (RESTful Resource)
$routes->get('records/dashboard', 'Records::dashboard', ['filter' => 'isLoggedIn|isGranted']);
$routes->resource('records');

// Computers CRUD Routes (RESTful Resource)
$routes->resource('computers');