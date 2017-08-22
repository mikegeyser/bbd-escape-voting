use Escape;

SET FOREIGN_KEY_CHECKS = 0;

truncate table COMMENTS;
truncate table VOTES;
truncate table PRESENTER;

SET FOREIGN_KEY_CHECKS = 1;


insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@selpalonline", "Stephen Goldberg", "Selpal, to the clouds and beyond", "2017-08-31 14:00:00", "2017-08-31 15:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@", "Francois v Niekerk", "Acturis with Xamarin magic", "2017-08-31 15:00:00", "2017-08-31 16:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@", "Dieter Rosh", "TurfSport, a cloud story", "2017-08-31 15:00:00", "2017-08-31 16:00:00");

