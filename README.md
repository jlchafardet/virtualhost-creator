# Apache Virtualgost creator

![Logo](http://i.imgur.com/dzfZcU7.png?1)

by Jose Luis Chafardet Grimaldi
***
A simple php script to create apache virtualhosts based in symfony 3 console component.

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


