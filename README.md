![Logo](https://i.imgur.com/KQYc9OY.png)

SQL Data Editor (SDE) is a web-based application designed to simplify the management and manipulation of SQL databases. It offers a user-friendly interface for performing a variety of database operations including creating databases, defining tables and columns, inserting, updating, and deleting data, and executing custom SQL queries.

## Key features of SDE:

#### Database Management: 
Users can create, delete, and manage multiple databases from a single interface. They can also select the active database for performing operations.

#### Table and Column Definition: 
SDE allows users to define tables within databases and specify columns with their respective data types, lengths, constraints, and indexes.

#### Data Manipulation: 
Users can easily insert, update, and delete data records within tables. The application provides forms or grids for entering and editing data, making the process intuitive and efficient.

#### Query Execution: 
SDE enables users to execute custom SQL queries directly within the application. Results are displayed in tabular format for easy interpretation.

#### User Management: 
Depending on their roles and permissions, users can have different levels of access to databases and functionalities within the application. Administrators can manage user accounts and permissions.

#### Error Handling and Logging: 
SDE includes robust error handling mechanisms to catch and report errors encountered during database operations. It also logs user activities and system events for auditing and troubleshooting purposes.

#### Security: 
The application implements industry-standard security measures to protect sensitive data and prevent unauthorized access. This includes encryption of data transmission, secure user authentication, and access control mechanisms.

#### Customization and Extensibility: 
SDE is designed to be modular and customizable, allowing developers to extend its functionality through plugins and custom scripts. This enables integration with other systems and customization to meet specific business requirements.
#
SQL Data Editor aims to streamline database management tasks and provide a powerful yet user-friendly environment for developers, database administrators, and other users to interact with their databases efficiently and securely.

All these things also don't have to be made using the UI, you can also use custom functions to manage your databases.

## Installation

Start using SDE in PHP:

```php
  include (https://raw.githubusercontent.com/RadimKuncicky07/sql-data-editor/main/main.php)
```
    
## Documentation

### 1. Connection
#### Create connection:
```php
$conn = new mysqli("127.0.0.1", "root", "");
$connection = new Connection($conn);
```
or
```php
$connection = new Connection("127.0.0.1", "root", "");
```
#### Close connection:
```php
$connection->close();
```
### 2. Database
#### Create database:
```php
$database = $connection->createDatabase("dbname","utf8_general_ci"); // createDatabase($db_name, $collation)
```
#### Connect database:
```php
$database = $connection->connectDatabase("dbname"); // connectDatabase($db_name)
```
#### Edit database:
```php
$database->edit("dbname2","utf8_czech_ci"); // edit($db_name, $collation)
```
#### Delete database:
```php
$database->delete();
```
### 3. Document
#### Create document:
```php
$document = $database->createDocument("docname",4); // createDocument($doc_name, $num_of_rows)
```
#### Connect document:
```php
$document = $database->connectDocument("docname"); // connectDocument($doc_name)
```
#### Edit document:
```php
$document->edit("docname2",3); // edit($doc_name, $num_of_rows)
```
#### Delete document:
```php
$document->delete();
```
### 4. Column
#### Create column:
```php
$column = $document->createColumn("id","INT",10,"primary","a_i"); // createColumn($col_name, $type, $length, ...$data)
```
#### Find column:
```php
$column = $document->findColumn("id"); // findColumn($unique_column)
```
#### Edit column:
```php
$column->edit("uuid","VARCHAR",16,"no a_i"); // edit($col_name, $type, $length, ...$data)
```
#### Delete column:
```php
$column->delete();
```
### 5. Data
#### Add data:
```php
$data = $document->addData(5); // addData(...$data)
```
#### Find data:
```php
$data = $document->findData(10); // findData($unique_value)
```
#### Edit data:
```php
$data->edit($unique_value,...$data); // edit($unique_value,...$data)
```
#### Delete data:
```php
$data->delete();
```

#TODO: Add UI interface
## Contributors

- [@radim-codes](https://github.com/radim-codes) (Author)
