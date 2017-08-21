
DELIMITER $$
CREATE PROCEDURE InsertRand(IN TimeSlot INT, IN NumRows INT, IN MinVal INT, IN MaxVal INT)
    BEGIN
        DECLARE i INT;
        DECLARE Rating INT;

        SET i = 1;
        START TRANSACTION;
        WHILE i <= NumRows DO
            SET Rating = MinVal + CEIL(RAND() * (MaxVal - MinVal));
            
            INSERT INTO VOTES 
            (RATING, TIMESLOT) 
            VALUES (Rating, TimeSlot);

            INSERT INTO COMMENTS 
            (COMMENT, PRESENTER, NAME) 
            VALUES 
            ('Timeslot: ' + TimeSlot + ', Rating: ' + Rating + ', Time: ' + NOW(), TimeSlot, '');

            SET i = i + 1;
        END WHILE;
        COMMIT;
    END$$
DELIMITER ;

InsertRand(1, 100, 1, 5);
InsertRand(2, 100, 1, 5);
InsertRand(3, 100, 1, 5);

DROP PROCEDURE InsertRand;