<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Public routes ────────────────────────────────────────────────────────────
$routes->get('/',         'Auth::index');
$routes->get('login',     'Auth::index');
$routes->post('login',    'Auth::login');
$routes->get('logout',    'Auth::logout');
$routes->get('register',  'Auth::register');
$routes->post('register', 'Auth::storeRegister');
$routes->get('blocked',      'Auth::forbiddenPage');
$routes->get('unauthorized', 'Auth::unauthorized');

// ── Student routes — auth|student ────────────────────────────────────────────
$routes->group('', ['filter' => ['auth', 'student']], function ($routes) {
    $routes->get('student/dashboard',       'StudentDashboardController::index');
    $routes->get('student/profile/edit',    'ProfileController::edit');
    $routes->post('student/profile/update', 'ProfileController::update');
});

// ── Teacher routes — auth|teacher (teacher + admin) ──────────────────────────
$routes->group('', ['filter' => ['auth', 'teacher']], function ($routes) {
    $routes->get('dashboard',                        'Home::index');
    $routes->get('dashboard-v2',                     'Home::dashboardV2');
    $routes->get('dashboard-v3',                     'Home::dashboardV3');
    $routes->get('profile',                          'ProfileController::show');
    $routes->get('profile/edit',                     'ProfileController::edit');
    $routes->post('profile/update',                  'ProfileController::update');
    $routes->get('students',                         'StudentManagementController::index');
    $routes->get('students/show/(:num)',              'StudentManagementController::show/$1');
    $routes->get('students/edit/(:num)',              'Student::edit/$1');
    $routes->post('students/update/(:num)',           'Student::update/$1');

    // Records
    $routes->get('records',                          'Records::index');
    $routes->get('records/new',                      'Records::new');
    $routes->post('records/create',                  'Records::create');
    $routes->get('records/(:num)',                   'Records::show/$1');
    $routes->get('records/(:num)/edit',              'Records::edit/$1');
    $routes->post('records/(:num)/update',           'Records::update/$1');
    $routes->delete('records/(:num)/delete',         'Records::delete/$1');
    $routes->get('records/dashboard',                'Records::dashboard');

});

// ── Admin routes — auth|admin ─────────────────────────────────────────────────
$routes->group('admin', ['filter' => ['auth', 'admin']], function ($routes) {
    // Roles CRUD
    $routes->get('roles',                      'Admin\RoleController::index');
    $routes->get('roles/create',               'Admin\RoleController::create');
    $routes->post('roles/store',               'Admin\RoleController::store');
    $routes->get('roles/edit/(:num)',          'Admin\RoleController::edit/$1');
    $routes->post('roles/update/(:num)',       'Admin\RoleController::update/$1');
    $routes->get('roles/delete/(:num)',        'Admin\RoleController::delete/$1');

    // Users
    $routes->get('users',                          'Admin\UserAdminController::index');
    $routes->post('users/assign-role/(:num)',       'Admin\UserAdminController::assignRole/$1');
    $routes->post('users/delete/(:num)',            'Admin\UserAdminController::deleteUser/$1');

    // Settings / menu management (admin only)
    $routes->get('users/role-access',                        'Settings::roleAccess');
    $routes->post('users/create-role',                       'Settings::createRole');
    $routes->post('users/update-role',                       'Settings::updateRole');
    $routes->delete('users/delete-role/(:num)',              'Settings::deleteRole/$1');
    $routes->post('users/create-user',                       'Settings::createUser');
    $routes->post('users/update-user',                       'Settings::updateUser');
    $routes->delete('users/delete-user/(:num)',              'Settings::deleteUser/$1');
    $routes->post('users/change-menu-permission',            'Settings::changeMenuPermission');
    $routes->post('users/change-menu-category-permission',   'Settings::changeMenuCategoryPermission');
    $routes->post('users/change-submenu-permission',         'Settings::changeSubMenuPermission');

    $routes->get('menu-management',                          'Settings::menuManagement');
    $routes->post('menu-management/create-menu-category',    'Settings::createMenuCategory');
    $routes->post('menu-management/create-menu',             'Settings::createMenu');
    $routes->post('menu-management/create-submenu',          'Settings::createSubMenu');
});

// ── API routes ────────────────────────────────────────────────────────────────
$routes->post('api/v1/auth/token', 'Api\AuthController::issueToken');

$routes->group('api/v1', ['filter' => 'api_auth'], function ($routes) {
    $routes->delete('auth/token',        'Api\AuthController::revokeToken');
    $routes->get('students',             'Api\StudentsController::index');
    $routes->post('students',            'Api\StudentsController::create');
    $routes->get('students/(:num)',      'Api\StudentsController::show/$1');
});
