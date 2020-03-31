# PHP Apache Virtualhost creator

![Logo](http://i.imgur.com/dzfZcU7.png?1)  
by Jose Luis Chafardet Grimaldi  
jose.chafardet@icloud.com
***
A simple [PHP](http://php.net/) script to create [Apache](http://httpd.apache.org/) [virtualhost](http://httpd.apache.org/docs/2.4/mod/core.html#virtualhost)s based on [Symfony 4](http://symfony.com/) [Console Component](http://symfony.com/doc/current/components/console.html).

```
Please be aware that this script is not meant for production environments! 
I wrote it for development purposes.
(to speed up the process of configuring Apache).
```
(http://i.imgur.com/xhCNKUW.png)

## ToDo
- [x] ~~Create working console code~~
- [x] ~~Changed display output for the results.~~

- [ ] Add support for [CentOS](https://www.centos.org/) and [Ubuntu](https://www.ubuntu.com/) based distributions
- [x] ~~Add configuration file (for distro specific information)~~
- [ ] Add counter to prioritize [virtualhost](http://httpd.apache.org/docs/2.4/mod/core.html#virtualhost) loading (in which order the [virtualhost](http://httpd.apache.org/docs/2.4/mod/core.html#virtualhost)s will be loaded by [Apache](http://httpd.apache.org/) / [nginx](https://nginx.org/en/))
- [x] ~~Add [virtualhost](http://httpd.apache.org/docs/2.4/mod/core.html#virtualhost) template~~
- [x] ~~Parse [virtualhost](http://httpd.apache.org/docs/2.4/mod/core.html#virtualhost) template and replace the variables with the input~~
- [ ] Save [Apache](http://httpd.apache.org/) / [nginx](https://nginx.org/en/) **.conf** file with the parameters given by the user to the proper directory
- [ ] Enable site with [a2ensite](http://manpages.ubuntu.com/manpages/trusty/man8/a2ensite.8.html) with [Apache](http://httpd.apache.org/) if needed([Ubuntu](https://www.ubuntu.com/))
- [x] Add support for [nginx](https://nginx.org/en/) - _request by a good friend_
- [ ] Restart [Apache](http://httpd.apache.org/)/ [nginx](https://nginx.org/en/)
- [x] ~~Print to the screen the outcome of the process~~
- [ ] Add variable in the configuration file to switch between Argument and Question based execution of the script.
- [ ] Compile a .phar file and add it to **bin/release** folder
- [x] ~~Add support for framework parameter (symfony, laravel only for now)~~
- [ ] Add ability to determine "current server" IP address as to remove it from manually configuring it in the config file
- [ ] Finish the [CONTRIBUTING.md](CONTRIBUTING.md) file
- [ ] Finish the [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) file

```
Please note that the configuration loading prioritization will be
automatic, there will be no "manual" prioritization.
  
At least is not in the plans for any of the inmediate future versions.
```

## Usage

From the console type:
```
bin/virtualhost create hostname directory(optional)
```
The script receives 2 parameters, one is mandatory **hostname**, and the second is optional _**folder**_

bin/[virtualhost](http://httpd.apache.org/docs/2.4/mod/core.html#virtualhost) create hostname folder
sample output (Includes a view of the parsed [Apache](http://httpd.apache.org/) / [nginx](https://nginx.org/en/) configuration file):  
![With two parameters](http://i.imgur.com/xhCNKUW.png)

If no second parameter is given, it will use the hostname for the folder name.
sample output:  
![Without second parameter](http://i.imgur.com/joJhBua.png)

***

* Send questions through the issues tracker.
* suggestions through pull requests (please describe the suggestion accurately and briefly.)


