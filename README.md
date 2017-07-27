# Apache Virtual Host creator

![JL Logo](https://www.facebook.com/photo.php?fbid=10152770021818795&l=97b252d16e)
##### by Jose Luis Chafardet Grimaldi

A simple php script to create apache virtual hosts based in symfony 3 console component.

## ToDo
- [x] Create working console code
- [ ] Add virtualhost template
- [ ] Export .conf file with the parameters given by the user
- [ ] Enable site (a2ensite) with apache (ubuntu)
- [ ] Restart apache
- [ ] Report to the user the outcome of the process

## Usage

The script receives 2 parameters, one is mandatory, **domain** and the second is optional _folder_

bin/.virtualhost create domain folder


