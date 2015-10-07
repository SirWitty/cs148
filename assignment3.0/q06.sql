select fldFirstName, fldPhone, fldSalary from tblTeachers HAVING fldSalary < (SELECT AVG(fldSalary) from tblTeachers)
