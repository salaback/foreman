# Alablaster/Foreman

[![PHP Composer](https://github.com/salaback/foreman/actions/workflows/php.yml/badge.svg)](https://github.com/salaback/foreman/actions/workflows/php.yml)

A generator utility for creating Laravel Projects

## Install

To install the package in a Laravel Project run the following command.

``$ composer install alablaster/foreman``

## Configuration

To publish the configuration file run:

``$ php artisan vendor:publish --provider=="Alablaster\Foreman\ForemanServiceProvider"``

In the config files you can define the base namespace. In an Laravel project
this is App by default, though if you are creating a package is might be your package name, like "Alablaster\Foreman". 
Namespaces should be defined in studly case with for slashes.

## Use

The following commands and arguments are supported by Foreman. To generate a full entity run the following command:

``$ php artisan foreman:entity Model --N=Path\To\Namespace --D=Domain``

| command  |arguments |options |Notes |
|---|---|---|---|
| foreman:controller | model | <u>N</u>amespace, <u>D</u>omain | |
| foreman:entity | model | <u>N</u>amespace, <u>D</u>omain| Generates a model, migration, controller, factory, resource and request classes, and adds a route to the route file. |
| foreman:factory | model | <u>N</u>amespace | |
| foreman:migration | model | | |
| foreman:resource | model | <u>N</u>amespace, <u>D</u>omain | Generates a Resource, a CollectionResource and a Collection Class.|
| foreman:requests | model | <u>N</u>amespace, <u>D</u>omain | Generates both a Create and Update request class.|
| foreman:route | model | <u>N</u>amespace, <u>D</u>omain| Can be run multiple times to add more routes to the routes file. |

## Customization

After publishing the vendor files will generate a `stubs` directory in the 
base of the project.  These templates can be modified to and used to
generate files using the Foreman commands.

In the template, passed variables can be accessed using a mustache like
sintax, for example `{{ model }}`.  Variables can be modified using a variety 
of filters through a dot notation, for example {{ model.lowercase.plural }}.
This includes all of Laravel's Str class helpers.  Additionally, it includes
`leadingBackSlash`, `trailingForwardSlash`, `trailingDot`, 
