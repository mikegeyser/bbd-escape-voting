use Escape;
truncate table COMMENTS;
truncate table VOTES;
truncate table PRESENTER;

insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@WernerMostert1", "Werner Mostert", "Something about Kubernetes", "2017-08-31 14:00:00", "2017-08-31 15:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@zaydkara", "Zayd Kara", "Something about Docker", "2017-08-31 15:00:00", "2017-08-31 16:00:00");
insert into PRESENTER (HANDLE, NAME, TOPIC, START, END) values ("@GerybBg", "Gergana Young", "WTF is AOT?", "2017-08-31 15:00:00", "2017-08-31 16:00:00");

