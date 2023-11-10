# **SCSS**

```
// Definiraj varijable
$primary-color: #3498db;
$secondary-color: #e74c3c;
$font-size: 16px;

// Korištenje varijabli
body {
font-family: Arial, sans-serif;
font-size: $font-size;
}

.button {
padding: 10px 20px;
background-color: $primary-color;
color: white;
border: none;
border-radius: 5px;
}

.alert {
background-color: $secondary-color;
color: white;
padding: 10px;
}

// Korištenje @extend
.success-alert {
@extend .alert;
background-color: #27ae60;
}

.error-alert {
@extend .alert;
background-color: #e74c3c;
}
```

# **SASS**

```
// Definiraj varijable
$primary-color: #3498db
$secondary-color: #e74c3c
$font-size: 16px

// Korištenje varijabli
body
font-family: Arial, sans-serif
font-size: $font-size

.button
padding: 10px 20px
background-color: $primary-color
color: white
border: none
border-radius: 5px

.alert
background-color: $secondary-color
color: white
padding: 10px

// Korištenje @extend
.success-alert
@extend .alert
background-color: #27ae60

.error-alert
@extend .alert
background-color: #e74c3c
```
