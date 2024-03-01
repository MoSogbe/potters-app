# Potters App

Welcome to the Potters App project! This documentation provides information on how to set up, run, and contribute to the project. Please read this document thoroughly to get started.

## Table of Contents
- [Project Overview](#project-overview)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Database File](#database-file)
- [User Credentials](#user-credentials)
- [Excel Uploads](#excel-uploads)


## Project Overview
Potters App is a Laravel-based application for managing ceramic products at depots nationwide. The project includes features such as data synchronization, product management, and more.

## Getting Started

### Prerequisites
Make sure you have the following installed on your local machine:

- PHP (version 8.1 or later)
- Composer
- MySQL
- Laravel CLI

### Installation
1. Clone the repository:
   git clone https://github.com/your-username/potters-app.git

## Database File
The database file (`potters_app.sql`) is included in the project's root directory. Follow these steps to import the database:

1. Open your MySQL database management tool (e.g., phpMyAdmin, MySQL Workbench).
2. Create a new database for the project (e.g., `potters_app`).
3. Import the database file (`potters_app.sql`) from data folders in apps directory into the newly created database.

## User Credentials
After importing the database, you can use the following credentials to log in as a sample user:

- **Username:** `mohammed.sogbe@gmail.com`
- **Password:** `123456`

Please note that these are just sample credentials, and you should update them according to your actual user data.

Feel free to explore the application using these credentials and customize them as needed.

## Excel Uploads
Sample excel file for upload has been added to data directory in app root for use.
Fields used in uploads includes name,description,price,quantity

