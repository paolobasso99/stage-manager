## Install

* git clone https://github.com/paolobasso99/stage-manager.git
* L'estensione ```php-ldap``` deve essere installata nel LAMP
* mysql -u user -p < dump.sql
* Configurare mail in ```.env```
* Configure LDAP in ```.env```
* composer Install
* Login -> User = admin@admin.com / password = password

## Commands

* ```check``` Controlla i siti che dovrebbero essere controllati.
* ```check:all``` Controlla tutti i siti.
* ```check:reset``` Resetta il contatore dei siti che hanno fallito il controllo

## To do

1. Più velocità -> Queue per emails ?
