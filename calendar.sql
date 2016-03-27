 create database calendar;
 create TABLE if not exists events(
 title varchar(100) NOT NULL,
 data DATA NOT NULL,
 time TIME NOT NULL,
 username VARCHAR(20) NOT NULL,
 id mediumint(8) unsigned NOT NULL,
 group enum('A','B','C','D') NOT NULL,
 groupshare tinyint(1) NOT NULL,
 primary key(id)
 ) engine = innodb default character set = utf8 collate = utf8_general_ci;

--  Dumping data for table events
 INSERT INTO events (title, date, time, username, id, group, groupshare) VALUES
('First test.', '2014-10-27', '06:18:24', 'test', 1, 'A', 0),
('afasdf', '2014-10-27', '07:14:00', 'test', 2, 'A', 0),
('afbab', '2014-10-27', '08:23:00', 'test', 3, 'A', 0),
('babcxcbx', '2014-10-27', '09:19:43', 'test', 4, 'A', 0),
('afafaf', '2014-10-27', '11:27:23', 'test', 5, 'A', 0),
('afasfsaf', '2014-10-26', '00:23:00', 'test', 7, 'A', 0),
('fasdfasdfa', '2014-10-28', '00:00:00', 'test', 8, 'A', 0),
('213123', '2014-10-28', '00:00:00', 'test', 9, 'A', 0),
('2123123', '2014-10-28', '13:02:00', 'test', 10, 'A', 0),
('asfasdf', '2014-10-28', '02:00:00', 'test', 11, 'A', 0),
('asfasfda', '2014-10-28', '12:31:00', 'test', 12, 'A', 0);

CREATE TABLE IF NOT EXISTS shareEvents(
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  date date NOT NULL,
  time time NOT NULL,
  title varchar(100) NOT NULL,
  sourceusername varchar(20) NOT NULL,
  targetusername varchar(20) NOT NULL,
  togroup varchar(20) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB AUTO_INCREMENT DEFAULT CHARSET=latin1;

create TABLE if not exists users(
username varchar(20) NOT NULL,
password varchar(50) NOT NULL,
salt varchar(25) NOT NULL,
group enum('A','B','C','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO users (username, password, salt, group) VALUES
('test', 'T3Kns96OoPI3U', 'T3bAROOzXrjZduE', 'A'),
('123', 'qE8GsSsRrunC.', 'qEnCYC4QYCDGv2', 'A'),
('abc', '6y7zuty29zDt.', '6ysOazXdECbJj', 'A');

