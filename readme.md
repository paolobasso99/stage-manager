## Install

* git clone https://github.com/paolobasso99/stage-manager.git
* L'estensione ```php-ldap``` deve essere installata nel LAMP
* ```mysql -u user -p < dump.sql```
* ```composer install```
* Configurare mail in ```.env```
* Configure LDAP in ```.env```
* Login tramite LDAP
* Rimuovere user ```admin@admin.com```

## Commands

* ```check``` Controlla i siti che dovrebbero essere controllati.
* ```check:all``` Controlla tutti i siti.
* ```check:reset``` Resetta il contatore dei siti che hanno fallito il controllo
* ```check:emails``` Sincronizza emails con LDAP

## To do

* Fix mail login
* Fix site creation (duble)
* Fix npm
* SSH tramite chiave
* SSH pass in backend
* Ruoli composer, artisan, admin, normal

## Quando ho finito

* Implementa ShouldQueue per le emails
