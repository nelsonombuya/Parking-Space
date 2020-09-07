# Stuff to Do

1. Switch between Old and New index.php
2. Make html in index.php use document root
3. Create a way to mass-populate a table
    - Useful when adding a large number of users or parking spots

## Current Commit Message

Refactor : Change checkConnection function outputs
Feature : checkConnection function to hide warnings
Refactor : Create new database
Fix : Incorrect Path on Index.php
Fix : Broken runQuery function

> Made the checkConnection function give outputs of
> TRUE for a good connection
> server_error for error connecting to server
> db_error for error connecting to database
> This is to provide better reporting to the user
> runQuery used a direct connection to DB, error when DB doesn't exist
> checkConnection to hide warnings so that we may implement our own way of notifying the user
> Warnings can be shown by changing the argument to TRUE (For debugging)
> Implemented code to create new database for first time setup

`~ SQL.php`
`~ Index.php to work with new outputs`
`~ Index.php path missed a /`
