# Wevioo Test - Symfony Backend

This repository contains the backend implementation for the Wevioo technical test, built with Symfony. Follow the steps below to set up the project locally and test the available web services.

---

## Prerequisites

Before setting up the project, ensure the following tools and services are installed on your machine:

- **PHP** (version 7.4 or higher)
- **Composer**
- **MySQL** (e.g., via XAMPP)
- **Symfony CLI** (optional but recommended)

---

## Setup Instructions

### Step 1: Clone the Repository

Start by cloning this repository to your local machine:

```bash
git clone https://github.com/RaedKharrat/BackWevioo.git
cd BackWevioo
```


Step 2: Set Up the Database
Open phpMyAdmin in your browser.
Create a new database with the name: weviootest.
Step 3: Install Dependencies
Run the following command in the project directory to install required dependencies:

```bash
composer install
```

Step 4: Set Up the Database Schema
Run the following commands to create and apply the database schema:

```bash


php bin/console make:migration
php bin/console doctrine:migrations:migrate

```

Step 5: Start the Server
Start the server with the following command:

```bash

php -S 127.0.0.1:8000 -t public
```

The application will now be accessible at http://127.0.0.1:8000 / http://localhost:8000 

Testing Web Services
You can test the API endpoints using tools like Postman. Below are examples of the available endpoints:

1. Create a New Project
Endpoint:
POST: http://localhost:8000/project/new

Request Body (JSON):

{
    "Categorie": "Android",
    "status": "canceled",
    "title": "App Design and Develop",
    "description": "To achieve this, it would be necessary to have uniform grammar and more common words.",
    "tasks": 5,
    "comments": 14,
    "progress": 95
}

{
    "Categorie": "IOS",
    "status": "frontend-completed",
    "title": "App Design and Develop",
    "description": "To achieve this, it would be necessary to have uniform grammar and more common words.",
    "tasks": 5,
    "comments": 1,
    "progress": 15
}

{
    "Categorie": "Symfony",
    "status": "backend-completed",
    "title": "App Design and Develop",
    "description": "To achieve this, it would be necessary to have uniform grammar and more common words.",
    "tasks": 5,
    "comments": 1,
    "progress": 53
}

{
    "Categorie": "Reactjs",
    "status": "completed",
    "title": "App Design and Develop",
    "description": "To achieve this, it would be necessary to have uniform grammar and more common words.",
    "tasks": 5,
    "comments": 1,
    "progress": 77
}

2. Get All Projects
Endpoint:
GET: http://127.0.0.1:8000/project

















