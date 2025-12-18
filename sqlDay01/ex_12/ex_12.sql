SELECT COUNT(*) AS "Number of ‘western’ movies" FROM movies 
INNER JOIN genres ON movies.genre_id = genres.id 
INNER JOIN producers ON movies.producer_id = producers.id WHERE genres.name = "western" 
AND producers.name IN('tartan movies', 'ionsgate uk');