<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'laravel-collection');

// Project repository
set('repository', 'git@github.com:wiwa1978/laravel_beercollection.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('178.62.192.52')
	->port(2200)
	->user('wymedia')
	->identityFile('/Users/wim/Dropbox/keypair_digitalocean_146185179184')
	->set('deploy_path', '/var/www/html/collection.wimwauters.com');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

