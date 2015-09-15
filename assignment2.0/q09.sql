select distinct fldBuilding, sum(fldNumStudents) as 'Total Number of Students' from tblSections where fldDays like '%W%' group by fldBuilding order by sum(fldNumStudents);
