DrupalLoginBundle
=================

Symfony bundle to login with your Drupal username and password. Requires the Service 3.x module within Drupal

Configuration
-------------

After you have installed the bundle update your AppKernel with

    $bundles = array(
	    ...
		new CiviCoop\DrupalLoginBundle\CiviCoopDrupalLoginBundle(),
	)

Don't forget to configure the bundle with the following settings

	civicoop:
	     drupal:
		    login:
			     url: http://mydrupalsite.org/rest/user/login


Requirements on Drupal
----------------------

This module requires the Drupal Services 3.x module installed and enabled. Also the user login path and JSON/rest should be configured on that module.