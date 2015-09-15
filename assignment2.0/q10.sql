select distinct fldBuilding, sum(fldNumStudents) as 'Total Number of Students'  from tblSections where fldDays like '%F%' group by fldBuilding order by sum(fldNumStudents);
