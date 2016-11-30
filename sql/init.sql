CREATE OR REPLACE TABLE ServiceItem(
  machineId char(3) PRIMARY KEY,
  groupId char(3),
  phone char(10),
  contractId char(3),
  FOREIGN KEY (groupId) REFERENCES Group(groupId),
  FOREIGN KEY (customerId) REFERENCES Customer(customerId),
  FOREIGN KEY (contractId) REFERENCES Contract(contractId)
);

CREATE OR REPLACE TABLE Group(
  groupId char(3) PRIMARY KEY,
  noOfMachines integer,
  check(noOfMachines <= 3)
);

CREATE OR REPLACE TABLE  Customer(
  phone char(10) PRIMARY KEY,
  name char(20)
);

CREATE OR REPLACE TABLE Contract(
  contractId char(3),
  startDate date,
  endDate date,
);

CREATE OR REPLACE TABLE MachineUnderRepair(
  repairId char(3) PRIMARY KEY,
  machineId char(3),
  model char(20),
  personId char(3),
  timeIn time,
  timeOut time,
  status char(1),
  coverage char(1),
  FOREIGN KEY machineId REFERENCES ServiceItem(machineId),
  FOREIGN KEY personId REFERENCES RepairPerson,
  check (status in ('1', '2', '3', '4')),
  check (coverage in ('Y', 'N'))
);

CREATE OR REPLACE TABLE RepairPerson(
  personId char(3) PRIMARY KEY,
  name char(20),
  phone char(10)
);

CREATE OR REPLACE TABLE Problem(
  problemId char(3) PRIMARY KEY,
  description char(100),
  cost INTEGER
);

CREATE OR REPLACE TABLE RepairProblem(
  repairId char(3),
  problemId char (3),
  CONSTRAINT repairProblemPK PRIMARY KEY (repairId, problemId),
  FOREIGN KEY repairId REFERENCES MachineUnderRepair(repairId),
  FOREIGN KEY problemId REFERENCES Problem(problemId)
);
