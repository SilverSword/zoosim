# Zoo simulation demo

Description
===
A laravel based PHP web application simulating a zoo of 15 animals: 5 animals of each of the following types: monkey, giraffe, and elephant.

Advancing in time increments the simulator time by one hour. It also decreases the health of each animal by a random value between 0 and 20%. Feeding the animals increments their health by a random value between 10 and 25%.


Requirements
===
In order to run the app, make sure your server meets the following requirements:

* PHP >= 5.6.4
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension


Usage
===
To run the application, make sure you are located in the root of the application directory:

~~~
$ cd /path/to/zoosim/
~~~

Run the following commands to initialize and run the web app:

~~~
$ php artisan migrate:refresh --seed
$ php artisan serve
~~~

Now navigate to (http://localhost:8000) to view the web app.

* Click on the **Advance Time** button to increment the simulation time by one hour
* Click on the **Feed Animals** button to feed the animals
* Click on the **Reset Simulation** link on the top right corner to reset the simulator



---
Copyright (C) 2016 - Fadi Asfour. All rights reserved
fadi@asfourconsulting
