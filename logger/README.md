Logger
============================

it is an app what can writing log message in a database or in a file.


FILE STRUCTURE
-------------------

      LoggerInterface.php             contains interface for logger app
      Logger.php                      contains abstract class who implements the interface
      DataBase.php                    contains class that makes writing log messages to the database
      FileSystem.php                  contains class that makes writing log messages to the file system
      index.php                       contains code for testing an app
      config.ini                      contains configuration data for connection to the DB and log file path
      log.txt                         contains log messages
