## To do

1. GUI per relazionare sites and Notificable

## Problems

1. ```SiteController``` salvo le email ma polymorphic relation vuole site_id che non le viene fornito da ```sync()```, forse passare a ```ManyToMany```?

## Commands

* ```check``` Controlla i siti che dovrebbero essere controllati.
* ```check:all``` Controlla tutti i siti.
* ```check:reset``` Resetta il contatore dei siti che hanno fallito il controllo
