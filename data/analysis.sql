use Escape;

SET FOREIGN_KEY_CHECKS = 0;

truncate table COMMENTS;
truncate table VOTES;
truncate table PRESENTER;

SET FOREIGN_KEY_CHECKS = 1;


insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@", "Patricia Fakudze", "The Scaled Agile Framework for dummies", "2017-08-31 14:00:00", "2017-08-31 15:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@", "Ian Maas", "Measuring success in the real world", "2017-08-31 15:00:00", "2017-08-31 16:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@", "Patricia Draper", "Management essentials in a Cloud Computing Paradigm", "2017-08-31 15:00:00", "2017-08-31 16:00:00");

