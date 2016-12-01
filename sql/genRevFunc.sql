/*
select genRevenue('15-JUN-2015 10:00:00', '20-JUN-2015 10:00:00') from dual;
*/

CREATE OR REPLACE FUNCTION genRevenue
	(timeinParam IN MachineUnderRepair.timein%type, timeoutParam IN MachineUnderRepair.timeout%type)
RETURN varchar IS string varchar(200);
BEGIN
	DECLARE 
		v_cost INTEGER := 0;
		v_totalamountcovered INTEGER := 0;
		v_totalamountnotcovered INTEGER := 0;
		w_endDate Contract.endDate%type;
		v_hoursworked machineunderrepair.hoursworked%type;
		v_flag INTEGER := 0;
		v_prob RepairProblem.problemId%type;


	CURSOR m_cursor IS
		SELECT machineId, coverage, status, hoursWorked 
		FROM MachineUnderRepair
		WHERE timeOut <= timeoutParam;
	m_row m_cursor%rowtype;



	BEGIN	
		IF NOT m_cursor%ISOPEN THEN
			OPEN m_cursor;
		END IF;
		dbms_output.put_line('here');

		LOOP
			dbms_output.put_line('INSIDE2!');
			FETCH m_cursor into m_row;
			EXIT WHEN m_cursor%NOTFOUND;
			dbms_output.put_line(m_row.machineId);

				
			IF m_row.status = 4 THEN
				SELECT problemId into v_prob
				FROM RepairProblem
				WHERE machineId = m_row.machineId;

				SELECT cost into v_cost
				FROM Problem
				WHERE problemId=v_prob;
				dbms_output.put_line('INSIDE!');

				IF m_row.coverage = 'Y' THEN

					SELECT endDate into w_endDate
					FROM Contract
					WHERE contractId = (SELECT contractId
							    FROM ServiceItem
							    WHERE machineId = m_row.machineId);

	    
				
					IF timeinParam <= w_endDate THEN
						v_totalamountcovered := v_totalamountcovered + v_cost;
						v_flag := 1;
					ElSE
						v_totalamountnotcovered := v_totalamountnotcovered + v_cost;
						v_flag := 0;
					END IF;
				ELSE
					 v_totalamountnotcovered := v_totalamountnotcovered + v_cost;
					 v_flag := 0;
				END IF;
				IF v_flag = 1 THEN
					v_totalamountcovered := v_totalamountcovered + (m_row.hoursWorked * 25) + 50;
				ELSE
					v_totalamountnotcovered := v_totalamountnotcovered + (m_row.hoursWorked * 25) + 50;
				END IF;
			END IF;
		END LOOP;
		string := v_totalamountcovered || ',' || v_totalamountnotcovered;
		--dbms_output.put_line(v_totalamountcovered);
		--dbms_output.put_line(v_totalamountnotcovered);
		dbms_output.put_line(string);
	END;
	RETURN string;
END;
 /
show errors;