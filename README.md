Test app for CGI
============================

This application is able to work with the database and create a user entity and other entities.
There is also a module that records error messages in the database or in the file

DIRECTORY STRUCTURE
-------------------

      App/              contains all entities of a model
      Config/           contains config files with data for connection to db and path to the log file
      DB/               contains class for connecting to db
      Logs/             contains file with log messages
      Vendor/           contains all modules of app and autoload file

