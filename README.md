# PHP App Server (PHAS)

This project emerged from a painful situation...    
While I love PHP and code it daily, I come to notice that most of my app's realtime processing is spent on loading classes 
thus performing the same job over and over again.

PHAS is designed to be lightweight "application server" that seperates user's request from the actual PHP process that process the request and returns the response.
PHAS is not a server Per se but rather a seperator between the user's entrance (usually the famous index.php that we all have in our app) and the rest of the application.

## How does it work?

In a nutshell, a request that arrive to the "entrace" script is queued and processed later on by a separate "Loop Worker" that listens on the same queue.
The "Loop Worker" is basically the rest of your app, that is devided into two sections: 

1. Bootstrap script - anything from nothing to loading all your classes and functions.
2. Loop script - the actual business logic of your app.

Since the Loop Worker is executed on another process or even another machine, it does not share the same global variables as the entrance script. 
This is currently solved by passing all the global variable from the entrance script to the Loop Worker, thus simulating the same environment and state.

## Requirements

PHAS requires the following:

1. Gearman
2. PECL gearman extension >= 0.6.0 (please see note for ubuntu users...)


## Limitations 

1. Currently it does not support setting headers on the response. This is top priority for the next few days...
2. I'm sure there are more limitations :-O

## Installation

1. Download or clone the package
2. Edit the server/config/server.config.php according to your needs
3. Place the "entrance.php" script under a web-server exposed directory.
4. Run the server-loop.php script from commandline:   
		
		php -f /path/to/server/server-loop.php

## Note for Ubuntu Users:
I was having trouble installing the PECL library for gearman on Lucid (10.04). Here's how I eventuall did it:

	sudo aptitude install gearman libgearman-dev libgearman2 libevent uuid-dev
	sudo pecl install channel://pecl.php.net/gearman-0.6.0

At this stage I've been getting an error message like this:

	/bin/sed: can't read /usr/lib/libuuid.la: No such file or directory
	libtool: link: `/usr/lib/libuuid.la' is not a valid libtool archive
	make: *** [gearman.la] Error 1
	ERROR: `make' failed
	
Thanks to [a post by Max Gribov](http://mgribov.blogspot.com/2010/05/gearman-pecl-package-on-ubuntu-lucid.html) there is a solution:

	Open /usr/lib/libgearman.la as root, and find a line that says:
	dependency_libs=' -L/usr/lib /usr/lib/libuuid.la'
	
	Replace it with:
	dependency_libs=' -L/usr/lib -luuid'

## License and Credits
PHAS is realeased under the [MIT license](http://en.wikipedia.org/wiki/MIT_License).  
Thanks to [Tudor Barbu](http://blog.motane.lu/) we also support threads.


