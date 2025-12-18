SELECT movies.title, genres.name FROM movies JOIN genres ON movies.genre_id = genres.id WHERE genres.name IN ('action' , 'romance');
