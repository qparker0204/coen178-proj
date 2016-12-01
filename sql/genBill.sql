CREATE OR REPLACE FUNCTION genBill
( repairParam IN machineunderrepair.repairid%type)
RETURN varchar IS
   string varchar(200);
BEGIN 
  DECLARE
	  v_name Customer.name%type;
	  v_phone Customer.phone%type;
	  v_model MachineUnderRepair.model%type;
	  v_timein MachineUnderRepair.timeIn%type;
	  v_timeout MachineUnderRepair.timeOut%type;
	  v_machineid MachineUnderRepair.machineId%type;
	  v_coverage MachineUnderRepair.coverage%type;
	  v_totaldue INTEGER :=0;
	  v_cost Problem.cost%type;
	  v_description Problem.description%type;
	  v_hoursworked MachineUnderRepair.hoursWorked%type;
	  v_endDate TIMESTAMP;

	  CURSOR p_cursor IS
			  SELECT problemId
			  FROM RepairProblem
			  WHERE machineId=v_machineId;
		  p_row p_cursor%rowtype;

  BEGIN
	SELECT phone, model, timeIn, timeOut, machineId, coverage, hoursWorked
	INTO v_phone, v_model, v_timein, v_timeout, v_machineid, v_coverage, v_hoursworked
	FROM MachineUnderRepair
	WHERE repairId=repairParam;

	
	SELECT name
	INTO v_name
	FROM Customer
	WHERE phone = v_phone;

	IF NOT p_cursor%ISOPEN THEN
		OPEN p_cursor;
	END IF;
	LOOP
		FETCH p_cursor INTO p_row;
		EXIT WHEN p_cursor%NOTFOUND;
		
		SELECT cost, description 
		INTO  v_cost, v_description
		FROM Problem
		WHERE problemid=p_row.problemid;

		v_totaldue := v_totaldue + v_cost;
		string := p_row.problemid || ',' || v_description || ',' || v_cost || ',';	
	END LOOP;

	IF v_coverage = 'Y' THEN
		SELECT endDate 
		INTO v_endDate
		FROM Contract 
		WHERE contractId = (SELECT contractId 
				    FROM ServiceItem 
				    WHERE machineId = v_machineid);

		IF v_timein <= v_enddate THEN
			 v_totaldue := 0;
		ELSE 
			 v_totaldue := v_totaldue + 50 + (25 * v_hoursworked);
		END IF; 
	ELSE 
	    v_totaldue := v_totaldue + 50 + (25 * v_hoursworked);
	END IF; 
	string := string || v_hoursworked || ',' || v_totaldue || ','|| v_phone || ',' || v_name;
  END;
  dbms_output.put_line(string);
  RETURN string;
END;
/
show errors
 
 