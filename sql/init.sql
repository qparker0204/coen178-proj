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
  startDate date,
  endDate date
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
  repairId char(3),
  problemId char (3),
  CONSTRAINT repairProblemPK PRIMARY KEY (repairId, problemId),
  FOREIGN KEY (repairId) REFERENCES MachineUnderRepair(repairId),
  FOREIGN KEY (problemId) REFERENCES Problem(problemId)
);
