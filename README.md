# Concrete5 FireShell Boilerplate

A boilerplate for building web sites in Concrete5 CMS. Based on [FireShell](http://http://getfireshell.com/) with some elements of [Bootstrap](http://getbootstrap.com/).


## Technologies/Requirements

- Concrete5 v.5.6+ (PHP5/MySQL CMS)
  - PHP 5.4+, MySQL
- Grunt.js
 	- Gruntfile modified from [FireShell](http://http://getfireshell.com/) (used for JS and SCSS compiling/minification). See [FireShell documentation](//github.com/toddmotto/fireshell/blob/master/docs/DOCS.md)
  - Node/NPM
  - Bower
  - Sass/SCSS

## Libraries/Vendor Includes

- Based partly on [FireShell](http://http://getfireshell.com/) which includes some elements of [HTML5 Boilerplate](http://html5boilerplate.com/)
- [Modernizr](http://modernizr.com/) 2.6+
- [Normalize.css](http://necolas.github.com/normalize.css/)
- [Bootstrap Grid System](http://getbootstrap.com/css/#grid)
- jQuery 1.10+


## Quick-start

### Simple, static page development:
- Clone this repo
- run ``nmp install`` - it may take a while to load all assets
- run ``grunt`` to start basic web server

### Full MAMP/LAMP development (until we finish Vagrant setup)
- Make sure you have Apache/PHP/MySQL server running on your machine
- Follow above quick-start steps
- Create new MySQL database for Concrete5 CMS
- Set up server to serve from ``public_html`` directory (try [osx-vhost-manager](https://github.com/jamiemill/osx-vhost-manager/blob/master/vhostman.rb) for quick local virtual host setup)
- Visit your new virtual host to install Concrete5
  - (you may need to create ``/files``, ``/packages``, and change permissions of C5-written directories)
  - You should now see the Concrete5 install screen!


## Documentation

Read the FireShell developer [documentation](//github.com/toddmotto/fireshell/blob/master/docs/DOCS.md) for set up and further learning. You may need to install a few assets before you can get started, such as Node, Git, and Grunt.


## Scaffolding

````
root  
├── public_html  
│   ├── blocks  
│   ├── config  
│   ├── helpers  
│   ├── packages  
│   ├── themes  
│   │   ├──c5boilerplate  
├── src  
│   ├── js  
│   ├── scss  
````


## To Do:
(See Github Issues)  

- Grunt-copy .min files from Bower components?
- [Consider](https://chrsm.org/2013/04/25/using-grunt-for-php/) grunt-php - or even better:
- Put it in a Vagrant box!


## License

#### The MIT License (MIT) 

Theme boilerplate copyright (c) 2013-2014 Artesian Design Inc.
Other parts copyrighted by their respective authors.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
