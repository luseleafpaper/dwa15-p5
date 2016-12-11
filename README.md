# DWA 15 Final Project - Lesson Scheduler 

Welcome! For my final project, I've decided to take some of the stress out of scheduling lessons. Both my boyfriend and I are instructors in our freetime (me in math and him in dance). We frequently exchange emails with our students regarding scheduling. In particular, students want to know when the instructor is available for a lesson and confirm existing lesson times. Instructors would love to just share our google calendars with our students so that they can check for themselves, but that would cause privacy issues. 

## Application goals 
Therefore, my goal is to create a scheduler that will allow instructors to 
* schedule lessons with **their** students (Yes, a lesson can have more than one student!) 
* schedule lessons with other instructors (the default lesson is taught by the teacher who is logged in, but sometimes one teacher is not enough!) 
* review, edit and delete lessons 
* create lessons without any students which become **available** lesson times for all **their** students to see 

Students will be able to: 
* see the details for lessons that they are in
* see when **their** instructors are busy with other students without seeing any lesson details so that 1. they don't request alternative lesson times when the instructor is busy and 2. other student's privacy is protected. 

## User roles for the demo 

A user can be both a teacher and a student. The default user **Jill** is a teacher to **Jamal**. Jill is also a student to Lu. At the moment, an admin role is necessary to create and link students and teachers. 

For the scope of this project, all major CRUD operations will be done on Lessons by Teachers and Students. In the future, I would like to add an admin role that can perform CRUD operations on the Teachers and Students themselves. 

## Application demo 
Screencast [video](). 

## Live Laravel application
Live site is here: [p4.luseleafpaper.com](http://p4.luseleafpaper.com/)

## Database structure and Models 
Uses a database with at least 2 tables. This count does not include a users table, but does include pivot tables.

There are three Model classes: 
* Lessons   
  * the primary focus of this project's CRUD operations
  * has at least one teacher 
  * has zero or more students 
* Teachers 
  * has zero or more lessons 
  * has zero or more students 
  * has one user 
* Students 
  * has zero or more lessons 
  * has zero or more teachers 
  * has one user 
* User 
  * may be a student 
  * may be a teacher 
  * eventually, may be an admin! 

Here is a list of the many to many relationships in this application. Therefore, there is a pivot table for each relationship.
* Lesson and Teacher
* Lesson and Student
* Student and Teacher 

Teacher -> User is a one to one relationship, as is Student -> User. 

## CRUD operations on Lessons 

To perform all CRUD operations on a lesson, login as Jill. Then, navigate to the following routes: 
* Create [/lessons/create](http://p4.luseleafpaper.com/lessons/create)
* Read [/lessons/{lesson_id}](http://p4.luseleafpaper.com/lessons/{lesson_id})
* Update [/lessons/{lesson_id}/edit](http://p4.luseleafpaper.com/lessons/{lesson_id}/edit)
* Delete [/lessons/{lesson_id}/delete](http://p4.luseleafpaper.com/lessons/{lesson_id}/delete)

## Server-side error validation for updating and creating Lessons 

Creating lessons: a description, and start and end times are required (lesson duration is calculated using these fields). The student list must be between 0 and 100 students. The teacher list must be between 1 and 10, meaning there must be at least one teacher. 

Updating lessons: same as above. 

When you create or update a lesson, it's possible to create a lesson with another teacher as the only teacher. So teachers can schedule lessons for each other. 

