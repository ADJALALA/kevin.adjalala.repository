SELECT COUNT(*) AS "Number of members", ROUND(AVG(TIMESTAMPDIFF(YEAR, birthdate, CURDATE()))) 
AS "Average age" FROM profiles ;