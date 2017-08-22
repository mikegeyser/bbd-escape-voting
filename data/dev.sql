use Escape;

SET FOREIGN_KEY_CHECKS = 0;

truncate table COMMENTS;
truncate table VOTES;
truncate table PRESENTER;

SET FOREIGN_KEY_CHECKS = 1;


insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@WernerMostert1", "Werner Mostert", "Running Kubernetes on Amazon Web Services", "2017-08-31 14:00:00", "2017-08-31 15:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@zaydkara", "Zayd Kara", "Docker for Developers - It works on my machine!", "2017-08-31 15:00:00", "2017-08-31 16:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@GerybBg", "Gergana Young", "Angular performance as easy as AOT", "2017-08-31 15:00:00", "2017-08-31 16:00:00");

