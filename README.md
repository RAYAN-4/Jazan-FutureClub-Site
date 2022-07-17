[![forthebadge](https://svgur.com/i/j9u.svg)](https://forthebadge.com)
[![forthebadge](https://svgur.com/i/jAn.svg)](https://forthebadge.com) 
[![forthebadge](https://svgur.com/i/jBT.svg)



# Jazan Future Skills Club Site

is a web application to manage the posts , events , competions and many other things that
Future Skills Club manage to do over the years

with the ability to our site and joining or creating team with your friends
you can start participating on our club competions


![N|Solid](https://i.ibb.co/DKjHM3Y/2022-07-17-165129.png)


### Viewing Upcoming Competions

![N|Solid](https://i.ibb.co/C2LYpBs/2022-07-16-180222.png)


## Prerequisites

You need to have [PHP](https://www.php.net/) and [PhpMyAdmin](https://www.phpmyadmin.net/) installed on your computer to run this application locally.

You can simply achive that by installing [Xampp](https://www.apachefriends.org/)


## Getting Started

### Clone This Repository

```
git clone https://github.com/NotSyrRegDev/Jazan-FutureClub-Site.git
```


### Edit Your Database Connection Settings

open up connect.php inside admin folder and chage the follwing variables that fit your settings

```

$host = 'your_host';
$user = 'your_phpmyadmin_username';
$pass = 'your_phpmyadmin_password';

```

### Open up index.php

```
# Visit
 http://localhost/your_project_path/index.php
```

That's will automatically create the database and tables in mysql


### Create Your First Admin Account

```

# Visit
 http://localhost/your_project_path/signup.php
```

After doing so go to your phpMyAdmin and navigate to the fuclub database then joinedusers table
and change the user_group_id column to 1 to make your self an admin user


### Visit Admin Page And Start Creating Content

```sh

#Visit
 http://localhost/your_project_path/admin/index.php
```
Here you will an admin dashboard and from there you can start making posts , events , competions and manage them


### Add Questions And Review User Submitted Answers

```sh

#Visit
 http://localhost/your_project_path/admin/questions.php
```

Here you can add any question to any competition you have published 
and from answers page you can manage the submitted answers


## How It Builds 

- PHP FOR BACKEND
- HTML - CSS - JS FOR FRONTEND


## You Can Do

- Bootstrap templating section (no css pure bootstrap)

* [x] - On Website
    - [x] - Sign up - Login
    - [x] - Create Team - Join Team
    - [x] - Search (Posts , Events , Competions)
    - [x] - Explore Scoreboard
* [x] - On Admin
    - [x] - Create (Posts , Users , Events , Competions )
    - [x] - Update (Posts , Users , Events , Competions )
    - [x] - Delete (Posts , Users , Events , Competions )
    - [x] - Manage Teams
    - [x] - Manage Competions Answers





> Check This Live [Demo](https://deviltion-library.web.app/) 
