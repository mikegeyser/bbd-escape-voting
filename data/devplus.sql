use Escape;

SET FOREIGN_KEY_CHECKS = 0;

truncate table COMMENTS;
truncate table VOTES;
truncate table PRESENTER;

SET FOREIGN_KEY_CHECKS = 1;


insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@mikegeyser", "Mike Geyser", "Building a twitter wall in 15 minutes, and learning something along the way", "2017-08-31 14:00:00", "2017-08-31 15:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@", "Caspar Schutte", "Mobile VR AOP", "2017-08-31 15:00:00", "2017-08-31 16:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@", "Geoffrey le Roux", "Creating diverse mobile applications using Unity3D", "2017-08-31 15:00:00", "2017-08-31 16:00:00");

