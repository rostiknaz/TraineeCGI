Logger
============================

it is an app what can writing log message in a database or in a file.


FILE STRUCTURE
-------------------

      App/LoggerInterface.php             contains interface for logger app
      App/Abstr/Logger.php                contains abstract class who implements the interface
      App/DB/DataBase.php                 contains class that makes writing log messages to the database
      App/File/FileSystem.php             contains class that makes writing log messages to the file system
      Config/config.ini                   contains configuration data for connection to the DB and log file path
      Logs/log.txt                        contains log messages
      index.php                           contains code for testing an app