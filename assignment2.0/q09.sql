select distinct fldBuilding, sum(fldNumStudents) from tblSections where fldDays like '%W%' group by fldBuilding order by sum(fldNumStudents);
