Elindítás:

Csak PHP 8.4 kell hozzá, elindítható command line-ból:

```
$ php -S localhost:8000
```

Adatbázis: SQLite, commitelve. Nyilván nem szép, hogy az adatbázis is itt van
verziózva, adatokkal együtt, de mivel ez egy demo alkalmazás, remélem elnézitek.

Működés:
Szándékosan kicsit overengineered lett. A kihívás semilyen external library-t
nem használni. Nyilván lehetne composer, PSR-4 autoloader, Twig - ezek kb. a
minimum, hogy valóban lehessen szép eredményt produkálni.

Az index.php kezel mindent. Nem használ templating engine-t, de hogy moduláris
legyen, vannak include-ok.

Az src könyvtárban van a forrás többi része.
A Databse, FlashMessages, Router és Session az általánosan használt "service"-ek.
A lényegi rész movel-view-controller bontásban található.

A felületen sokat lehetne még dolgozni, nem mondanám szépnek.
