<p>
<img  src="https://github.com/EricCodeBJ/Ferror/blob/3cb7e9ea734efa6a39630290e0773a82dbe4bc40/Ferror/Resources/assets/img/icons/logoFerror-circle.png?raw=true"  width="200px" />
</p>

# Ferror - Un léger formateur d'erreur et d'exception Php

[![en](https://img.shields.io/badge/lang-en-red.svg)](https://github.com/EricCodeBJ/Ferror/blob/master/readme.md)
[![fr-ca](https://img.shields.io/badge/lang-fr-ca.svg)](https://github.com/EricCodeBJ/Ferror/blob/master/readme.fr-ca.md)

# Fonctionnalités

- ✅ Intercepte toutes les erreurs et exceptions de votre code

- ✅ Récupère et affiche le code, la ligne, le ficher et le message d'erreur ou de l'exception

- ✅ la possibilité de copier rapidement le message d'erreur ou d'exception pour d'éventuelles recherches

- ✅ Affiche aussi un aperçu du fichier à la ligne d'erreur détectée

- ✅ Affiche toutes les variables globales présentes dans votre code

- ✅ Affiche également tutes les variables et constantes que vous aviez déclaré dans votre code

- ✅ Un Espace de nom personnalisé pour éviter la collision des classes

# Pourquoi utiliser ceci

Tous les développeurs ont une fois déjà été confronté à des erreurs dans leur code et il est souvent un peu difficile de savoir ce qui ne marche pas à cause des messages d'erreur de Php qui sont non formaté (le tout concaténé en un bloc).

Avec Ferror, tout est bien détaillé et séparé, ainsi, vous pouvez facilement détecter le message d'erreur, la ligne erronée, le ficher à la base et bien plus encore. Tout ceci dans le but de facilement débugger son code et gagner en temps.

Parce que les erreurs sont importantes, parce qu'elles se doivent d'être bien présentée.

# Installation & Utillisation

Ferror est disponible sur <a  href='https://packagist.org/'  target='_blank'>Packagist</a> et est installable via <a  href='https://getcomposer.org'  target='_blank'>Composer</a> avec la commmande suivante

```
composer require rayola/ferror
```

# Example d'usage

```php
<?php
use Ferror\Core\Ferror;

require_once "../vendor/autoload.php";

Ferror::register(Ferror::DEBUG_MODE_ON);


/* ex: Failed to open stream: No such file or directory */
require_once "efsd.php";
```

**🚫 Sans Ferror**

<img  src="https://github.com/EricCodeBJ/Ferror/blob/515737b29216df7c3a5dc939ac46cb36a1e2ff48/Ferror/Resources/assets/img/capture/capture-php1.png?raw=true"  style="width: 100%" />

**✔️ Avec Ferror**

<img  src="https://github.com/EricCodeBJ/Ferror/blob/3cb7e9ea734efa6a39630290e0773a82dbe4bc40/Ferror/Resources/assets/img/capture/capture-ferror.png?raw=true"  style="width: 100%" />

# Remerciement

- <a  href='https://fonts.google.com/specimen/Inter'  target='_blank'> Google Inter font</a>

- <a  href='https://github.com/EnlighterJS/EnlighterJS'  target='_blank'> EnlighterJS</a>, un surligneur de syntaxe open source écrit en javascript pur

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
