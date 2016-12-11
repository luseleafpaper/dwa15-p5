# DWA 15 Final Project - Lesson Scheduler 

Welcome! For my final project, I've decided to take some of the stress out of scheduling lessons. Both my boyfriend and I are instructors in our freetime (me in math and him in dance). We frequently exchange emails with our students regarding scheduling. In particular, students want to know when the instructor is available for a lesson and confirm existing lesson times. Instructors would love to just share our google calendars with our students so that they can check for themselves, but that would cause privacy issues. 

Therefore, my goal is to create a scheduler that will allow instructors to 
* schedule lessons with **their** students (Yes, a lesson can have more than one student!) 
* schedule lessons with other instructors (the default lesson is taught by the teacher who is logged in, but sometimes one teacher is not enough!) 
* review, edit and delete lessons 
* create lessons without any students which become **available** lesson times for all **their** students to see 

Students will be able to: 
* see the details for lessons that they are in
* see when **their** instructors are busy with other students without seeing any lesson details so that 1. they don't request alternative lesson times when the instructor is busy and 2. other student's privacy is protected. 

For the scope of this project, all major CRUD operations will be done on Lessons by Teachers and Students. In the future, I would like to add an admin role that can perform CRUD operations on the Teachers and Students themselves. 

A user can be both a teacher and a student. The default user Jil is a teacher to Jamal. Jill is also a student to Lu. At the moment, an admin role is necessary to link students with teachers. 

## Demo 
Screencast [video](). 

## Live Laravel application
Live site is here: [p4.luseleafpaper.com](http://p4.luseleafpaper.com/)

### Controllers 
I have two controllers: 
* UsergenController - inspects the request object and appends the appropriate number of random users to the view, as well as passing parameters to turn on birthday and profile display.  
* IpsumController - inspects the request object and appends the appropriate number of lorem ipsum paragraphs to the view

Both Controllers implement form validation  
https://github.com/luseleafpaper/ipsum/blob/master/app/Http/Controllers/IpsumController.php#L20  
https://github.com/luseleafpaper/ipsum/blob/master/app/Http/Controllers/UsergenController.php#L23  

## Routing basics.
There are three routes in this application: 
* home / 
* Lorem Ipsum generator /ipsum 
* User Generator /usergen 

### Views
Views include: 
* master layout which uses Bootstrap to improve my navigation bar. 
* ipsum blade template which loops through an array of content received from the controller and prints out paragraphs separated by new lines 
* usergen blade template which loops through an array of content received from the controller, checks if the birthday and profile tags are turned on, and prints the appropriate content 

## Database structure and Models 
Uses a database with at least 2 tables. This count does not include a users table, but does include pivot tables.

## CRUD operations on Lessons 
Demonstrates all 4 CRUD interactions (user signup/login does not count towards this).

## Server-side error validation for updating and creating Lessons 

## Creating a new Laravel application
Since I develop on a linux machine, creating a new Laravel project used a blend of the instructions for mac and digitalocean setup. 



