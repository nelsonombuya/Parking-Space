# Common Functions

Here's a list of common functions and what they do:

## connectToServer() & connectToDatabase()

> From Resources/Scripts/SQL.php

Basically returns the lines

> Original Code can be used where a more customized version is needed

**Connect to Server**
`mysqli_connect(localhost, username, password)`

**Connect to Database**
`mysqli_connect(localhost, username, password, database)`

Rather than writing them over and over, especially since I'm getting the server details from a parsed .ini file, decided to create a function for it which uses the settings from the .ini each time.
Makes the code more readable while still maintaining functionality.

> For Example:
> **Before**
> `$conn = mysqli_connect(localhost, username, password, database)`
> `$fetched = mysqli_query($conn, $query)`

> **After**
> `$fetched = mysqli_query(connectToDatabase(), $query)`

## runQuery(\$query)

This runs a query given in the function parameter

> It's basically a shortened version of:
> `$conn = mysqli_connect(localhost, username, password, database)`
> `$fetched = mysqli_query($conn, $query)`

For example, to run an SQL query, you can just type in:

> `runQuery("SELECT * FROM Table_Name")`
