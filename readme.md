This project is a web application that allows a user to enter data required for
generating timetables for a college and then uses that data for generating timetables
on demand.

The web application is developed using Laravel PHP framework and Jquery.

The timetable generation is done using a genetic algorithm that runs as a Laravel
job in the background when timetables are requested.

The way forward for this project is de-coupling the genetic algorithm into a re-usable
library that can easily be plugged into other applications. The UX can also be improved
further.