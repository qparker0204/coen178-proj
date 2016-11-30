DROP TABLE ServiceItem CASCADE CONSTRAINTS;
DROP TABLE MachineGroups CASCADE CONSTRAINTS;
DROP TABLE Customer CASCADE CONSTRAINTS;
DROP TABLE Contract CASCADE CONSTRAINTS;
DROP TABLE MachineUnderRepair CASCADE CONSTRAINTS;
DROP TABLE RepairPerson CASCADE CONSTRAINTS;
DROP TABLE Problem CASCADE CONSTRAINTS;
DROP TABLE RepairProblem CASCADE CONSTRAINTS;

CREATE TABLE MachineGroups(
  groupId char(3) PRIMARY KEY,
  noOfMachines integer,
  check(noOfMachines <= 3)
);

CREATE TABLE  Customer(
  phone char(10) PRIMARY KEY,
  name char(20)
);

CREATE TABLE Contract(
  contractId char(3) PRIMARY KEY,
  startDate timestamp,
  endDate timestamp
);

CREATE TABLE ServiceItem(
  machineId char(3) PRIMARY KEY,
  groupId char(3),
  phone char(10),
  contractId char(3),
  FOREIGN KEY (groupId) REFERENCES MachineGroups(groupId),
  FOREIGN KEY (contractId) REFERENCES Contract(contractId)
);

CREATE TABLE RepairPerson(
  personId char(3) PRIMARY KEY,
  name char(20),
  phone char(10)
);

CREATE TABLE MachineUnderRepair(
  repairId char(3) PRIMARY KEY,
  machineId char(3),
  model char(20),
  personId char(3),
  timeIn timestamp,
  timeOut timestamp,
  status char(1),
  coverage char(1),
  hoursWorked integer,
  phone char(10),
  FOREIGN KEY (machineId) REFERENCES ServiceItem(machineId),
  FOREIGN KEY (personId) REFERENCES RepairPerson,
  check (status in ('1', '2', '3', '4')),
  check (coverage in ('Y', 'N'))
);

CREATE TABLE Problem(
  problemId char(3) PRIMARY KEY,
  description char(100),
  cost INTEGER
);

CREATE TABLE RepairProblem(
  machineId char(3),
  problemId char (3),
  CONSTRAINT repairProblemPK PRIMARY KEY (machineId, problemId),
  FOREIGN KEY (machineId) REFERENCES MachineUnderRepair(machineId),
  FOREIGN KEY (problemId) REFERENCES Problem(problemId)
);

INSERT INTO Customer VALUES ('7777777777', 'Caddy Shack');
INSERT INTO Customer VALUES ('5555555555', 'Ronald McDonald');

INSERT INTO Contract VALUES ('C01', timestamp '2015-1-1 00:00:00', timestamp '2017-1-1 00:00:00');
INSERT INTO Contract VALUES ('C02', timestamp '2016-2-1 00:00:00', date '2016-12-31 00:00:00');
INSERT INTO Contract VALUES ('C03', timestamp '2010-10-10 00:00:00', timestamp '2014-1-1 00:00:00');

INSERT INTO MachineGroups VALUES('G01', 1);
INSERT INTO MachineGroups VALUES('G02', 2);
INSERT INTO MachineGroups VALUES('G03', 3);

INSERT INTO ServiceItem VALUES('M01', 'G01', '9166195555', 'C01');
INSERT INTO ServiceItem VALUES('M02', 'G02', '4444444444', 'C02');
INSERT INTO ServiceItem VALUES('M03', 'G03', '2323232323', 'C03');

INSERT INTO RepairPerson VALUES('RP1','Air Wiggins','4254560123');
INSERT INTO RepairPerson VALUES('RP2','Frank Tank','9161234567');
INSERT INTO RepairPerson VALUES('RP3','AP Allday','8089876543');

INSERT INTO MachineUnderRepair VALUES('UR1', 'M01', 'Macbook Air', 'RP1', TIMESTAMP '2016-11-29 00:00:00' , NULL, '1', 'Y', 0, '7777777777');
INSERT INTO MachineUnderRepair VALUES('UR2', 'M02', 'HP Elite', 'RP2', TIMESTAMP '2016-11-25 12:00:00', NULL, '1', 'N', 0, '5555555555');
INSERT INTO MachineUnderRepair VALUES('UR3', 'M03', 'Mackbook Pro', 'RP3', TIMESTAMP '2016-10-31 10:00:00', NULL , '1', 'N', 0, '5555555555');


INSERT INTO Problem VALUES('P01', 'Keyboard malfunction', 'M01');
INSERT INTO Problem VALUES('P02', 'Destory screen', 'M02');
INSERT INTO Problem VALUES('P03', 'Unable to hold charge', 'M03');

INSERT INTO RepairProblem VALUES('UR1', 'P01');
INSERT INTO RepairProblem VALUES('UR2', 'P02');
INSERT INTO RepairProblem VALUES('UR3', 'P03');
