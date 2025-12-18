SELECT CONCAT(
    UPPER(LEFT(lastname, 1)), LOWER(SUBSTRING(lastnama, 2))
    '_'
    UPPER(LEFT(firstname, 1)), LOWER(SUBSTRING(firstnama, 2))) 
As "Full name" FROM profiles ORDER BY birthdate DESC;