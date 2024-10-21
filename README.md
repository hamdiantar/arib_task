# ARIB Task 

## Table of Contents

- [Features](#features)
- [Technologies](#technologies)
- [Installation](#installation)


## Features

- **Task Management**: 
  - Create, edit, and delete tasks.
  - Assign tasks to employees.
  - Track task statuses (Pending, In Progress, Completed).
- **Employee Management**: 
  - Create and manage employees.
  - Assign employees to departments.
  - Distinguish between managers and employees.
- **Department Management**: 
  - Create, update, and manage departments.
  - Associate employees with departments.
- **Dashboard**: 
  - View an overview of the number of managers, employees, tasks, and departments.
  - Monitor task statuses for better task tracking and employee performance evaluation.
- **Task Insights**: 
  - View the number of tasks assigned to each employee.
  - Track tasks by their status.

## Technologies

- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade Templating Engine, HTML, CSS, Bootstrap
- **Database**: MySQL

## Installation

To install and run the project locally, follow these steps:

### Prerequisites
- **PHP** >= 7.4
- **Composer** installed globally
- **MySQL** or any supported relational database

### Steps

# Clone the repository
git clone https://github.com/hamdiantar/arib_task.git

# Navigate to the project directory
cd arib_task

# Install dependencies
composer install

# Copy .env.example to .env and set up the environment
cp .env.example .env

# Generate the application key
php artisan key:generate

# Run migrations to create database tables
php artisan migrate

#Seed the database with initial data
php artisan db:seed

# Serve the application
php artisan serve

