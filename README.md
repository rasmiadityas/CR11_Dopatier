# FE21_CR11_Rasmi-Silasari
210430 Code Review 11 - Rasmiaditya Silasari

# Explanation of the project:
Dopatier is a website where admin can upload information about animals that are up for adoption. 
Guests can look around the website and look at the animal's details. 
When they are interested and want adopt an animal then they have to register as a user using email and personal information. 

# File organization:
* The 'database' folder has the database (sql file) in it
* The php script folders are organized based on the objects the script is dealing with (i.e. all scripts about user data are in the folder 'user', all scripts about pet data are in the folder 'pet', etc)

# The criteria for grading:
1. (5) Create a database (cr11_petadoption_yourname) and add sufficient test data (at least 4 small animals, 4 large animals and 4 seniors) 
* The database includes a total of 16 animals which consist of 8 small and 8 large animals. Among them 6 animals are senior (3 small and 3 large).

2. (20) Display all animals on a single web page (home.php).      
* To simulate a real website the default homepage where all the animals are shown (in card format) is index.php. 
* From index.php guests can access the login page (login.php) and can sign in as admin or user.

3. (15) Display all senior animals on a single web page (senior.php).
* All senior animals can be seen in the page senior.php by clicking the 'Adopt Senior Pets!' menu on navbar or by clicking the 'I'm a senior!' label on each animal's card.

4. (15) Create a registration and login system.
* The login page (login.php) can be accessed by clicking the 'Login' menu on navbar. 
* On the login page guests can either login with the existing account or register (register.php) as a new user. The user image uses file upload feature.

5. (15) Create separate sessions for normal users and administrators. 
* When guests login with an admin account, they will be redirected to the Dasboard page (dashboard.php). This Dashboard can only be accessed by admin.
Admin account for test run: toscha@mail.com, pass: 123456
* When guests login with a user account, they will be redirected to the homepage (index.php) with additional menu on the navbar such as their picture, name, 'View Profile' menu, and 'View Adoption' menu.
User account for test run: arla@mail.com, pass: 123456

6. (30) Create an admin panel. Only the admin is able to create, update and delete data about animals within the admin panel. The normal user will be able to see everything that was created for this website, without having administrative privileges in changing the data. 
* From the dashboard admin can access the live website (the current homepage or index.php visible to guests and users) and the tables of user data, animal data and adoption data.
* From the user and animal table the admin can add, view, edit or delete a record.
* Adding, editing, deleting adoption data directly from the admin dashboard currently is not possible, but can be an added in the future.

# Bonus points
7. (20)Pet Adoption
* Only registered user can adopt an animal bs using the ''Dop Me!' button. The website will ask for confirmation when users decide to adopt an animal. 
* Once users adopt an animal, the animal's info will be hidden from the website so it cannot be seen by guests or other users. 
* The animal's adopter can see their adoption profile and the animal's detail by clicking the 'View Adoption' menu. 
* Admin can see all animal's details (available and reserved) from the 'Pet Management' menu in the admin dashboard. The adopted animal details will show the info of user who adopts it. Admin can also see the list of adoption from the 'Adoption Management' menu in the admin dashboard which will show the list of all adopter (user) and adoptee (animal).

# Future improvements:
* admin: adding stats (number of user, animal, adoption, etc) on the dashboard page and each table
* admin: adding features to add, edit and delete adoption
* admin: making nicer side navbar

* user: adding contact form
* user: making collapsible navbar
* user: adding feature to sort the animal (displaying by size, age, etc)
* user: taking timestamp when making an adoption and adding it to the adoption table
