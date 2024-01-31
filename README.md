# license-vehicle-management-system
![image](https://github.com/MovieTone/license-vehicle-management-system/assets/15722914/c7076160-0064-459d-b642-2be818978475)
![image](https://github.com/MovieTone/license-vehicle-management-system/assets/15722914/4455aa64-0644-4df9-941b-ec183d43a51c)

The system provides an ability to log in either as a Police Officer or an Administrator. 
One cannot log in as both simultaneously.

Instructions for Police Officers
To log into the website a police officer should click the ‘Officer Log In’ link in the menu at the top.
An officer should enter their login credentials, namely Username and Password and click ‘Login’.

The menu has the following options for a Police Officer:
- Search people – looks up people by their name or a license number.
One should enter an exact or a partial name of the person that is being searched and/or their license number.
- Search vehicles – looks up vehicles by their license plate number.
One should enter an exact license plate number.
- Add a vehicle – adds a vehicle to the database.
One should enter the vehicle’s make, model, colour and license plate number.
One should also choose a vehicle owner from the list. If the owner is not in the list, one should enter the new owner’s details (name, address and a license number).
- Report an Incident – adds an incident report to the database.
One should pick a date of the incident, select an offence from the list and type in an incident report.
One should also choose a vehicle owner from the list. If the owner is not in the list, one should enter the new owner’s details (name, address and a license number).
One should choose as well a person involved in the incident from the list. If the person is not in the list, one should enter the new person’s details (name, address and a license number).
- Change Password – changes password of a current Police Officer account.
One should enter their current password and a new password, then click ‘Save’.
- Display Incidents – retrieves a list of reports of incidents.
To edit an incident click on a corresponding ‘Edit’ button.

Instructions for Administrator
To log into the website an administrator should click an ‘Administrator Log In’ link in the menu at the top.
An administrator should enter their login credentials, namely Username and Password and click ‘Login’.

The menu has the following options for an Administrator:
- Create an Officer Account – creates a new officer account and stores it in the database.
One should enter a username and a password for a new officer account and click ‘Save’.
- Add Fines – adds a fine to the incident and stores it in the database.
One should enter a fine amount and fine points and select a fine category (description) from the list and click ‘Save’. 

To log out of the account click the Log Out button on the menu.

To open the Police Reporting System for the first time, one should create a database and open the website.
To create a database one should run a SQL script contained in the ‘database.sql’ file.
It will create a database called ‘Officer’, create tables and populate them. If there is a database with the same name, it will drop it prior to creating a new one.
The database consists of 8 tables: 
- Officer – stores data of officers’ accounts 
- Administrator – stores data of administrators’ accounts
- Offence – stores a list of possible offences
- Incident – stores incidents data (person, vehicle, offence) added by police officers
- Fines – stores data of fines added to the incidents by administrators
- People – stores personal information of people (including driving license) 
- Vehicle – stores information of registered vehicles (including license plate)
- Ownership – stores relationships between people and their vehicles

