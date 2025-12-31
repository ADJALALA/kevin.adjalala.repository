UPDATE movies
SET producer_id = (
    SELECT id
    FROM producers
    WHERE name LIKE '%film'
    ORDER BY (
        SELECT COUNT(*)
        FROM movies
        WHERE producer_id = producers.id
    ) ASC
    LIMIT 1
)
WHERE producer_id IS NULL;
