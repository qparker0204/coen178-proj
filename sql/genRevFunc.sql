/*
select generateRevenueFunc('15-JUN-2015 10:00:00', '20-JUN-2015 10:00:00') from dual;
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

	CURSOR m_cursor IS
		SELECT machineId, coverage, status, hoursWorked 
		FROM MachineUnderRepair
		WHERE timeOut <= timeoutParam AND timeIn >= timeinParam;
	m_row m_cursor%rowtype;

	CURSOR p_cursor IS
		SELECT problemId
		FROM RepairProblem
		WHERE machineId = m_row.machineId;
	p_row p_cursor%rowtype;

	BEGIN	
		IF NOT m_cursor%ISOPEN THEN
			OPEN m_cursor;
		END IF;

		LOOP

			FETCH m_cursor into m_row;
			EXIT WHEN m_cursor%NOTFOUND;

			OPEN p_cursor;
			LOOP 
				FETCH p_cursor into p_row;	
				EXIT WHEN p_cursor%NOTFOUND;

			IF m_row.status = 4 THEN
				SELECT cost into v_cost
				FROM Problem
				WHERE p_row.problemId=problemId;

				SELECT endDate into w_endDate
				FROM Contract
				WHERE contractId = (SELECT contractId
						    FROM ServiceItem
						    WHERE machineId = m_row.machineId);

	    
				
				IF m_row.covered = 'Y' THEN
					IF w_endDate > timeoutParam THEN
						v_totalamountcovered := v_totalamountcovered + v_cost;
					END IF;
				END IF;
				IF m_row.covered = 'N' THEN
					v_totalamountnotcovered := v_totalamountnotcovered + v_cost;
				END IF;
			END IF;
			END LOOP;
			IF m_row.covered = 'Y' THEN
				v_totalamountcovered := v_totalamountcovered + (m_row.hoursWorked * 25) + 50;
			END IF;
			IF m_row.covered = 'N' THEN
				v_totalamountnotcovered := v_totalamountnotcovered + (m_row.hoursWorked * 25) + 50;
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