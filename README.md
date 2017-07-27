# PHP Apache Virtualhost creator

![Logo](http://i.imgur.com/dzfZcU7.png?1)  
by Jose Luis Chafardet Grimaldi  
jose.chafardet@icloud.com
***
A simple php script to create apache virtualhosts based on symfony 3 console component.

```
Please note this is not meant for production environments! 
I wrote it for development purposes (to speed up the process of configuring apache).
```

## ToDo
- [x] Create working console code
- [ ] Add virtualhost template
- [ ] Export .conf file with the parameters given by the user
- [ ] Enable site (a2ensite) with apache (ubuntu)
- [ ] Restart apache
- [ ] Report to the user the outcome of the process

## Usage

The script receives 2 parameters, one is mandatory **domain**, and the second is optional _**folder**_

bin/.virtualhost create domain folder

***

* Send questions through the issues tracker.
* suggestions through pull requests (please describe the suggestion accurately and briefly.)


