<?php

return [
//--[MAIN]
  '' => [
    'controller' => 'main',
    'action' => 'index',
  ],

  'privacy' => [
    'controller' => 'main',
    'action' => 'privacy',
  ],

  'rules' => [
    'controller' => 'main',
    'action' => 'rules',
  ],
//--[/MAIN]
//--[ACCOUNT]
  'account' => [
    'controller' => 'account',
    'action' => 'index',
  ],

  'login' => [
    'controller' => 'account',
    'action' => 'login',
  ],

  'registration' => [
    'controller' => 'account',
    'action' => 'registration',
  ],

  'confirm' => [
    'controller' => 'account',
    'action' => 'confirm',
  ],

  'confirm/{token:.+}' => [
    'controller' => 'account',
    'action' => 'confirm',
  ],

  'logout' => [
    'controller' => 'account',
    'action' => 'logout',
  ],
//--[/ACCOUNT]
//--[ADMIN]
  'admin' => [
    'controller' => 'admin',
    'action' => 'index',
  ],

  'admin/email' => [
    'controller' => 'admin',
    'action' => 'email',
  ],

  'admin/settings' => [
    'controller' => 'admin',
    'action' => 'settings'
  ],

  'admin/acl' => [
    'controller' => 'admin',
    'action' => 'acl'
  ],

  'admin/controller' => [
    'controller' => 'admin',
    'action' => 'controller'
  ],
//--[/ADMIN]
//--[/API]
  'api' => [
    'controller' => 'api',
    'action' => 'index',
  ],

  'api/email' => [
    'controller' => 'api',
    'action' => 'email',
  ],

  'api/settings' => [
    'controller' => 'api',
    'action' => 'settings'
  ],

  'api/acl' => [
    'controller' => 'api',
    'action' => 'acl'
  ],

  'api/controller' => [
    'controller' => 'api',
    'action' => 'controller'
  ],
//--[/API]

];