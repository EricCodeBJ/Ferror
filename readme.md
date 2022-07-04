<p>
<img  src="https://github.com/EricCodeBJ/Ferror/blob/3cb7e9ea734efa6a39630290e0773a82dbe4bc40/Ferror/Resources/assets/img/icons/logoFerror-circle.png?raw=true"  width="200px" />
</p>

# Ferror - A lightweight pretty Php error and exception viewer

[![en](https://img.shields.io/badge/lang-en-red.svg)](https://github.com/EricCodeBJ/Ferror/blob/master/readme.md)
[![fr-ca](https://img.shields.io/badge/lang-fr-ca.svg)](https://github.com/EricCodeBJ/Ferror/blob/master/readme.fr-ca.md)

# Features

- ✅ Catch all errors and exceptions in your code

- ✅ Retrieves and displays code, line, file and error or exception message

- ✅ Ability to quickly copy the error or exception message for possible research

- ✅ Also displays a preview of the file at the detected error line

- ✅ Displays all global variables present in your code

- ✅ Also displays all the variables and constants that you had declared in your code

- ✅ Custom namespace to avoid class collision

# Why use this

Every developer has run into errors in their code once and it's often a bit difficult to figure out what's wrong because of Php's error messages that are unformatted (all concatenated into one block) .

With Ferror, everything is well detailed and separated, so you can easily detect the error message, the erroneous line, the file at the base and much more. All this in order to easily debug your code and save time.

Because errors are important, because they must be well presented.

# Installation & Use

Ferror is available at <a href='https://packagist.org/' target='_blank'>Packagist</a> and can be installed via <a href='https://getcomposer.org' target='_blank '>Compose</a> with the following command

```
composer install mido/ferror
```

# Usage example

```php
<?php
use Ferror\Core\Ferror;

require_once "../vendor/autoload.php";

Ferror::register(Ferror::DEBUG_MODE_ON);


/* ex: Failed to open stream: No such file or directory */
require_once "efsd.php";
```

**Without Ferror**

<img src="https://github.com/EricCodeBJ/Ferror/blob/3cb7e9ea734efa6a39630290e0773a82dbe4bc40/Ferror/Resources/assets/img/capture/capture-php1.png?raw=true" style="width: 100%" />

**With Ferror**

<img src="https://github.com/EricCodeBJ/Ferror/blob/3cb7e9ea734efa6a39630290e0773a82dbe4bc40/Ferror/Resources/assets/img/capture/capture-ferror.png?raw=true" style="width: 100%" />

# Thanks

- <a href='https://fonts.google.com/specimen/Inter' target='_blank'> Google Inter font</a>

- <a href='https://github.com/EnlighterJS/EnlighterJS' target='_blank'>EnlighterJS</a>, an open source syntax highlighter written in pure javascript

# License

MIT License

Copyright (c) [2022] [DEKOUN Cédric]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

# Contribution

Vous êtes libre d'apporter votre contribution a l'amélioraton de ce projet.
