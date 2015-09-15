select sum(fldNumStudents - fldMaxStudents) as 'Total Number of Excess Students' from tblSections where fldNumStudents>fldMaxStudents;
