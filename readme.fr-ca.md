<p>
  <img src="https://raw.githubusercontent.com/EricCodeBJ/Ferror/blob/master/Ferror/Ressources/assets/img/icons/logoFerror-circle.png" width="200px" />
</p>

# Ferror

---

Un léger formateur d'erreur et d'exception Php, qui affichent ces dernières dans un format très détaillé et attrayant afin de rendre le débugage facile aux développeurs.

# Pourquoi Ferror ?

---

En cas d'erreur ou exception dans votre code, Ferror vous renseigne:

- ✅ Le code, la ligne, le ficher et le message d'erreur
- ✅ Un apercu du fichier avec la ligne d'erreur souligné
- ✅ Toutes les variables globales
- ✅ Toutes les variables et contantes déclarées

# Installation

---

```
 composer install mido/ferror
```

# Comment utiliser

---

```
    use Ferror\Core\Ferror;

    require_once "../vendor/autoload.php";

    Ferror::register(Ferror::DEBUG_MODE_ON);


    /* Failed to open stream: No such file or directory */
    require_once "efsd.php";

```

- sans Ferror
  <img src="https://raw.githubusercontent.com/EricCodeBJ/Ferror/blob/master/Ferror/Ressources/assets/img/capture/capture-ferror.png" style="width: 100%" />

- avec Ferror
  <img src="https://raw.githubusercontent.com/EricCodeBJ/Ferror/blob/master/Ferror/Ressources/assets/img/capture/capture-php.png" style="width: 100%" />

# Remerciement

---

- <a href='https://fonts.google.com/specimen/Inter' target='_blank'> Google Inter font</a>

- <a href='https://github.com/EnlighterJS/EnlighterJS' target='_blank'> EnlighterJS</a>, un surligneur de syntaxe open source écrit en javascript pur

# License

---

# Contribution

---
