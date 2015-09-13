select distinct fldBuilding, sum(fldNumStudents) from tblSections where fldDays like '%F%' group by fldBuilding order by sum(fldNumStudents);
