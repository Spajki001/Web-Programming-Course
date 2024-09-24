# **Project important notes**

## Before start

- You have to make a symbolic link to `htdocs` folder for easier accessibility while coding.
- You can create the link by running<br>
`ln -s /opt/lampp/htdocs /home/{user}/Web-Programming-Course/Project/htdocs`<br>
command in Linux terminal after moving to `Project` directory.
- If needed, import the database by importing the `DatabaseProject.sql`.

## All tasks

- It is required to install XAMPP. You have create `Project` directory in XAMPP `htdocs` and move all `.php` files from `Scripts` directory to it.
- After doing everything, you have to start the Apache web server and MySQL Database in XAMPP and access them through the browser by going to `localhost/phpmyadmin` and `localhost/Project`.
- `Index.php` script is the default and main one that opens when `localhost/Project` is called.
- You can access all other scripts by using the webpages or by typing the name of the script in the url **(only if logged in as admin)** in the format `localhost/Project/{scriptname}.php` where `{scriptname}` is the name of the script you want to call.
