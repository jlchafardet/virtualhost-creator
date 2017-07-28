# PHP Apache Virtualhost creator

![Logo](http://i.imgur.com/dzfZcU7.png?1)  
by Jose Luis Chafardet Grimaldi  
jose.chafardet@icloud.com
***
A simple php script to create apache virtualhosts based on symfony 3 console component.

```
Please be aware that this script is not meant for production environments! 
I wrote it for development purposes (to speed up the process of configuring apache).
```
First version state:
![First version of the app](http://i.imgur.com/kl64TxB.png)

## ToDo
- [x] Create working console code
- [x] Changed display output for the results.
- [ ] Add support for [CentOS](https://www.centos.org/) and [Ubuntu](https://www.ubuntu.com/) based distributions
- [x] Add configuration file (for distro specific information)
- [ ] Add configuration loading prioritization counter logic (in which order the virtualhosts will be loaded by apache)
- [x] Add virtualhost template
- [x] Parse virtualhost template and replace the variables with the input
- [ ] Save apache **.conf** file with the parameters given by the user to the proper directory
- [ ] Enable site (a2ensite) with apache if needed(ubuntu)
- [ ] Restart apache
- [x] Print to the screen the outcome of the process
- [ ] Finish the [CONTRIBUTING.md](CONTRIBUTING.md) file
- [ ] Finish the [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) file

```
Please note that the configuration loading prioritization will be
automatic, there will be no "manual" prioritization.
  
At least is not in the plans for any of the inmediate future versions.
```

## Usage

The script receives 2 parameters, one is mandatory **domain**, and the second is optional _**folder**_

bin/virtualhost create domain folder
sample output (Includes a view of the parsed apache configuration file):  
![With two parameters](http://i.imgur.com/xhCNKUW.png)

If no second parameter is given, it will use the domain for the folder name.
sample output:  
![Without second parameter](http://i.imgur.com/joJhBua.png)

***

* Send questions through the issues tracker.
* suggestions through pull requests (please describe the suggestion accurately and briefly.)


