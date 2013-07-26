DrupalLoginBundle
=================

Symfony bundle to login with your Drupal username and password. Requires the Service 3.x module within Drupal

This bundle works together with the form_login secuirty configuration of Symfony

Configuration
-------------

After you have installed the bundle update your AppKernel with

    $bundles = array(
	    ...
		new CiviCoop\DrupalLoginBundle\CiviCoopDrupalLoginBundle(),
	)

Set the drupal url in app/config/config.yml

	civicoop:
	     drupal:
		    login:
			     url: http://mydrupalsite.org/rest/user/login

Secure your site by adding the drupal key to app/config/security.yml
    security:
	    ...
        providers:
            ...		
            drupal:
                id: drupal.security.authentication.userprovider	
        firewalls:
            secured_area:
                pattern: ^/secured
                form_login:
                    check_path: acme_demo_login_check
                    login_path: acme_demo_login
                    always_use_default_target_path: true
                    default_target_path: /
                logout:
                    path:   acme_demo_logout
                    target: /
                drupal: ~

Requirements on Drupal
----------------------

This module requires the Drupal Services 3.x module installed and enabled. Also the user login path and JSON/rest should be configured on that module.